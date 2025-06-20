<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public $options;
    public $name;
    public $id;
    public $label;
    public $valueField;
    public $textField;
    public $selected;
    public function __construct($options, $name, $label = null, $id = null, $valueField = 'id', $textField = 'nome', $selected = null)
    {
        $this->options = $options;
        $this->name = $name;
        $this->id = $id;
        $this->label = $label;
        $this->valueField = $valueField;
        $this->textField = $textField;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}