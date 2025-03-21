<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {

        if (Auth::check()) {
            return redirect()->route('ict_lib_dashboard');
        }
        return view("login");
    }
    public function login_function(Request $request)
    {

        $login = User::where("username", $request->username)->first();
        if ($login) {
            if ($request->password == rock_my_world($login->password, 'decrypt')) {

                auth()->login($login);
                return redirect("ict_lib_dashboard");
            }
            return redirect()->route('login')->with(['error' => 'Invalid credentials']);
        }
        return redirect()->route('login')->with(['error' => 'Invalid credentials']);

    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }


}


// $myString="abc123";
// if( preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $myString) ) 
// { 
//     echo('Has numbers and letters.');
// } else {
//     echo("no");
// }


// $input = "Test123";

// if (preg_match('/^(?=.*[a-zA-Z])(?=.*\d).+$/', $input)) {
//     echo "The input contains both letters and numbers.";
// } else {
//     echo "The input does not contain both letters and numbers.";
// }