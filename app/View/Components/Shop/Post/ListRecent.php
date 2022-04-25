<?php

namespace App\View\Components\Shop\Post;

use Illuminate\View\Component;

class ListRecent extends Component
{
    public $posts;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posts, $name)
    {
        $this->posts = $posts;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shop.post.list-recent');
    }
}
