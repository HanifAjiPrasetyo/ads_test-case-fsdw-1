<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Resources\KaryawanResource;
use App\Http\Resources\SisaCutiResource;
use App\Http\Resources\KaryawanCutiResource;
use App\Http\Resources\FirstThreeKaryawanResource;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();

        $karyawanResource = KaryawanResource::collection($karyawans);

        return view('karyawan.index', ['karyawans' => $karyawanResource]);
    }

    public function firstThreeKaryawan()
    {
        $karyawans = Karyawan::orderBy('tgl_gabung')->take(3)->get();

        $karyawanResource = FirstThreeKaryawanResource::collection($karyawans);

        return view('karyawan.first-three', ['karyawans' => $karyawanResource]);
    }

    public function karyawanCuti()
    {
        $karyawans = Karyawan::whereHas('cutis')->withCount('cutis')->get();

        $karyawanResource = KaryawanCutiResource::collection($karyawans);

        return view('karyawan.pernah-cuti', ['karyawans' => $karyawanResource]);
    }

    public function sisaCuti()
    {
        $karyawans = Karyawan::leftJoin('cutis', 'karyawans.nomor_induk', '=', 'cutis.nomor_induk')
            ->select('karyawans.nomor_induk', 'karyawans.nama')
            ->selectRaw('12 - COALESCE(SUM(cutis.lama_cuti), 0) as sisa_cuti')
            ->groupBy('karyawans.nomor_induk', 'karyawans.nama')
            ->get();

        $karyawanResource = SisaCutiResource::collection($karyawans);

        return view('karyawan.sisa-cuti', ['karyawans' => $karyawanResource]);
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

        return redirect('/api/karyawan')->with('success', 'Karyawan berhasil ditambahkan');
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

        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required|date',
            'tgl_gabung' => 'required|date'
        ];

        if ($request->nomor_induk != $karyawan->nomor_induk) {
            $rules['nomor_induk'] = 'unique:karyawans';
        }

        $validatedData = $request->validate($rules);

        Karyawan::where('nomor_induk', $karyawan->nomor_induk)->update($validatedData);

        return redirect('/api/karyawan')->with('success', 'Karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect('/api/karyawan')->with('success', 'Karyawan berhasil dihapus');
    }
}
