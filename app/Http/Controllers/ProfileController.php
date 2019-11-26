<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Forum;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $forums = Forum::where('user_id', $user->id)->get();
        return view('profile.index', compact('user','forums'));
    } 

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'fotoprofil' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5000'
        ]);


        if ($request->file('fotoprofil')){
            $file = $request->file('fotoprofil');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = public_path('/images');
            $file->move($location, $filename);

            User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'fotoprofil' => $filename
            ]);

        } else {
            User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }   

        return redirect('/user/'.$request->name);
    }
}
