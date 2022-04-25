<?php

namespace App\View\Components\Dashboard\Shared;

use Illuminate\View\Component;

class ButtonAction extends Component
{
    public $id;
    public $show;
    public $edit;
    public $delete;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $show, $edit, $delete)
    {
        $this->id = $id;
        $this->show = $show;
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
        return view('components.dashboard.shared.button-action');
    }
}
