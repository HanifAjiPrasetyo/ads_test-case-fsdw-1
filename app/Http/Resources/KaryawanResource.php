<?php

namespace App\Http\Resources;

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
            'tgl_lahir' => $this->tgl_lahir,
            'tgl_gabung' => $this->tgl_gabung,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
