<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Faq;
use App\Models\Pengumuman;
use App\Models\Struktur; 
use App\Models\Kontak;

class HomeController extends Controller
{
    public function index()
    {
        
        $galeris = Galeri::latest()->limit(6)->get();
        $pengumumen = Pengumuman::where('status', 'aktif')->latest()->limit(5)->get();
        $faqs = Faq::where('status', 'aktif')->orderBy('urutan')->get();
        $strukturs = Struktur::all(); // <-- Tambahkan ini

        // Tambahkan $strukturs ke view
        return view('home', compact('strukturs', 'galeris', 'pengumumen', 'faqs'));
    }

    public function galeri()
    {
        $galeris = Galeri::latest()->get();
        return view('galeri', compact('galeris'));
    }

    public function pengumuman()
    {
        $pengumumen = Pengumuman::latest()->get();
        return view('pengumuman', compact('pengumumen'));
    }

    public function faq()
    {
        $faqs = Faq::latest()->get();
        return view('faq', compact('faqs'));
    }

    public function contact()
    {
        $kontak = Kontak::first();
        return view('contact', compact('kontak'));
    }
}
