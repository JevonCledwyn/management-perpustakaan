<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\Pengembalian;
use App\Models\Pinjam;

class KembaliComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public $pinjam_id, $tgl_kembali, $denda, $search, $id;

    public function render()
    {
        if ($this->search != "") {
            $data['pengembalians'] = Pengembalian::with('pinjam')
                ->whereHas('pinjam.user', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
        } else {
            $data['pengembalians'] = Pengembalian::with('pinjam')->paginate(10);
        }

        $data['peminjaman'] = Pinjam::where('status', 'pinjam')->get();
        $layout['title'] = 'Manage Pengembalian';
        return view('livewire.kembali-component', $data, $layout);
    }

    // Create Pengembalian
    public function create()
    {
        $this->validate(rules: [
            'pinjam_id' => 'required|exists:pinjams,id',
            'tgl_kembali' => 'required|date',
            'denda' => 'nullable|numeric',
        ]);

        Pengembalian::create([
            'pinjam_id' => $this->pinjam_id,
            'tgl_kembali' => $this->tgl_kembali,
            'denda' => $this->denda ?? 0,
        ]);

        // Update status pinjam menjadi kembali
        $pinjam = Pinjam::find($this->pinjam_id);
        $pinjam->update(['status' => 'kembali']);

        $this->reset();
        session()->flash('success', 'Pengembalian Created');
        return redirect()->route('kembali');
    }

    // Edit Pengembalian
    public function edit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        $this->id = $pengembalian->id;
        $this->pinjam_id = $pengembalian->pinjam_id;
        $this->tgl_kembali = $pengembalian->tgl_kembali;
        $this->denda = $pengembalian->denda;
    }

    public function update()
    {
        $this->validate(rules: [
            'pinjam_id' => 'required|exists:pinjams,id',
            'tgl_kembali' => 'required|date',
            'denda' => 'nullable|numeric',
        ]);

        $pengembalian = Pengembalian::findOrFail($this->id);
        $pengembalian->update([
            'pinjam_id' => $this->pinjam_id,
            'tgl_kembali' => $this->tgl_kembali,
            'denda' => $this->denda ?? 0,
        ]);

        $this->reset();
        session()->flash('success', 'Pengembalian Updated');
        return redirect()->route('kembali');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    // Delete Pengembalian
    public function delete()
    {
        $pengembalian = Pengembalian::findOrFail($this->id);
        $pengembalian->delete();

        $this->reset();
        session()->flash('success', 'Pengembalian Deleted');
        return redirect()->route('kembali');
    }
}
