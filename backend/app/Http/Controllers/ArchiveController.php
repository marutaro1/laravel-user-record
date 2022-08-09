<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;

class ArchiveController extends Controller
{
    public function index($day) 
    {
        
        // return Archive::all();
        if(isset($day)) {
            $archive = Archive::query()
            ->where('day', '=', $day)
            ->orderByRaw('CAST(factoryuser_number as SIGNED) asc')
            ->get();
        }

        return $archive;
    }
    
    public function store(Request $request, $day) 
    {

        if(isset($day)) {
            $query = Archive::query()
            ->where('day', '=', $day)
            ->where('factoryuser_id', '=', $request['factoryuser_id'])
            ->get();
        }


        if($query->values()->all() !== []) { 
        
           $this->delete($query[0]);
        }
 
        return Archive::create($request->all());
    }

    public function show(Archive $archive) 
    {

        return Archive::find($archive['id']);
    }

    public function update(Request $request, Archive $archive) 
    {
        $archive->update($request->all());

        return $archive;
    }

    public function copy(Request $request, $day) 
    {

        if(isset($day)) {
            $query = Archive::query()
            ->where('day', '=', $day)
            ->where('factoryuser_id', '=', $request['factoryuser_id'])
            ->get();
        }

        if($query->values()->all() !== []) { 
        
           $this->delete($query[0]);
        }

        $request_copy_data = [];
        $request_copy_data_count = [];

        foreach($request->all() as $request_data) {
            $request_data['day'] = $day;
            array_push($request_copy_data, $request_data);
            array_push($request_copy_data_count, count($request_copy_data));
        }
        
        foreach($request_copy_data_count as $count) {
            Archive::create($request_copy_data[$count - 1]);
        }

        return;


        

    }

    public function delete(Archive $archive)
    {
       $archive->delete();

        return $archive;
    }
}
