<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPermission()
    {
        //
        return Permission::with('Student')->latest()->get();
    
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
            'student_id'=> 'required',
            'teacher'=> 'required',
            'description'=>'required',
            'leaveType'=>'required',
            
        ]);

        $permission = new Permission();
        $permission->student_id = $request->student_id;
        $permission->teacher = $request->teacher;
        $permission->startDate = $request->startDate;
        $permission->endDate = $request->endDate;
        $permission->leaveType = $request->leaveType;
        $permission->description = $request->description;

        $permission->save();

        return response()->json(['message' => "created Successfully!" , "permission" => $permission] ,201);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermission(Request $request, $id)
    {
        //
         $permission = Permission::findOrFail($id);
         $permission->update($request->all());
 
         return response()->json(['message' => "updated successfully!" , "permission" => $permission],200);
     
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
        return Permission::destroy($id);
    }
    public function search($teacher)
    {
        return Permission::where('teacher','like','%'.$teacher. '%')->get();
    }
}
