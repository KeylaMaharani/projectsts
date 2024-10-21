<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
       $data = array(
         'title' => 'Data Barang',
         'data_jenis' => JenisBarang::all(),
         'data_barang' => Barang::join('tbl_jenis_barang', 'tbl_jenis_barang.id', '=', 'tbl_barang.id_jenis')
                                   ->select('tbl_barang.*', 'tbl_jenis_barang.nama_jenis')
                                   ->get()
       );

       //return view('index', $data);
       return view('admin.master.barang.list', $data);
    }

    public function store(Request $request)
    {
        // Bersihkan input id_jenis dari karakter yang tidak diinginkan
        $id_jenis = preg_replace('/[^\d]/', '', $request->input('id_jenis'));

        dd($request->all());

        // Validasi input setelah dibersihkan
        $request->validate([
            'id_jenis' => 'required|integer',
            'nama_barang' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        

        // Buat data barang baru
        Barang::create([
            'id_jenis'   => $id_jenis, // Gunakan $id_jenis yang telah dibersihkan
            'nama_barang' => $request->input('nama_barang'),
            'harga'       => $request->input('harga'),
            'stok'        => $request->input('stok'),
        ]);

        Log::info('Metode store dipanggil', $request->all());

        return redirect('/barang')->with('success', 'Data Berhasil Disimpan');
    }


    public function update(Request $request, $id)
    {
     Barang::where('id', $id)
       ->where('id', $id)
       ->update([
           'id_jenis'   => $request->id_jenis,
           'nama_barang' => $request->nama_barang,
           'harga'       => $request->harga,
           'stok'        => $request->stok,
       ]);
       return redirect('/barang')->with('success', 'Data Berhasil Di Ubah');
    }

    public function destroy($id)
    {
       Barang::where('id', $id)->delete();
       return redirect('/barang')->with('success', 'Data Berhasil Dihapus');
    }
}
