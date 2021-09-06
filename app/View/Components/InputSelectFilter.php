<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelectFilter extends Component
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
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, array $options, $type = null)
    {
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-select-filter');
    }
}
