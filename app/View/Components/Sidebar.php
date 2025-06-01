<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    protected $user;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = auth('web')->user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar', [
            'isAdmin' => $this->user->is_admin,
        ]);
    }
}
