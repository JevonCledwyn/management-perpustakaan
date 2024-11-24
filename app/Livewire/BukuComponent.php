<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Buku;
use App\Models\Kategori;


class BukuComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $kategori, $judul, $penulis, $penerbit, $isbn, $tahun, $jumlah, $search, $id;
    public function render()
    {
        if ($this->search != "") {
            $data['buku'] = Buku::where('judul', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $data['buku'] = Buku::paginate(10);
        }
        $data['category'] = Kategori::all();
        $layout['title'] = 'Manage Book';
        return view('livewire.buku-component', $data, $layout);
    }

    // Create User
    public function create()
    {
        $this->validate(rules: [
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'isbn' => 'required',
            'jumlah' => 'required',
        ]);
        Buku::create([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun' => $this->tahun,
            'isbn' => $this->isbn,
            'jumlah' => $this->jumlah,
        ]);
        $this->reset();
        session()->flash('success', 'Book Saved');
        return redirect()->route('buku');
    }

    // Edit / Update User
    public function edit($id)
    {
        $buku = Buku::find($id);
        $this->id = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori->id;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun = $buku->tahun;
        $this->isbn = $buku->isbn;
        $this->jumlah = $buku->jumlah;

    }

    public function update()
    {
        $buku = Buku::find($this->id);
        $buku->update([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun' => $this->tahun,
            'isbn' => $this->isbn,
            'jumlah' => $this->jumlah,
        ]);
        $this->reset();
        session()->flash('success', 'Book Updated');
        return redirect()->route('buku');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    // Delete User
    public function delete()
    {
        $buku = Buku::find($this->id);
        $buku->delete();
        $this->reset();
        session()->flash('success', 'Delete Book Successful');
        return redirect()->route('buku');
    }
}
