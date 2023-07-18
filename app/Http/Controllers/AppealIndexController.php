<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppealIndexController extends Controller
{
    //
    public function index(){

    $LicenceNumber = Auth::user()->licencenumber;

    // Fetch the appeals assigned to the judge based on their badgenumber
    $appeals = Appeal::where('licencenumber', $LicenceNumber)->get();
    
        return view('appeals.index',compact('appeals'));
    }
}