<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    public function index()
    {
        try{
            return view('welcome');
        }catch (\Exception $ex){
            Log::error($ex->getMessage());
        }
    }

    public function dashboard()
    {
        try{
            return view('frontend.dashboard');
        }catch (\Exception $ex){
            Log::error($ex->getMessage());
        }
    }
}