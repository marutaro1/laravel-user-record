<?php

namespace App\Http\Controllers;

use App\Models\StaffDailyWork;
use Illuminate\Http\Request;

class StaffDailyWorkController extends Controller
{
    public function index($day, $department) 
    {
        if($day !== '') {
            $staff_daily_work = StaffDailyWork::query()
            ->where('day', '=', $day)
            ->where('department', '=', $department)
            ->get();
        }

        return $staff_daily_work;
    }

    public function store(Request $request) 
    {
        return StaffDailyWork::create($request->all());
    }

    public function show($day, $department, $staff_name) 
    {
        if($day !== '') {
            $staff_daily_work = StaffDailyWork::query()
            ->where('day', '=', $day)
            ->where('department', '=', $department)
            ->where('staff_name', '=', $staff_name)
            ->get();
        }

        return $staff_daily_work;
    }
}
