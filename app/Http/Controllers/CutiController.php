<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cutis = Cuti::all();
        return view('cuti.index', compact('cutis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawan = Karyawan::all();

        return view('cuti.index', compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required',
            'tgl_cuti' => 'required|date',
            'lama_cuti' => 'required',
            'keterangan' => 'required',
        ]);

        Cuti::create($request->all());

        return redirect()->route('cutis.index')
            ->with('success', 'Cuti berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuti $cuti)
    {
        return view('cuti.edit', ['cuti' => $cuti]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuti $cuti)
    {
        $request->validate([
            'nomor_induk' => 'required',
            'tgl_cuti' => 'required|date',
            'lama_cuti' => 'required',
            'keterangan' => 'required',
        ]);

        $cuti->update($request->all());

        return redirect()->route('cutis.index')
            ->with('success', 'Cuti berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuti $cuti)
    {
        $cuti->delete();

        return redirect()->route('cutis.index')
            ->with('success', 'Cuti berhasil dihapus.');
    }
}
