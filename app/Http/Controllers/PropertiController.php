<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Properti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $properti = Properti::with(['kategori', 'user'])->paginate(10);

        return view('properti.index', [
            'properti' => $properti
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Properti $properti)
    {
        //
        return view('properti.detail', [
            'item' => $properti,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Properti $properti)
    {
        $kategori = DB::table('kategoris')->select('id', 'nama_kategori')->get();
        return view('properti.edit', [
            'item' => $properti,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Properti $properti)
    {
        //
        $data = $request->all();

        if ($request->file('gambar_properti')) {
            $link = $request->file('gambar_properti')->store('assets/properti', 'public');
            $data['gambar_properti'] = 'myproperti.go.yj.fr/public/storage/' . $link  ;
        }

        $properti->update($data);

        return redirect()->route('properti.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Properti $properti)
    {
        $properti->delete();

        return redirect()->route('properti.index');
    }
}
