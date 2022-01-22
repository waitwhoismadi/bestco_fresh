<?php

namespace App\View\Components\jobs;

use Illuminate\View\Component;

class filter_sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $minprice;
     public $maxprice;
    public function __construct($minprice,$maxprice)
    {
        $this->minprice = $minprice;
        $this->maxprice = $maxprice;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.jobs.filter_sidebar');
    }
}
