<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonMain extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title,$adress;

    public function __construct($title,$adress="")
    {
        $this->title = $title;
        $this->adress = $adress;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-main');
    }
}
