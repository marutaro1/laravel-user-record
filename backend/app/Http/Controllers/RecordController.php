<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Factoryuser;
use App\Models\UserIntermediaValue;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index($id, $day, $day_end) 
    {
        // $factoryuser_records = Record::select('records.*')
        // ->where('factoryuser_id', '=', $id)
        // ->whereNull('deleted_at')
        // ->get();
        // return $factoryuser_records;

        if(isset($id)) {
            $query = Record::query()
            ->where('factoryuser_id', '=', $id)
            ->where('day', '>=', $day)
            ->where('day', '<', $day_end)
            ->orderBy('day','desc');
        }

        $record = $query->get();

        return $record;
    }

    public function store(Request $request) 
    {
        return Record::create($request->all());
    }

    public function show(Record $record) 
    {
        // $factoryuser_id = Factoryuser::insertGetId(['id' => $id]);
        // $record_find = Record::find($record['id']);
        // $record_id = Record::insertGetId(['id' => $record_find]);
        // UserIntermediaValue::insert(['factoryuser_id' => $factoryuser_id, 'record_id' => $record_id]);
        return Record::find($record['id']);
    }

    public function serch($id, $record_keyword, $day, $day_end) {

        if(isset($id)) {
            $query = Record::query()
            ->where('factoryuser_id', '=', $id)
            ->where('record_value', 'like', "%{$record_keyword}%")
            ->where('day', '>=', $day)
            ->where('day', '<', $day_end)
            ->orderBy('day','desc');
        }

        $record = $query->get();

        return $record;
    }

    public function update(Request $request, $id)
    {
        $record = Record::find($id);
        $record->update($request->all());
        
        return $record;
    }
    public function delete($id)
    {
        $record = Record::find($id);
        $record->delete();

        return $record;   
    }

}
