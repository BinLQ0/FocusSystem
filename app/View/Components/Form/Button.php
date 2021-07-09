<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * @var string
     */
    public $url;

    /**
     * A Font Awesome icon.
     * Reference: https://fontawesome.com/
     * 
     * @var string
     */
    public $icon;

    /**
     * Acts as a caption for a specified element
     * 
     * @var string
     */
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, string $url = '#', string $icon = null)
    {
        $this->label    = $label;
        $this->icon     = $icon;
        $this->url      = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.button');
    }
}
