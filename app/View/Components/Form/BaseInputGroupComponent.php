<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class BaseInputGroupComponent extends Component
{
    /**
     * Bind linked data with the 'name' attribute to return a value.
     * 
     * @var mixed
     */
    public $bind;

    /**
     * Attribute is used to reference elements in a JavaScript, 
     * or to reference form data after a form is submitted.
     * 
     * @var string
     */
    public $name;

    /**
     * Acts as a caption for a specified element
     * 
     * @var string
     */
    public $label;

    /**
     * A Font Awesome icon.
     * Reference: https://fontawesome.com/
     * 
     * @var string
     */
    public $icon;

    /**
     * Extra classes for "input-group" element. This provides a way to
     * customize the input group container style.
     *
     * @var string
     */
    public $igroupClass;

    /**
     * Extra classes for the "form-group" element. This provides a way to
     * customize the main container style.
     *
     * @var string
     */
    public $fgroupClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = null, $icon = null, $fgroupClass, $igroupClass, $bind = null)
    {
        $this->name        = $name;
        $this->label       = $label;
        $this->icon        = $icon;
        $this->fgroupClass = $fgroupClass;
        $this->igroupClass = $igroupClass;
        $this->bind        = $bind;

        $this->RemoveBracketName();
    }

    /**
     * Create extra classes for the "form-group" element.
     */
    public function makeFormGroupClass()
    {
        $classes   = ['form-group'];
        $classes[] = $this->fgroupClass;

        return \implode(' ', $classes);
    }

    /**
     * Create extra classes for the "input-group" element.
     */
    public function makeInputGroupClass()
    {
        $classes   = ['input-group'];
        $classes[] = $this->igroupClass;

        return \implode(' ', $classes);
    }

    /**
     * Remove Bracket Array Name '[]'
     */
    public function RemoveBracketName(): void
    {
        $this->name = Str::before($this->name, '[');
    }

    /**
     * Get attribute 'value'
     */
    public function getValue()
    {
        $value = $this->attributes['type'] == 'number' ? 0 : '';

        // Old value
        $value = old($this->name, $value);

        // Bind Value
        $name  = $this->name;
        $value = optional($this->bind)->$name ?? $value;

        // Attributes Value
        $value = $this->attributes->get('value', $value);

        return $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.base-input-component');
    }
}
