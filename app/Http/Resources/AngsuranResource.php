<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AngsuranResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pinjaman_id' =>  $this->pinjaman->anggota->nama_lengkap,
            'tgl_jatuh_tempo' => $this->tgl_jatuh_tempo,
            'status' => $this->status,
        ];
    }
}
