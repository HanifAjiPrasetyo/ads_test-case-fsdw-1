<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();

        return view('karyawan.index', compact('karyawans'));
    }

    public function karyawanCuti()
    {
        $karyawans = Karyawan::withCount('cutis')->get();
        return response()->json($karyawans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    public function generateNomorInduk()
    {
        $latestKaryawan = Karyawan::latest()->first();

        if (!$latestKaryawan) {
            return 'IP06001';
        }

        $latestNomorInduk = $latestKaryawan->nomor_induk;
        $latestNumber = intval(substr($latestNomorInduk, 5)); // Mengambil 5 digit angka terakhir

        $newNumber = $latestNumber + 1;
        $newNomorInduk = 'IP06' . sprintf("%03d", $newNumber); // Menggunakan 3 digit angka dengan leading zeros

        return $newNomorInduk;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_induk' => 'required|unique:karyawans',
            'nama' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required|date',
            'tgl_gabung' => 'required|date'
        ]);

        $data['nomor_induk'] = $this->generateNomorInduk();

        Karyawan::create($data);

        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        // $karyawan = Karyawan::findOrFail($karyawan);
        return response()->json($karyawan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', ['karyawan' => $karyawan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {

        $data = $request->validate([
            'nomor_induk' => 'required|unique:karyawans',
            'nama' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required|date',
            'tgl_gabung' => 'required|date'
        ]);

        Karyawan::where('nomor_induk', $karyawan->nomor_induk)->update($data);

        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil dihapus.');
    }
}
