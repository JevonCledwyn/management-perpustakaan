<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Kategori;

class KategoriComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama, $id, $deskripsi, $search;
    public function render()
    {
        if ($this->search != "") {
            $data['categories'] = Kategori::where('nama', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $data['categories'] = Kategori::paginate(10);
        }
        $layout['title'] = 'Manage Member';
        return view('livewire.kategori-component', $data, $layout);
    }

    // Create User
    public function create()
    {
        $this->validate(rules: [
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        Kategori::create([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('success', 'Saved Category');
        return redirect()->route('categories');
    }

    // Edit / Update User
    public function edit($id)
    {
        $categories = Kategori::find($id);
        $this->id = $categories->id;
        $this->nama = $categories->nama;
        $this->deskripsi = $categories->deskripsi;
    }

    public function update()
    {
        $categories = Kategori::find($this->id);
        $categories->update([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
        ]);
        $this->reset();
        session()->flash('success', 'Category Updated');
        return redirect()->route('categories');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    // Delete User
    public function delete()
    {
        $categories = Kategori::find($this->id);
        $categories->delete();
        $this->reset();
        session()->flash('success', 'Delete Successful');
        return redirect()->route('categories');
    }
}
