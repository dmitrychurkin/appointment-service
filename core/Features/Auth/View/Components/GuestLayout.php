<?php

namespace Core\Features\Auth\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

final class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
