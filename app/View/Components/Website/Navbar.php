<?php

namespace App\View\Components\Website;

use App\Models\NavItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $menuItems;
    public $buttonItems;

    public function __construct()
    {
        // Get menu items (links and dropdowns)
        $this->menuItems = NavItem::with('children')
            ->parents()
            ->active()
            ->whereIn('type', ['link', 'dropdown'])
            ->orderBy('order')
            ->get();

        // Get button items (right side actions)
        $this->buttonItems = NavItem::parents()
            ->active()
            ->where('type', 'button')
            ->orderBy('order')
            ->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.website.navbar');
    }
}
