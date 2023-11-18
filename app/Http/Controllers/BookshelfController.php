<?php

namespace App\Http\Controllers;

use App\Models\Bookshelf;
use Illuminate\Http\Request;

class BookshelfController extends Controller
{
    public function index(){
        $data['bookshelfs'] = Bookshelf::all();
        return view('bookshelfs.index')->with($data);
    }

    public function create(){
        return view('bookshelfs.create');
    }

    public function store(Request $request){
       Bookshelf::create([
        'name' => $request->name,
        'code' => $request->code
       ]);
       $notification = [
        'message' => 'Data buku berhasil ditambahkan',
        'alert-type' => 'success'
        ];

        return redirect()->route('bookshelf.index')->with($notification);
    }

    public function edit($id){
        $data['bookshelf'] = Bookshelf::findOrFail($id);
        return view('bookshelfs.edit')->with($data);
    }

    public function update(Request $request, $id){
        $data = Bookshelf::findOrFail($id);
        $validated = $request->validate([
            'code' => ['integer', 'required'],
            'name' => ['string', 'required']
        ]);
        $data->update($validated);

        $notification = [
            'message' => 'Data buku berhasil diupdate',
            'alert-type' => 'success'
        ];

        return redirect()->route('bookshelf.index')->with($notification);
    }

    public function destroy(string $id)
    {
        $data = Bookshelf::findOrFail($id);
       //Storage::delete('public/cover_buku/'.$book->cover);

        $data->delete();
        $notification = array(
            'message' => 'Data buku berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('bookshelf.index')->with($notification);
    }
}
