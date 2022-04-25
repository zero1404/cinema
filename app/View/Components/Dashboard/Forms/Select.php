<?php

namespace App\View\Components\Dashboard\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $property;
    public $multiple;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $property, $multiple = false)
    {
        $this->name = $name;
        $this->property = $property;
        $this->multiple = $multiple;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.forms.select');
    }
}
