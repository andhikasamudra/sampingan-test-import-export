<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $per_page = 15;

    protected function getPageCountNumber($page)
    {
        return $page ? $page != 1 ? (($page - 1) * $this->per_page + 1) : 1 : 1;
    }
}
