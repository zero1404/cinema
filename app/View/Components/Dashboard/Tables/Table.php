<?php

namespace App\View\Components\Dashboard\Tables;

use Illuminate\View\Component;

class Table extends Component
{
    public $name;
    public $columns;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $columns, $value = [])
    {
        $this->name = $name;
        $this->columns = $columns;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.tables.table');
    }
}
