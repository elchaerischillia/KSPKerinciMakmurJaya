<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Services\WhatsAppService;

class AngsuranTerlambatWebController extends Controller
{
    public function notify($id, WhatsAppService $wa)
    {
        $angsuran = Angsuran::findOrFail($id);
        $wa->sendNotification($angsuran);

        return redirect()->back()->with('success', 'Pesan WhatsApp berhasil dikirim!');
    }
}
