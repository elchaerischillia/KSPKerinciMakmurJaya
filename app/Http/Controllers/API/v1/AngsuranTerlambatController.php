<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Angsuran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AngsuranResource;
use Illuminate\Support\Facades\Http;

class AngsuranTerlambatController extends Controller
{
    public function index()
    {
        $angsuran = Angsuran::with('pinjaman')->where('status', 'Terlambat')->get();
        return AngsuranResource::collection($angsuran);
    }

    public function show($id)
    {
        $angsuran = Angsuran::with('pinjaman')->findOrFail($id);
        return new AngsuranResource($angsuran);
    }

    // 🔔 Kirim Notifikasi WhatsApp via helper
   public function notify($id, WhatsAppService $wa)
    {
        $angsuran = Angsuran::findOrFail($id);
        $wa->sendNotification($angsuran);

        return response()->json(['success' => true, 'message' => 'Notifikasi WA dikirim']);
    }
}