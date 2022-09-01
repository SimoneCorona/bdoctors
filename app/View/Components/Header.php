<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    //variabili da inserire dentro l header 
    public $link1;
    public $href1;
    public $link2;
    public $href2;
    public $link3;
    public $href3;

    public function __construct($link1, $href1,  $link2, $href2, $link3, $href3)
    {
        $this->link1 = $link1;
        $this->href1 = $href1;
        $this->link2 = $link2;
        $this->href2 = $href2;
        $this->link3 = $link3;
        $this->href3 = $href3;
    }

    public function boot()
    {
    Blade::component('header', AlertComponent::class);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.header');
    }
}
