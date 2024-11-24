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
    public $kategori, $judul, $penulis, $penerbit, $isbn, $tahun, $jumlah, $search;
    public function render()
    {
        if ($this->search != "") {
            $data['buku'] = Buku::where('judul', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $data['buku'] = Buku::paginate(10);
        }
        $data['kategori'] = Kategori::all();
        $layout['title'] = 'Manage Book';
        return view('livewire.buku-component', $data, $layout);
    }
}
