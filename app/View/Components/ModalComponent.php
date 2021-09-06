<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalComponent extends Component
{
    /**
     * @var string
     */
    public $showModal;

    /**
     * @var string
     */
    public $action;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $showModal, $action = null)
    {
        $this->showModal = $showModal;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-component');
    }
}
