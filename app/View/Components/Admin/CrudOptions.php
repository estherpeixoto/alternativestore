<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class CrudOptions extends Component
{
    /**
     * The register id.
     *
     * @var string
     */
    public $id;

    /**
     * Create a new component instance.
     *
     * @param  string  $id
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.crud-options');
    }
}
