<?php

namespace App\Http\Controllers\API;

use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ArtikelController extends Controller
{
    //
    public function artikel(Request $request)
    {
        $id = $request->input('id');
        $artikel = Artikel::all();
        if ($id) {
            $artikel = Artikel::find($id);
            if ($kategori) {
                return ResponseFormatter::success(
                    $artikel,
                    'Data produk berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(null, 'Data produk tidak ada', 404);
            }
        }


        return ResponseFormatter::success(
            $artikel,
            'Data Terambil'
        );
    }

    // public function addArtikel(Request $request){
    //     try{
    //         $request->validate([
    //             'artikel_judul' => 'required',
    //             'url' => 'required',
    //             'artikel_gambar' => 'required',
    //         ])
    //         $addArtikel = Artikel::create([
    //             'artikel_judul' =>$request->artikel_judul,
    //             'url' => $request->artikel_gambar
    //         ])
    //     }
    // }
}
