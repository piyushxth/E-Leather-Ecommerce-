<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{

    public function __construct(){
        $this->middleware(["XssSanitizer"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="Shippings";
        $shippings=Shipping::get();
        return view('backend.pages.shipping.index',compact('shippings','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:191|unique:shippings,name,',
            'price' => 'nullable|integer|max:1000',
         ]);
        $input=$request->all();
        if ($request->has('status') && $request->status == 1) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        Shipping::create($input);
        return redirect()->route('admin.shipping.index')->with('success_msg', 'Shipping Location created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        $title="Shippings";
        return view('backend.pages.shipping.edit',compact('shipping','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {

        $input=$request->all();
        if ($request->has('status') && $request->status == 1) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $shipping->update($input);
        return redirect()->route('admin.shipping.index')->with('success_msg', 'Shipping Location Updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        //
    }
}
