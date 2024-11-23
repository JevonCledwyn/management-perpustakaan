<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User; // Tambahkan ini untuk mengimpor model User

class UserComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $nama, $email, $password, $id;

    public function render()
    {
        $layout['title'] = "Manage User";
        $data['user'] = User::paginate(10); // Mengambil data user dengan pagination
        return view('livewire.user-component', $data, $layout);
    }

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
    public function destroy()
    {
        $user = User::find($this->id);
        $user->delete();
        session()->flash('success','Delete Successful');
        $this->reset();
    }
}
