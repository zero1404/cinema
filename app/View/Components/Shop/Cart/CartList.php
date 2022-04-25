<?php

namespace App\View\Components\Shop\Cart;

use Illuminate\View\Component;

class CartList extends Component
{
    public $carts;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($carts)
    {
        $this->carts = $carts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shop.cart.cart-list');
    }
}
