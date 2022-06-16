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
            $query = Archive::query()
            ->where('day', '=', $day)
            ->orderBy('factoryuser_number','asc');
        }

        $archive = $query->get();

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

    public function delete(Archive $archive)
    {
       $archive->delete();

        return $archive;
    }
}
