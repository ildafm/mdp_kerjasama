<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
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

        $units = Unit::All();
        return view('unit.index')->with('units', $units);
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
        return view('unit.create')->with('units', $units);
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
            'nama_unit' => 'required',
            'parent_unit' => ''
        ]);

        $unit = new Unit();
        $unit->nama_unit = $validateData['nama_unit'];
        $unit->parent_unit = $validateData['parent_unit'];
        $unit->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('units.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
        $this->authorize('adminOnly', User::class);

        return view('unit.show')->with('unit', $unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
        $this->authorize('adminOnly', User::class);

        $units = Unit::All();
        return view('unit.edit')
            ->with('unit', $unit)
            ->with('units', $units);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
        $this->authorize('adminOnly', User::class);

        $this->validate($request, [
            'nama_unit' => 'required',
            'parent_unit' => ''
        ]);

        $unit = Unit::findOrFail($unit->id);

        $unit->update([
            'nama_unit' => $request->nama_unit,
            'parent_unit' => $request->parent_unit,
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
        $this->authorize('adminOnly', User::class);

        try {
            $unit->delete();
            return redirect()->route('units.index')->with('pesan', "Hapus data $unit->nama_unit berhasil");
        } catch (\Throwable $th) {
            return redirect()->route('units.index')->with('pesan_error', "Gagal menghapus data $unit->nama_unit");
        }
    }
}
