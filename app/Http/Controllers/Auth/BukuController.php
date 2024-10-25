<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;

class BukuController extends Controller
{
    public function adminBuku(Request $request){
        $search = $request->input('search');
                
        $data = Buku::where(function($query) use ($search) {
        $query->where('judul_buku', 'LIKE', '%' .$search. '%');})->paginate(5);
            return view('admin.buku', compact('data'));
            }
public function tambahBuku(){
    return view('admin.tambahBuku');
}
public function postTambahBuku(Request $request){
    $request->validate([
        'kodeBuku' => 'required',
        'judulBuku' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahunTerbit' => 'required|date',
        'gambar' => 'required|image|max:5120',
        'deskripsi' => 'required',
        'kategori' => 'required',
            ]);
    $buku = new Buku;

    $buku->kode_buku = $request->kodeBuku;
    $buku->judul_buku = $request->judulBuku;
    $buku->penulis = $request->penulis;
    $buku->penerbit = $request->penerbit;
    $buku->tahun_terbit = $request->tahunTerbit;
    $buku->deskripsi = $request-> deskripsi;
    $buku->kategori = $request-> kategori;

    if($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('images/', $filename);
        $buku->gambar = $filename;
        }

        $buku->save();

    if($buku) {
        return back()->with('success', 'Buku baru berhasil ditambahkan!');
        } 
    else{
        return back()->with('failed', 'Data gagal ditambahkan!');
        }
    }
public function editBuku($id) {
        $data = Buku::find($id);
        return view('admin.editBuku', compact('data'));
        }
public function postEditBuku(Request $request, $id) {
    $request->validate([
        'kodeBuku' => 'required',
        'judulBuku' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahunTerbit' => 'required',
        'gambar' => 'image|max:5120',
        'deskripsi' => 'required',
        'kategori' => 'required'
    ]);
        $buku = Buku::find($id);

        $buku->kode_buku = $request->kodeBuku;
        $buku->judul_buku = $request->judulBuku;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahunTerbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kategori = $request->kategori;

        if($request->hasFile('gambar')) {
            $filepath = 'images/'.$buku->gambar;
                if(File::exists($filepath)) {
                    File::delete($filepath);

                }
                
                $file = $request->file('gambar');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('images/', $filename);
                $buku->gambar = $filename;
            }
        $buku->save();

        if($buku) {
            return back()->with('success', 'Buku berhasil diupdate!');
        } 
        else{
            return back()->with('failed', 'Buku gagal diupdate!');
            }
        }
public function deleteBuku($id) {
    $buku = Buku::find($id);
    $filepath = 'images/'.$buku->gambar;

        if(File::exists($filepath)) {
            File::delete($filepath);
        }
        $buku->delete();
        if($buku){
            return back()->with('success', 'Data buku berhasil dihapus!');
        } 
        else {
            return back()->with('failed', 'Gagal menghapus data buku!');
            }
            }
}