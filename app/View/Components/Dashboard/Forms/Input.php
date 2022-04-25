<?php

namespace App\View\Components\Dashboard\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $property;
    public $type;
    public $placeholder;
    public $value;
    public $min;
    public $max;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $property, $type = 'text', $placeholder, $value, $min = 0, $max = PHP_INT_MAX)
    {
        $this->name = $name;
        $this->property = $property;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.forms.input');
    }
}

