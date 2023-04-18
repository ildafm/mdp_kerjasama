<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $this->authorize('adminOnly', User::class);
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
        $this->authorize('adminOnly', User::class);
        $units = Unit::All();
        return view('user.create')
            ->with('units', $units);
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

        $this->authorize('adminOnly', User::class);

        $validateData = $request->validate([
            'name' => 'required | string',
            'kode_dosen' => 'required | max:6 | string | unique:users',
            'email' => 'required | unique:users| email | max:255 | string',
            'password' => 'required | min:8 | confirmed | string',
            'level' => 'required',
            'nama_unit' => 'required',
        ]);

        $user = new User();
        $user->name = $validateData['name'];
        $user->kode_dosen = $validateData['kode_dosen'];
        $user->email = $validateData['email'];
        $user->password = Hash::make($validateData['password']);
        $user->level = $validateData['level'];
        $user->unit_id = $validateData['nama_unit'];
        $user->save();

        // Send email to new user
        $nowHourQuerry = DB::select("SELECT Hour(Now()) as 'jam_sekarang'");
        $nowHour = $nowHourQuerry[0]->jam_sekarang;
        if ($nowHour <= 10) {
            $salam = 'Selamat pagi';
        } elseif ($nowHour <= 14) {
            $salam = 'Selamat siang';
        } elseif ($nowHour <= 18) {
            $salam = 'Selamat sore';
        } elseif ($nowHour < 24) {
            $salam = 'Selamat malam';
        }
        $details = [
            'title' => 'Aktivasi Akun MDP Kerjasama',
            'salam' => $salam,
            'user_email' => $validateData['email'],
            'user_password' => $validateData['password'],
        ];

        Mail::to($validateData['email'])->send(new \App\Mail\NewUserMail($details));

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
        $this->authorize('adminOnly', User::class);

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
        $this->authorize('adminOnly', User::class);

        $units = Unit::All();
        return view('user.edit')
            ->with('units', $units)
            ->with('user', $user);
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
        $this->authorize('adminOnly', User::class);

        $validateData = $request->validate([
            'name' => 'required | string',
            'password' => 'required_with:password_confirmation|same:password_confirmation',
            'level' => 'required',
            'nama_unit' => 'required',
        ]);

        $user = User::findOrFail($user->id);
        if ($request->password != "") {
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($validateData['password']),
                'level' => $request->level,
                'unit_id' => $request->nama_unit,
            ]);

            if ($user->id != Auth::user()->id) {
                // Send email to new user
                $details = [
                    'title' => 'Perubahan Akun MDP Kerjasama',
                    'user_email' => $user->email,
                    'user_name' => $request->name,
                    'user_password' => $validateData['password'],
                ];
                Mail::to($user->email)->send(new \App\Mail\EditUserMail($details));
            }
        } else {
            $user->update([
                'name' => $request->name,
                'level' => $request->level,
                'unit_id' => $request->nama_unit,
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
        $this->authorize('adminOnly', User::class);
        try {
            $getUser = User::find($user->id);
            $user->delete();

            if ($getUser->file != null || $getUser->file != '') {
                unlink(storage_path('app/public/profile/' . $user->file));
            }

            return redirect()->route('users.index')->with('pesan', "Hapus data $user->name berhasil");
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('users.index')->with('pesan_error', "Gagal menghapus data $user->name");
        }
    }
}
