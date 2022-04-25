<?php

namespace App\View\Components\Dashboard\Forms;

use Illuminate\View\Component;

class FormCreate extends Component
{
    public $name;
    public $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $route)
    {
        $this->name = $name;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.forms.form-create');
    }
}
