<?php

namespace App\Http\Controllers\PartnerHome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerHomeController extends Controller
{
    function dashboard(){
        return view('partners.index');
    }
}
