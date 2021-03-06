<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return view('user.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('viewAny', User::class);

        return view('user.create');
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

        $this->authorize('viewAny', User::class);

        $validateData = $request->validate([
            'name' => 'required | string',
            'kode_dosen' => 'required | max:6 | string | unique:users',
            'email' => 'required | unique:users| email | max:255 | string',
            'password' => 'required | min:8 | confirmed | string',
            'level' => 'required'
        ]);

        $user = new User();
        $user->name = $validateData['name'];
        $user->kode_dosen = $validateData['kode_dosen'];
        $user->email = $validateData['email'];
        $user->password = Hash::make($validateData['password']);
        $user->level = $validateData['level'];
        $user->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $this->authorize('viewAny', User::class);
        
        return view('user.show')->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) //User $user = $id
    {
        //
            $this->authorize('viewAny', User::class);

            return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) //User $user = $id
    {
        //
        $this->authorize('viewAny', User::class);

        $validateData = $request->validate([
            'name' => 'required | string',
            'password' => 'required_with:password_confirmation|same:password_confirmation',
            'level' => 'required',
        ]);

        $user = User::findOrFail($user->id);
        if($request->password != ""){
            $user->update([
                'name' => $request->name,
                'password' => $request->password = Hash::make($validateData['password']),
                'level' => $request->level
            ]);   
        }
        else{
            $user->update([
                'name' => $request->name,
                'level' => $request->level,
            ]); 
        }
       
        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) //User $user = $id
    {
        //
        $this->authorize('viewAny', User::class);

        if($user->file != null || $user->file != ''){
            unlink(storage_path('app/public/profile/'.$user->file));
        }

        $user->delete();
        return redirect()->route('users.index')->with('pesan', "Hapus data $user->name berhasil");
    }

    public function profile(User $user){
        return view('user.profile')->with('user', $user);
    }
}
