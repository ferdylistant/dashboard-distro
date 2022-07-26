<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function __construct()

    {
        $this->middleware('guest')->except('logout');
        $this->user = new User();
    }
    function loginView()
    {
        return view("pages.login");
    }

    function doLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',   // required and email format validation
            'password' => 'required', // required and number field validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(),422);
            // validation failed return with 422 status

        } else {
            //validations are passed try login using laravel auth attemp
            if (\Auth::attempt($request->only(["email", "password"]))) {
                $this->user->where('email', $request->email)->update(['last_login' => Carbon::now('Asia/Jakarta')->toDateTimeString()]);

                return response()->json([
                    "status"=>true,
                    "redirect_location"=>url("/"),
                ]);

            } else {
                return response()->json([["Invalid credentials"]],422);

            }
        }
    }
    // logout method to clear the sesson of logged in user
    function logout()
    {
        \Auth::logout();
        return redirect("login")->with('success', 'Logout successfully');;
    }
}
