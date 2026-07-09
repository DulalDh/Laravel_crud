<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerControllerold extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $query = customer::orderBy('id');

        if ($search !== '') {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        }
        $customers = $query->cursorPaginate(10);

        return view("customer.index", compact("customers"));
    }

    public function create()
    {
        return view("customer.create");
    }
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
    public function edit($id)
    {
        $customer = customer::findOrFail($id);
        return view("customer.edit", compact("customer"));
    }
    public function update(Request $request, $id)
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
    public function destroy($id)
    {
        $customer = customer::findOrFail($id);
        $customer->delete();
        return redirect()->route("customer.index")->with("success", "Customer deleted successfully.");

    }
}
