<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Resources\KaryawanResource;
use App\Http\Resources\SisaCutiResource;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();

        return KaryawanResource::collection($karyawans);
    }

    public function firstThreeKaryawan()
    {
        $karyawans = Karyawan::orderBy('tgl_gabung')->take(3)->get();

        return response()->json(['3 karyawan pertama gabung' => $karyawans]);
    }

    public function karyawanCuti()
    {
        $karyawans = Karyawan::whereHas('cutis')->withCount('cutis')->get();
        return response()->json(['karyawan yang pernah cuti' => $karyawans]);
    }

    public function sisaCuti()
    {
        $karyawans = Karyawan::leftJoin('cutis', 'karyawans.nomor_induk', '=', 'cutis.nomor_induk')
            ->select('karyawans.nomor_induk', 'karyawans.nama')
            ->selectRaw('12 - COALESCE(SUM(cutis.lama_cuti), 0) as sisa_cuti')
            ->groupBy('karyawans.nomor_induk', 'karyawans.nama')
            ->get();

        return SisaCutiResource::collection($karyawans);
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

        // Mengecek apakah sudah ada nomor induk sebelumnya
        if ($latestKaryawan) {
            $latestNomorInduk = $latestKaryawan->nomor_induk;
            $latestNumber = intval(substr($latestNomorInduk, 5));
        } else {
            $latestNumber = 0;
        }

        // Menentukan nomor induk baru
        $newNumber = $latestNumber + 1;

        // Loop hingga nomor induk yang dihasilkan unik
        do {
            $newNomorInduk = 'IP06' . sprintf("%03d", $newNumber);
            $existingKaryawan = Karyawan::where('nomor_induk', $newNomorInduk)->first();
            $newNumber++;
        } while ($existingKaryawan);

        return $newNomorInduk;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_induk' => 'unique:karyawans',
            'nama' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required|date',
            'tgl_gabung' => 'required|date'
        ]);

        $data['nomor_induk'] = $this->generateNomorInduk();

        Karyawan::create($data);

        return response()->json(['message' => 'Karyawan berhasil ditambahkan'], 201);
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
            'nomor_induk' => 'unique:karyawans',
            'nama' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required|date',
            'tgl_gabung' => 'required|date'
        ]);

        $data = Karyawan::where('nomor_induk', $karyawan->nomor_induk)->update($data);

        return response()->json(['message' => 'Karyawan berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return response()->json(['message' => 'Karyawan berhasil dihapus']);
    }
}
