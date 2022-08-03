<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalHistory;

class MedicalHistoryController extends Controller
{
    public function index($id) 
    {
        $medical_histories = MedicalHistory::select('medical_histories.*')
        ->where('factoryuser_id', '=', $id)
        ->orderBy('day','desc')
        ->get();
        return $medical_histories;
    }

    public function store(Request $request) 
    {
        return MedicalHistory::create($request->all());
    }

    public function show($id)
    {

        return MedicalHistory::find($id);
    }

    public function update(Request $request, MedicalHistory $medical_history) 
    {
        $medical_history->update($request->all());
        
        return $medical_history;
    }

    public function serch($id, $medical_keyword, $history_keyword) {
     
        if(isset($id)) {
            if( MedicalHistory::where('medical', 'like', "%{$medical_keyword}%")->first() && MedicalHistory::where('medical_history_value', 'like', "%{$history_keyword}%")->first() ) {
                $query = MedicalHistory::query()
                ->where('factoryuser_id', '=', $id)
                ->where('medical', 'like', "%{$medical_keyword}%")
                ->where('medical_history_value', 'like', "%{$history_keyword}%")
                ->orderBy('day','desc');
            } else if( MedicalHistory::where('medical', 'like', "%{$medical_keyword}%")->first()  && $history_keyword === 'false') {
                $query = MedicalHistory::query()
                ->where('factoryuser_id', '=', $id)
                ->where('medical', 'like', "%{$medical_keyword}%")
                ->orderBy('day','desc');
            } else if( MedicalHistory::where('medical_history_value', 'like', "%{$history_keyword}%")->first() && $medical_keyword === 'false' ) {
                $query = MedicalHistory::query()
                ->where('factoryuser_id', '=', $id)
                ->where('medical_history_value', 'like', "%{$history_keyword}%")
                ->orderBy('day','desc');
            }
        }

        $history = $query->get();

        return $history;
    }
    
    public function delete(Request $request, MedicalHistory $medical_history) 
    {
        $medical_history->delete();

        return $medical_history;   
    }
}
