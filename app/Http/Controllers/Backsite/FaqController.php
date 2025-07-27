<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::orderBy('urutan')->get();
        return view('pages.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'urutan' => 'nullable|integer',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        Faq::create($request->all());

        return redirect()->route('faq.index')
            ->with('success', 'Data FAQ berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        return view('pages.faq.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        return view('pages.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'urutan' => 'nullable|integer',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $faq->update($request->all());

        return redirect()->route('faq.index')
            ->with('success', 'Data FAQ berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faq.index')
            ->with('success', 'Data FAQ berhasil dihapus.');
    }
}
