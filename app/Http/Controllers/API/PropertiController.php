<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Properti;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PropertiController extends Controller
{
    //
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $kategori = $request->input('kategori_id');
        $namaKategori = $request->input('nama_kategori');
        $user_id = $request->input('user_id');

        if ($id) {
            $properti = Kategori::find($id);

            if ($properti)
                return ResponseFormatter::success(
                    $properti,
                    'Data produk berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
        }
        $properti = Properti::with(['user', 'kategori']);


        if ($name)
            $properti->where('name', 'like', '%' . $name . '%');
        if ($kategori)
            $properti->where('kategori_id', '=',  $kategori);

        if ($namaKategori)
            $properti->where('nama_kategori', '=', $namaKategori);
        if ($user_id)
            $properti->where('user_id', '=', $user_id);


        return ResponseFormatter::success(
            $properti->inRandomOrder()->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }

    //
    public function properti_user(Request $request, $user_id)
    {
        $properti = Properti::with(['user', 'kategori'])->where('user_id', '=', $user_id)->first();


        // return ResponseFormatter::success($properti, 'Properti User');

        if ($properti)
            return ResponseFormatter::success(
                $properti,
                'Data produk berhasil diambil'
            );
        else
            return ResponseFormatter::error(
                0,
                'Data produk tidak ada',
                404
            );
    }

    //Tambah Properti
    public function add_properti(Request $request)
    {


        try {
            $request->validate([
                'user_id' => 'required|exists:users,id', 'integer', 'unique:users',
                'kategori_id' => 'required|exists:kategoris,id', 'integer',
                'nama_properti' => 'required', 'string',
                'deskripsi' => 'required',
                'alamat' => 'required',
                'kota' => 'required',
                'lat_properti' => 'required',
                'long_properti' => 'required',
            ]);

            $dft_properti = Properti::create([
                'user_id' => $request->user_id,
                'kategori_id' => $request->kategori_id,
                'nama_properti' => $request->nama_properti,
                'deskripsi' => $request->deskripsi,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'gambar_properti' => $request->gambar_properti,
                'lat_properti' => $request->lat_properti,
                'long_properti' => $request->long_properti
            ]);
            $dft_properti = Properti::with(['user', 'kategori'])->find($dft_properti->id);
            return ResponseFormatter::success([

                $dft_properti,
            ]);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Aunthentication Failed', 500);
        }
    }

    public function updatePhotoProperti(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|max:5400'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors()
            ], 'Update photo fails', 401);
        }

        if ($request->file('file')) {
            $file = $request->file->store('assets/properti', 'public');

            //simpan foto ke database (urlnya)



            return ResponseFormatter::success([
                $file
            ], 'File successfully uploaded');
        }
    }

    public function updateProperti(Request $request, $properti_id)
    {
        $properti = Properti::with(['user', 'kategori'])->find($properti_id);
        $properti->update($request->all());

        return ResponseFormatter::success($properti, 'Properti Updated');
    }

    public function deleteProperti(Properti $properti, $user_id)
    {
        $properti->where('user_id', '=', $user_id)->delete();
        // $properti = Properti::whare('user_id,);


        return ResponseFormatter::success($properti, 'Berhasil di Hapus');
    }
}
