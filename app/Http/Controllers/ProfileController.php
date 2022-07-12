<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        if(Auth::user()->level == 'D'){
            return view('profile.edit')->with('user', $user);
        }
        else{
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validateData = $request->validate([
            'name' => 'required | string',
            'file' => 'file |mimes:jpg,png| max:500',
            'password' => 'required_with:password_confirmation|same:password_confirmation',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        // kondisi jika input gambar tidak kosong
        if(!empty($request->file)){

            if($user->file != null || $user->file != ''){
                unlink(storage_path('app/public/profile/'.$user->file));
            }
        
            //ambil extensi //png / jpg
            $ext = $request->file->getClientOriginalExtension();

            //ubah nama file file
            $rename_file = 'file-'.Auth::user()->kode_dosen.'-'.Auth::user()->name.".".$ext; //contoh file : file-D00001.jpg

            //upload file ke dalam folder public
            $request->file->storeAs('public/profile', $rename_file);

            $user->file = $rename_file;
        }

        if($request->password != ""){
            $user->update([
                'name' => $request->name,
                'password' => $request->password = Hash::make($validateData['password']),
            ]);   
        }
        else{
            $user->update([
                'name' => $request->name,
            ]); 
        }
       
        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('profiles.edit', ['profile' => Auth::user()->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
