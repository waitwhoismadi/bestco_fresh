<?php

namespace App\Http\Livewire\Frontend\Portfolio;


use App\Http\Controllers\PortfolioController;
use App\Portfolio;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Gallery extends Component
{
    public $portfolios;
    public $user;
    public $delete_portfolio;

    public function mount($user){
        $this->portfolios = Portfolio::where('user_id',$user->id)->whereNotNull('pf_file')->get();
    }

    public function delete_portfolio($portfolio_id){

        $portfolio = Portfolio::find($portfolio_id);

        if(Storage::exists($portfolio->pf_file)){
            Storage::delete($portfolio->pf_file);
        }

        $portfolio->delete();

        $this->emit('flash_notification','Delete Portfolio Successfully','success');

        $this->delete_portfolio = $portfolio->id;

    }

    public function render()
    {
        return view('livewire.frontend.portfolio.gallery');
    }
}
