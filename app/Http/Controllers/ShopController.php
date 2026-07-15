<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();

        $query = DB::table('shops')->orderBy('id');
        if ($search !== '') {
            $query->where('shop_name', 'like', "%{$search}%")
                ->orWhere('shop_address', 'like', "%{$search}%")
                ->orWhere('shop_phone', 'like', "%{$search}%")
                ->orWhere('shop_email', 'like', "%{$search}%")
                ->orWhere('tin_number', 'like', "%{$search}%");
        }
        $shopData = $query->cursorPaginate(10);

        return view('shop.index', compact('shopData'));
    }

    public function create()
    {
        return view('shop.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|max:255|unique:shops',
            'shop_number' => 'required|max:50',
            'shop_address' => 'required|max:255',
            'shop_phone' => 'required|max:25',
            'shop_email' => 'required|max:50',
            'tin_number' => 'required|max:25',
        ]);
        DB::table('shops')->insert([
            'shop_name' => $request->shop_name,
            'shop_number' => $request->shop_number,
            'shop_address' => $request->shop_address,
            'shop_phone' => $request->shop_phone,
            'shop_email' => $request->shop_email,
            'tin_number' => $request->tin_number,
            'created_at' => now(),
        ]);

        return redirect()->route('shop.index')->with('success', 'Successfully created shop');
    }

    public function edit($id)
    {
        $shop = DB::table('shops')->where('id', $id)->first();

        return view('shop.edit', compact('shop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shop_name' => 'required|max:255|unique:shops,shop_name,'.$id,
            'shop_number' => 'required|max:50',
            'shop_address' => 'required|max:255',
            'shop_phone' => 'required|max:25',
            'shop_email' => 'required|max:50',
            'tin_number' => 'required|max:25',
        ]);

        try {
            DB::table('shops')->where('id', $id)->update([
                'shop_name' => $request->shop_name,
                'shop_number' => $request->shop_number,
                'shop_address' => $request->shop_address,
                'shop_phone' => $request->shop_phone,
                'shop_email' => $request->shop_email,
                'tin_number' => $request->tin_number,
                'updated_at' => now(),
            ]);

            return redirect()->route('shop.index')->with('success', 'Successfully updated shop');
        } catch (\Exception $e) {
            Log::info('Error Updating Shop: '.$e->getMessage());

            return redirect()->route('shop.index')->with('error', 'Failed to updated shop: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::table('shops')->where('id', $id)->delete();

        return redirect()->route('shop.index')->with('success', 'Successfully deleted shop');
    }

    public function show($id)
    {
        $owner = Mechanic::with('owner')->find($id);

        return $owner;
    }
}
