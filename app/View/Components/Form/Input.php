<?php

namespace App\View\Components\Form;

class Input extends BaseInputGroupComponent
{
    /**
     * Set element input to be Daterange Picker
     */
    public $daterangepicker;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = null, $icon = null, $fgroupClass = null, $igroupClass = null, $bind = null, $daterangepicker = null)
    {
        parent::__construct($name, $label, $icon, $fgroupClass, $igroupClass, $bind);

        $this->setDateRangePicker($daterangepicker);
    }

    /**
     * Setup Date Range Picker
     * 
     * @return void
     */
    private function setDateRangePicker($value)
    {
        $this->daterangepicker = $value;

        if (isset($value)) {
            $this->icon = 'far fa-calendar-alt';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
