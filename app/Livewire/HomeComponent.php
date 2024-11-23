<?php

namespace App\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $x['title']="Landing Page";
        return view('livewire.home-component')->layoutData($x);
    }
}
