<?php

namespace App\Http\Livewire\App;

use Livewire\Component;
use App\Traits\Fields\DashboardFields;

class Dashboard extends Component
{
    use DashboardFields;

    public $displaySecondModal= false;
    public $selectedObituary = false;
    public $selectedTemplate;

    public function render()
    { 
        return view('livewire.app.dashboard');
    }

    public function proceedToSecondPage ()
    {
        dd('tadang');
    }
}
