<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelectComponent extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $options;

    /**
     * @var string
     */
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, array $options, string $label)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-select-component');
    }
}
