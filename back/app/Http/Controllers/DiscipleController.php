<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciple;

class DiscipleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Disciple::with('student')->latest()->get();
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
            'student_id'=>'required',
            'dnt'=>'required',
            'date'=>'required',
            'description'=>'required',
        ]);

        $disciple = new Disciple();
        $disciple->student_id = $request->student_id;
        $disciple->dnt = $request->dnt;
        $disciple->date = $request->date;
        $disciple->description = $request->description;

        $disciple->save();
       
        return response()->json(['message' => "created successfully!" , "disciple" => $disciple],201);

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
    public function Update(Request $request, $id)
    {
        //
        $disciple = Disciple::findOrFail($id);
        $disciple->Update($request->all());
       
        return response()->json(['message' => "updated successfully!" , "disciple" => $disciple],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        return Disciple::destroy($id);
    }
    public function search($first_name)
    {
        return Disciple::where('first_name','like','%'.$first_name.'%')->get();
    }
}
