<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    protected $user;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = auth('web')->user()->load('profile');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar', [
            'profile' => $this->user->profile
        ]);
    }
}
