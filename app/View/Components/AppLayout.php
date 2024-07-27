<?php

namespace App\View\Components;

use App\Models\Settings;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $logo = Settings::where('key','logo')->first() ?? null;
        $favicon = Settings::where('key','favicon')->first() ?? null;

        return view('layouts.app-layout',[
            'logo' => $logo,
            'favicon' => $favicon,
            ]);
    }
}
