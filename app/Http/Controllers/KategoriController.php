<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kategori::all();
        if (true) { // Ganti dengan kondisi yang sesuai
            // Kirim respon sukses dengan kode 201
            return response()->json(['message' => 'Get data successfuly', 'data' => $data,  'status' => 201], 201);
        } else {
            // Kirim respon error dengan kode 500
            return response()->json(['message' => 'data not found', 'status' => 500], 500);
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required',
            // Tambahkan validasi untuk setiap field yang diperlukan
        ]);

        // Simpan data ke database atau lakukan tindakan lain sesuai kebutuhan
        $data = new Kategori();
        $data->kategori = $request->input('kategori');
        $data->keterangan = $request->input('keterangan');

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $path = $gambar->store('uploads');
            $data->gambar = $path;
        }

        $data->save();
     
        if (true) { // Ganti dengan kondisi yang sesuai
            // Kirim respon sukses dengan kode 201
            return response()->json(['message' => 'Data created successfully', 'data' => $data, 'status' => 201], 201);
        } else {
            // Kirim respon error dengan kode 500
            return response()->json(['message' => 'Failed to create data', 'status' => 500], 500);
        }
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
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kategori::where('id', $id)->get();
        if (true) { // Ganti dengan kondisi yang sesuai
            // Kirim respon sukses dengan kode 201
            return response()->json(['data' => $data, 'message' => 'Get data successfuly', 'status' => 201], 201);
        } else {
            // Kirim respon error dengan kode 500
            return response()->json(['message' => 'data not found', 'status' => 500], 500);
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
   
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $this->validate($request, [
            'kategori' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required',
        ]);

        // Cari data berdasarkan ID
        $data = Kategori::find($id);

        // Jika data tidak ditemukan
        if (!$data) {
            return response()->json(['message' => 'Data not found', 'status' => 404], 404);
        }

        $data->kategori = $request->input('kategori');
        $data->keterangan = $request->input('keterangan');

        if ($request->hasFile('gambar')) {
            // Hapus file lama jika ada
            if ($data->gambar) {
                Storage::delete($data->gambar);
            }

            $gambar = $request->file('gambar');
            $path = $gambar->store('uploads');
            $data->gambar = $path;
        }

        $data->save();

        // Kirim respon sukses dengan kode 201
        return response()->json(['message' => 'Updated data successfully', 'data' => $data, 'status' => 201], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kategori::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data not found', 'status' => 404], 404);
        }

        // Hapus file terkait jika ada
        if ($data->gambar) {
            Storage::delete($data->gambar);
        }

        $data->delete();

        return response()->json(['message' => 'Data deleted successfully', 'status' => 200], 200);
    
    }
}
