<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PublicationCard extends Component
{
    public $publication;

    public function __construct($publication)
    {
        $this->publication = $publication;
    }

    public function render()
    {
        return view('components.publication-card');
    }
}
