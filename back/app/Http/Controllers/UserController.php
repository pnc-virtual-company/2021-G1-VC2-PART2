<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function GetUsers()
    {
        return User::latest()->get();
    }


    public function Signup(Request $request)
    {
        $request->validate([
            'username' =>  'required|max:50|regex:/^[a-zA-Z]/',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'profile'=>'nullable|image|mimes:jpg,jpeg,png|max:1999',
        ]);
        $request->file('profile')->store('public/imageUser');

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->profile = $request->file('profile')->hashName();
        $user->save();
        
        $token = $user->createToken('myToken')->plainTextToken; 

        return response()->json([
            'message' => "Signup seccessfully",
            'user' => $user,
            'token' => $token
            ]);
    }

    public function Signin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        $token = $user->createToken('myToken')->plainTextToken; 
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json([
            'message' => "Signin seccessfully",
            'user' => $user,
            'token' => $token
            ]);
    }

    public function UpdateUser(Request $request, $id)
    {
        //
    }

    public function DeleteUser($id)
    {
        $isDeleted = User::destroy($id);

        if($isDeleted == 1) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        }else{
            return response()->json(['message' => 'ID NOT FOUND'], 404);
        }
    }
}
