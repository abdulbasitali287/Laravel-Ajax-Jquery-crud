<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use \Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validator::make($requ)
        $validation = $request->validate([
            'name' => 'required',
            'image' => 'required | mimes:jpg,jpeg,png'
        ]);
            $obj = new Image();
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                // $request->file('image')->storeAs('public/uploads',$name);
                if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
                    $image = $request->file('image');
                    $name = $image->getClientOriginalName();
                    $image->move('assets/images/',$name);
                    $fileName = 'assets/images/' . $name;
                    $obj->image = $fileName;
                }
                $obj->name = $request->name;
                $obj->save();
                return response()->json([
                    'message' => 'your form has been submitted...!'
                ]);
            }
        return response()->json([
            'errors' => $validation->all()
            // 'name' => $validation->name,
            // 'image' => $validation->image,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
