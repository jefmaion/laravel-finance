<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{

    public $route;
    public $header;
    public $dataList;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $header, $data)
    {
        $this->route = $route;
        $this->header = $header;
        $this->dataList = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }
}
