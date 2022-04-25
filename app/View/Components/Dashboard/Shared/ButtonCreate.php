<?php

namespace App\View\Components\Dashboard\Shared;

use Illuminate\View\Component;

class ButtonCreate extends Component
{
    public $name;
    public $url;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.shared.button-create');
    }
}
