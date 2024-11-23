<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User; // Tambahkan ini untuk mengimpor model User

class UserComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $nama, $email, $password, $id, $search;

    public function render()
    {
        $layout['title'] = "Manage User";
        if ($this->search != "") {
            $data['user'] = User::where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->paginate(10);
        } else {
            $data['user'] = User::paginate(10);
        }
        return view('livewire.user-component', $data, $layout);
    }

    // Create User
    public function create()
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        User::create([
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => $this->password,
            'jenis' => 'admin'
        ]);

        session()->flash('success', 'User Created');
        $this->reset();
    }

    // Edit / Update User
    public function edit($id)
    {
        $user = User::find($id);
        $this->nama = $user->nama;
        $this->email = $user->email;
        $this->id = $user->id;
    }

    public function update()
    {
        $user = User::find($this->id);
        if ($this->password == "") {
            $user->update([
                'nama' => $this->nama,
                'email' => $this->email,
            ]);
        } else {
            $user->update([
                'nama' => $this->nama,
                'email' => $this->email,
                'password' => $this->password,
            ]);
        }
        session()->flash('success', 'User Updated');
        $this->reset();
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    // Delete User
    public function delete()
    {
        $user = User::find($this->id);
        $user->delete();
        session()->flash('success', 'Delete Successful');
        $this->reset();
    }
}
