<?php

namespace App\Http\Controllers;

use App\Models\CompleteWorkCheck;
use Illuminate\Http\Request;

class CompleteWorkCheckController extends Controller
{
    public function index($day) 
    {
        $complete_work_check = CompleteWorkCheck::query()
        ->where('day', '=', $day)
        ->get();

        return $complete_work_check;
    }

    public function store(Request $request) 
    {
        return CompleteWorkCheck::create($request->all());
    }

    public function show($day, $staff_name) 
    {

        $complete_work_check = CompleteWorkCheck::query()
        ->where('day', '=', $day)
        ->where('staff_name', '=', $staff_name)
        ->get();

        return $complete_work_check;
    }

    public function update(Request $request, $day, $staff_name) 
    {
        $complete_work_check = CompleteWorkCheck::query()
        ->where('day', '=', $day)
        ->where('staff_name', '=', $staff_name)
        ->first();
        $complete_work_check->update($request->all());

        return $complete_work_check;
    }
}
