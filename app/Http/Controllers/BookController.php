<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Alert;
use Auth;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->level != 'admin'){
            Alert::warning('Oopss..', 'Kamu Tidak Boleh Mengakses Halaman Itu');
            return redirect('/home');
        }

        $book = Book::orderBy('id', 'DESC')->paginate(10);
        return view('book/index', compact('book'));
    }

    public function save(Request $request){
        $this->validate($request,[
            'isbn' => 'required|numeric',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $file = $request->file('cover');
        $name_file = time()."_".$file->getClientOriginalName();
        

        $destination = 'img/book';
        $file->move($destination, $name_file);

        Book::create([
            'judul' => $request->judul,
            'isbn' => $request->isbn,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_buku' => $request->jumlah_buku,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'cover' => $name_file,
        ]);
        Alert::success('Sukses', 'Sukses Menambahkan Data');
        return redirect()->route('book');
    }

    public function update(Request $request, $id) {
        if($request->file('cover')) {
            $file = $request->file('cover');
            $acak  = $file->getClientOriginalExtension();
            $fileName = time().'-'.$acak; 
            $request->file('cover')->move("img/book", $fileName);
            $cover = $fileName;
        } else {
            $cover = $request->cover_lama;
        }

        Book::find($id)->update([
                'judul' => $request->judul,
                'isbn' => $request->isbn,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'jumlah_buku' => $request->jumlah_buku,
                'deskripsi' => $request->deskripsi,
                'lokasi' => $request->lokasi,
                'cover' => $cover,
                ]);

        Alert::success('Berhasil.','Data telah diubah!');
        return redirect()->route('book');
    }

    public function delete($id) {
        $data = Book::find($id);
        $image_path = public_path().'/img/book/'.$data->cover;
        unlink($image_path);
        $data->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect()->route('book');
    }
}
