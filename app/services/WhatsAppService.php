<?php

namespace App\Services;

use App\Models\Angsuran;
use App\Helpers\WhatsApp;

class WhatsAppService
{
    public function sendNotification(Angsuran $angsuran)
    {
        $nama   = $angsuran->pinjaman?->anggota?->nama_lengkap ?? 'Anggota';
        $no_hp  = $angsuran->pinjaman?->anggota?->no_hp ?? null;
        $nominal = number_format($angsuran->pinjaman?->kategori_angsuran?->nominal ?? 0, 0, ',', '.');
        $tgl_jatuh = $angsuran->tgl_jatuh_tempo ? date('d-m-Y', strtotime($angsuran->tgl_jatuh_tempo)) : '-';

        if (!$no_hp) {
            return false; // kalau no hp kosong
        }

        $pesan = "Halo $nama, \n"
            . "Anda memiliki angsuran bermasalah.\n"
            . "Nominal: Rp. $nominal\n"
            . "Jatuh tempo: $tgl_jatuh\n"
            . "Mohon segera melakukan pembayaran.";

        // Misal pakai helper whatsapp.php
        WhatsApp::send($no_hp, $pesan);

        return true;
    }
}
