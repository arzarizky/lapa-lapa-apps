<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $variable1 = "I am Data";

    public function __construct()
    {
        $variable2 = "I am Data 2";
        View::share('variable1', $this->variable1);
        View::share('variable2', $variable2);
        View::share('variable3', 'I am Data 3');
        View::share('variable4', ['name' => 'Franky', 'address' => 'Mars']);
    }
}
