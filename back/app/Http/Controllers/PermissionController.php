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
        return Permission::latest()->get();
    
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
            'description'=>'required',
            'permissionType'=>'required',
            
        ]);

       

        $permission = new Permission();
        $permission->firstName = $request->firstName;
        $permission->lastName = $request->lastName;
        $permission->class = $request->class;
        $permission->description = $request->description;
        $permission->permissionType = $request->permissionType;

        $permission->save();

        return response()->json(['message' => "created Successfully!" , "permission" => $permission] ,201);
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
    public function search($firstName)
    {
        return Permission::where('firstName','like','%'.$firstName. '%')->get();
    }
}
