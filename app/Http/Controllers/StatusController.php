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
        return view('status.create');
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
        return view('status.edit')->with('status', $status);
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
        $status->delete();
        return redirect()->route('statuses.index')->with('pesan', "Hapus data $status->nama_status berhasil");
    }
}
