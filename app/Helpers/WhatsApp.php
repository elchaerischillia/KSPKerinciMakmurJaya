<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class WhatsApp
{
    /**
     * Kirim pesan WhatsApp
     */
    public static function send($no_hp, $pesan)
    {
        // pastikan no hp diawali 62 (Indonesia)
        $no_hp = preg_replace('/^0/', '62', $no_hp);

        // contoh pakai API Fonnte (ubah sesuai provider WA Gateway kamu)
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $no_hp,
            'message' => $pesan,
        ]);

        return $response->successful();
    }
}
