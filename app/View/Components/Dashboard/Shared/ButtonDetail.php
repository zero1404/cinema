<?php

namespace App\View\Components\Dashboard\Shared;

use Illuminate\View\Component;

class ButtonDetail extends Component
{
    public $id;
    public $edit;
    public $delete;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $edit, $delete)
    {
        $this->id = $id;
        $this->edit = $edit;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.shared.button-detail');
    }
}
