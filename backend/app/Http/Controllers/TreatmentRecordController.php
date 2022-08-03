<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TreatmentRecord;

class TreatmentRecordController extends Controller
{
    public function index($id) 
    {
        if(isset($id)) {
            $query = TreatmentRecord::select('treatment_records.*')
            ->where('factoryuser_id', '=', $id)
            ->whereNull('deleted_at')
            ->orderBy('day','desc');
        }
        $treatment_records = $query->get();
        return $treatment_records;
    }

    public function store(Request $request) 
    {
        return TreatmentRecord::create($request->all());
    }

    public function show($id)
    {

        return TreatmentRecord::find($id);
    }

    public function update(Request $request, $id) 
    {
        $treatment_record = TreatmentRecord::find($id);
        $treatment_record->update($request->all());
        
        return $treatment_record;
    }

    public function serch($id, $treatment_keyword) 
    {
        if(isset($id)) {
            $query = TreatmentRecord::query()
            ->where('factoryuser_id', '=', $id)
            ->where('treatment_value', 'like', "%{$treatment_keyword}%")
            ->orderBy('day','desc');
        }

        $treatment = $query->get();

        return $treatment;
    } 
    
    public function delete($id) 
    {
        $treatment = TreatmentRecord::find($id);
        $treatment->delete();

        return $treatment;   
    }
}
