<?php

namespace App\Http\Controllers\Backsite;

use App\Models\Angsuran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AngsuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $angsuran = Angsuran::with('pinjaman.kategori_angsuran')
                        ->where('status', 'Terlambat')
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->map(function ($item) {
                            // ambil cicilan per bulan langsung dari kategori angsuran
                            $item->cicilan = $item->pinjaman->kategori_angsuran->nominal ?? 0;
                            return $item;
                        });

    return view('pages.angsuran.angsuran-bermasalah', compact('angsuran'));
}





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $angsuran = Angsuran::with('pinjaman')
                            ->findOrFail($id);

        return view('pages.angsuran.detail', compact('angsuran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
