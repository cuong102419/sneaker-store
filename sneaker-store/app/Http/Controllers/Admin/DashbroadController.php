<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashbroadController extends Controller
{
    public function dashbroad() {
        return view('admin.dashbroad.index');
    }
}
