<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function edit($id){
    $user = User::find($id);

    if (auth()->user()->id ==! $user){
        return redirect('/')->with('error', 'Alleen de gebruiker zelf mag zijn eigen gegevens aanpassen');
    }

    return view('users.edit')->with('user', $user);
   }

   public function update(Request $request, $id){
    $user = User::find($id);

    if (auth()->user()->id ==! $user){
        return redirect('/')->with('error', 'Alleen de gebruiker zelf mag zijn eigen gegevens aanpassen');
    }
    
    //Validate the fields, check if user doesnt want to change email. If its the same as the old record, just dont validate it and then save.
    if(auth()->user()->email == request('email')) {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'min:6|confirmed'
        ]);
    }
    else{
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'min:6|confirmed'
        ]);
    }

    //Save new user information
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt(request('password'));
    $user->save();

    return redirect('/')->with('success', 'Gegevens succesvol aangepast');
   }
}
