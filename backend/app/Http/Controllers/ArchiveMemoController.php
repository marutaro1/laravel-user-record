<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArchiveMemo;

class ArchiveMemoController extends Controller
{
    //
    public function index($day, $staff_id) 
    {
        
        if(isset($day)) {
            $archive_memo = ArchiveMemo::query()
            ->where('archive_memos.day', '=', $day)
            ->where('archive_memos.staff_id', '=', $staff_id)
            ->get();
        }

        return $archive_memo;
    }

    public function store(Request $request) 
    {
        return ArchiveMemo::create($request->all());
    }

    public function show($day, $staff, $factoryuser, $id) 
    {  
       $archive_memo_data = ArchiveMemo::query()
       ->where('day', '=', $day)
       ->where('staff_id', '=', $staff)
       ->where('factoryuser_id', '=', $factoryuser)
       ->where('id', '=', $id)
       ->get();
       return $archive_memo_data;
    }

    public function delete($id)
    {
        $archive_memo_data = ArchiveMemo::find($id);
     
        $archive_memo_data->delete();


        return $archive_memo_data;
    }
}
