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
    public function Logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'User logout']);
    }

    public function UpdateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
       
        return response()->json(['message' => "updated successfully!" , "event" => $user],200);
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

    public function search($username)
    {
        return User::where('username','like','%'.$username.'%')->get();
    }
}

// 1|6tRwaxZlncw2Dim5uLL3SId7o3pDKfZskLNKH6Hf
// 2|EpivXWpVr7aSvsMdwCs6nOlYu5GnEG9sK7O2wynO
