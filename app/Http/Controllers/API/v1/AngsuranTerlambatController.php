<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Angsuran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AngsuranResource;

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
}
