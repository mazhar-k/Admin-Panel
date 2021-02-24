<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware('auth',['except'=>['register_user']]);
    }
    // $routeName = Request::route()->getName());

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function storeAccessId(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'access_id'=>['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user=new User;
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->access_id=$request->input('access_id');
        $user->password=$request->input('password');
        $user->save();

        return redirect('/home');
    }
}
