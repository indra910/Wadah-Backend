<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //
    public function kategori(Request $request)
    {
        $id = $request->input('id');
        $kategori = Kategori::all();

        if ($id) {
            $kategori = Kategori::find($id);
            if ($kategori) {
                return ResponseFormatter::success(
                    $kategori,
                    'Data produk berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(null, 'Data produk tidak ada', 404);
            }
        }


        return ResponseFormatter::success(
            $kategori,
            'Data Terambil'
        );
    }
}
