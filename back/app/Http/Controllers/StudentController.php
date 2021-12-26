<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudent()
    {
        //
        return Student::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'class' => 'required',
            'phone' => 'required',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:1999',
            'gender' => 'required',
            'ngo' => 'required'
        ]);

        $request->file('picture')->store('public/imagestudent');

        $student = new Student();
        $student->firstName = $request->firstName;
        $student->lastName = $request->lastName;
        $student->class = $request->class;
        $student->phone = $request->phone;
        $student->gender = $request->gender;
        $student->ngo = $request->ngo;
        $student->picture = $request->file('picture')->hashName();
        $student->user_id = $request->user_id;

        $student->save();

        return response()->json(['message' => "created Successfully!" , "student" => $student] ,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(Request $request, $id)
    {
        //
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return response()->json(['message' => "updated successfully!" , "student" => $student],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $isDeleted = Student::destroy($id);

        if($isDeleted == 1) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        }else{
            return response()->json(['message' => 'ID NOT FOUND'], 404);
        }
    }
    public function search($firstName)
    {
        return Student::where('firstName','like','%'.$firstName. '%')->get();
    }
}
