<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manuel;

class ManuelController extends Controller
{
    public function index($id) 
    {

        if(isset($id)) {
            $query = Manuel::query()
            ->where('factoryuser_id', '=', $id)
            ->orderBy('created_at','desc');;
        }

        $manuels = $query->get();

        return $manuels;
    }

    public function store(Request $request) 
    {
        return Manuel::create($request->all());
    }

    public function show($id)
    {

        return Manuel::find($id);
    }

    public function update(Request $request, Manuel $manuel) 
    {
        $manuel->update($request->all());
        
        return $manuel;
    }

    public function serch($id, $manuel_keyword) {

        if(isset($id)) {
            $query = Manuel::query()
            ->where('factoryuser_id', '=', $id)
            ->where('manuel_value', 'like', "%{$manuel_keyword}%")
            ->orderBy('created_at','desc');
        }

        $manuel = $query->get();

        return $manuel;
    }
    
    public function delete(Request $request, Manuel $manuel) 
    {
        $manuel->delete();

        return $manuel;   
    }
}
