<?php

namespace App\View\Components\Dashboard\Forms;

use Illuminate\View\Component;

class InputImage extends Component
{
    public $name;
    public $property;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $property, $value = null)
    {
        $this->name = $name;
        $this->property = $property;
        $this->value = $value;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.forms.input-image');
    }
}
