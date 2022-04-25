<?php

namespace App\View\Components\Dashboard\Forms;

use Illuminate\View\Component;

class FormEdit extends Component
{
    public $name;
    public $route;
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $route, $id)
    {
        $this->name = $name;
        $this->route = $route;
        $this->id = $id;
    }   

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.forms.form-edit');
    }
}
