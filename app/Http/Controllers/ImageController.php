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
        $students = Image::all();
        return response()->json([
            'student' => $students
        ]);
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
        $validation = $request->validate([
            'name' => 'required',
            'image' => 'required | mimes:jpg,jpeg,png'
        ]);
            $obj = new Image();
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
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
    public function edit($id)
    {
        $student = Image::find($id);
        return response()->json([
            'status' => 400,
            'students' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'edit_name' => 'required',
            'edit_image' => 'required | mimes:jpg,jpeg,png'
        ]);
            $obj = Image::find($id);
            if ($obj) {
                if ($request->hasFile('edit_image')) {
                    $extension = $request->file('edit_image')->getClientOriginalExtension();
                    if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
                        $image = $request->file('edit_image');
                        $name = $image->getClientOriginalName();
                        $image->move('assets/images/',$name);
                        $fileName = 'assets/images/' . $name;
                        $obj->image = $fileName;
                    }
                    $obj->name = $request->edit_name;
                    $obj->save();
                    return response()->json([
                        'status' => 200,
                        'message' => "Your record has been updated...!"
                    ]);
                }
        }
        return response()->json([
            'status' => 400,
            'errors' => $validation->all()
        ]);
    }

    public function deleteRecord(){
        $student = Image::find($id);
        if ($student) {
            return response()->json([
                "status" => 400,
                "students" => $student
            ]);
        }else {
            return response()->json([
                "status" => 404,
                "error" => "Record not Found...!"
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Image::find($id);
        if ($student) {
            $student->delete();
            return response()->json([
                "status" => 400,
                "message" => "Record has been deleted...!"
            ]);
        }else {
            return response()->json([
                "status" => 404,
                "error" => "Record not Found...!"
            ]);
        }
    }
}
