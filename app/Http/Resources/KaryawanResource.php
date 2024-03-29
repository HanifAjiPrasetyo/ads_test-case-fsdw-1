<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nomor_induk' => $this->nomor_induk,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'tgl_lahir' => Carbon::createFromFormat('Y-m-d', $this->tgl_lahir)->format('d-M-y'),
            'tgl_gabung' => Carbon::createFromFormat('Y-m-d', $this->tgl_gabung)->format('d-M-y')
        ];
    }
}
