<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $query = customer::withTrashed()->orderBy('id');

        if ($search !== '') {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        }
        $customers = $query->cursorPaginate(10);

        return view("customer.index", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("customer.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required|max:255|unique:customers',
            'email' => 'required|max:50|unique:customers',
            'phone' => 'required|max:25|unique:customers',
        ]);
        customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect()->route("customer.index")->with("success", "Customer created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = customer::findOrFail($id);
        return view("customer.edit", compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:customers,name,' . $id,
            'email' => 'required|max:50|unique:customers,email,' . $id,
            'phone' => 'required|max:25|unique:customers,phone,' . $id,
        ]);
        customer::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect()->route("customer.index")->with("success", "Customer updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = customer::findOrFail($id);
        $customer->delete();
        return redirect()->route("customer.index")->with("success", "Customer deleted successfully.");
    }
    public function delete(string $id)
    {
        $customer = customer::withTrashed()->findOrFail($id);
        $customer->forceDelete();
        return redirect()->route("customer.index")->with("success", "Customer deleted successfully.");
    }
    public function restore(string $id)
    {
        $customer = customer::withTrashed()->findOrFail($id);
        $customer->restore();
        return redirect()->route("customer.index")->with("success", "Customer restored successfully.");
    }
}
