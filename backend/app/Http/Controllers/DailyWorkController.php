<?php

namespace App\Http\Controllers;

use App\Models\DailyWork;
use Illuminate\Http\Request;

class DailyWorkController extends Controller
{
    public function index($day_of_week, $department) 
    {
        if($day_of_week !== '') {
            $daily_work = DailyWork::query()
            ->where('day_of_week', '=', $day_of_week)
            ->where('user_department', '=', $department)
            ->get();
        }
        
        return $daily_work;
    }

    public function store(Request $request) 
    {
        return DailyWork::create($request->all());
    }
}
