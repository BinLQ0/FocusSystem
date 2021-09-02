<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class SidebarMenu extends Component
{
    /**
     * Set url to redirect
     * 
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $permission;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = 'Menu', string $url = '#', string $icon = 'fas fa-circle nav-icon', string $can = null)
    {
        $this->label    = $label;
        $this->icon     = $icon;
        $this->url      = $url;
        $this->permission = $can;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->permission) {
            if (!auth()->user()->can($this->permission)) {
                return;
            }
        }
        
        return view('components.layout.sidebar-menu');
    }
}
