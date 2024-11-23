<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MemberComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';
    public $nama, $telepon, $email, $alamat, $password, $search, $id;
    public function render()
    {
        if ($this->search != "") {
            $data['member'] = User::where('nama', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $data['member'] = User::where('jenis', 'member')->paginate(10);
        }
        $layout['title'] = 'Manage Member';
        return view('livewire.member-component', $data, $layout);
    }

    // Create User
    public function create()
    {
        $this->validate(rules: [
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ]);
        User::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'jenis' => 'member'
        ]);

        session()->flash('success', 'Member Created');
        return redirect()->route('member');
    }

    // Edit / Update User
    public function edit($id)
    {
        $member = User::find($id);
        $this->id = $member->id;
        $this->nama = $member->nama;
        $this->alamat = $member->alamat;
        $this->telepon = $member->telepon;
        $this->email = $member->email;
    }

    public function update()
    {
        $member = User::find($this->id);
            $member->update([
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'telepon' => $this->telepon,
                'email' => $this->email,
                'jenis' => 'member'
            ]);
        session()->flash('success', 'Member Updated');
        return redirect()->route('member');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    // Delete User
    public function delete()
    {
        $member = User::find($this->id);
        $member->delete();
        session()->flash('success', 'Delete Successful');
        return redirect()->route('member');
    }
}
