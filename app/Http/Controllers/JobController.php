<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\SendTaskEmail;

class JobController extends Controller
{
    public function processQueue()
    {
        $emailJob = new SendTaskEmail();
        dispatch($emailJob);
    }
}
