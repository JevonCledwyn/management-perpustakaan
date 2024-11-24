<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;

class PinjamComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public $user, $buku, $tgl_pinjam, $tgl_kembali, $status, $search, $id;

    public function render()
    {
        if ($this->search != "") {
            $data['pinjam'] = Pinjam::with('user', 'buku')
                ->whereHas('user', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
        } else {
            $data['pinjam'] = Pinjam::with('user', 'buku')->paginate(10);
        }

        $data['member'] = User::where('jenis', 'member')->get();
        $data['book'] = Buku::all();
        $layout['title'] = 'Borrow Book';
        return view('livewire.pinjam-component', $data, $layout);
    }

    // Create Borrow
    public function create()
    {
        $this->validate(rules: [
            'buku' => 'required|exists:bukus,id',
            'user' => 'required|exists:users,id',
        ]);

        $now = date('Y-m-d');
        $kembali = date('Y-m-d', strtotime($now . '+7 days'));

        Pinjam::create([
            'user_id' => $this->user,
            'buku_id' => $this->buku,
            'tgl_pinjam' => $now,
            'tgl_kembali' => $kembali,
            'status' => 'pinjam',
        ]);

        $this->reset();
        session()->flash('success', 'Borrow Record Created');
        return redirect()->route('pinjam');
    }

    // Edit Borrow
    public function edit($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        $this->id = $pinjam->id;
        $this->user = $pinjam->user_id;
        $this->buku = $pinjam->buku_id;
        $this->tgl_pinjam = $pinjam->tgl_pinjam;
        $this->tgl_kembali = $pinjam->tgl_kembali;
        $this->status = $pinjam->status;
    }

    public function update()
    {
        $this->validate(rules: [
            'buku' => 'required|exists:bukus,id',
            'user' => 'required|exists:users,id',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam',
            'status' => 'required|string',
        ]);

        $pinjam = Pinjam::findOrFail($this->id);
        $pinjam->update([
            'user_id' => $this->user,
            'buku_id' => $this->buku,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'status' => $this->status,
        ]);

        $this->reset();
        session()->flash('success', 'Borrow Record Updated');
        return redirect()->route('pinjam');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    // Delete Borrow
    public function delete()
    {
        $pinjam = Pinjam::findOrFail($this->id);
        $pinjam->delete();

        $this->reset();
        session()->flash('success', 'Borrow Record Deleted');
        return redirect()->route('pinjam');
    }
}
