<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
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

        $status = Status::All();
        return view('status.index')
            ->with('statuses', $status);
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

        // return view('status.create');
        return redirect()->back();
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

            'nama_status' => 'required'
        ]);

        $status = new Status();
        $status->nama_status = $validateData['nama_status'];
        $status->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
        $this->authorize('adminOnly', User::class);

        return view('status.show')->with('status', $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
        $this->authorize('adminOnly', User::class);

        // return view('status.edit')->with('status', $status);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        //
        $this->authorize('adminOnly', User::class);

        $this->validate($request, [
            'nama_status' => 'required'
        ]);

        $status = Status::findOrFail($status->id);

        $status->update([
            'nama_status' => $request->nama_status
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
        $this->authorize('adminOnly', User::class);

        // $status->delete();
        // return redirect()->route('statuses.index')->with('pesan', "Hapus data $status->nama_status berhasil");
        return redirect()->back();
    }
}
