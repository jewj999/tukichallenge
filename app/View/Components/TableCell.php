<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableCell extends Component
{
    public $th = false;
    public $class = "";
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $th = false, string $class = "")
    {
        $this->th = $th;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-cell');
    }
}
