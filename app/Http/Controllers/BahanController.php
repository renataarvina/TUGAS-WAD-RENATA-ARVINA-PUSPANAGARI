<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanController extends Controller
{
    // Halaman Beranda
    public function index()
    {
        $kategoriList = ['Deterjen', 'Pewangi', 'Pelembut'];

        $hasil = DB::table('bahan')
            ->select('kategori', 'satuan')
            ->selectRaw('SUM(stok) AS total')
            ->groupBy('kategori', 'satuan')
            ->get();

        $totalStok = [];

        foreach ($hasil as $row) {
            $kategori = $row->kategori;
            $satuan = $row->satuan;
            $total = (int) $row->total;

            if (!in_array($kategori, $kategoriList, true)) {
                $kategoriList[] = $kategori;
            }

            $totalStok[$kategori][$satuan] = $total;
        }

        return view('index', compact(
            'kategoriList',
            'totalStok'
        ));
    }

    // Halaman Daftar Bahan
    public function bahan()
    {
        $kategoriList = ['Deterjen', 'Pewangi', 'Pelembut'];

        $dataBahan = DB::table('bahan')
            ->orderBy('id', 'asc')
            ->get();

        return view('bahan', compact(
            'kategoriList',
            'dataBahan'
        ));
    }

    // Menambahkan Bahan
    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required|in:Deterjen,Pewangi,Pelembut',
            'merek' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|in:Liter,Kg,Botol',
        ]);

        $data['nama_bahan'] = $data['merek'];

        DB::table('bahan')->insert($data);

        return redirect()
            ->route('bahan.index')
            ->with('status', 'berhasil');
    }

    // Menghapus Bahan
    public function destroy($id)
    {
        $jumlah = DB::table('bahan')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('bahan.index')
            ->with(
                'status',
                $jumlah > 0 ? 'dihapus' : 'gagal'
            );
    }

    // Menampilkan Form Edit
    public function edit($id)
    {
        $bahan = DB::table('bahan')
            ->where('id', $id)
            ->first();

        if (!$bahan) {
            abort(404, 'Data bahan tidak ditemukan.');
        }

        return view('bahan-edit', compact('bahan'));
    }

    // Menyimpan Perubahan Bahan
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'kategori' => 'required|in:Deterjen,Pewangi,Pelembut',
            'merek' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|in:Liter,Kg,Botol',
        ]);

        $data['nama_bahan'] = $data['merek'];

        $jumlah = DB::table('bahan')
            ->where('id', $id)
            ->update($data);

        if ($jumlah === 0) {
            $ada = DB::table('bahan')
                ->where('id', $id)
                ->exists();

            if (!$ada) {
                abort(404, 'Data bahan tidak ditemukan.');
            }
        }

        return redirect()
            ->route('bahan.index')
            ->with('status', 'diperbarui');
    }
}