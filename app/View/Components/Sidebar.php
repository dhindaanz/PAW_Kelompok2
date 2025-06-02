<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    protected $isAdmin;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->isAdmin = auth('web')->user()->is_admin;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar', [
            'isAdmin' => $this->isAdmin,
        ]);
    }
}
