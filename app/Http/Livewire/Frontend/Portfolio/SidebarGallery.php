<?php

namespace App\Http\Livewire\Frontend\Portfolio;

use Livewire\Component;
use App\Portfolio;

class SidebarGallery extends Component
{
    public $portfolios;
    public $user;

    public function mount($user){
        $this->portfolios = Portfolio::where('user_id',$user->id)->whereNotNull('pf_file')->get();
    }

    public function render()
    {
        return view('livewire.frontend.portfolio.sidebar-gallery');
    }
}
