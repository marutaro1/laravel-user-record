<?php

namespace App\Http\Controllers;

use App\Models\Factoryuser;
use Illuminate\Http\Request;

class FactoryuserController extends Controller
{
    public function index() 
    {
        $query = Factoryuser::query()->orderBy('number','asc');
        $factoryusers = $query->get();

        return $factoryusers;
    }

    public function store(Request $request) 
    {
        return Factoryuser::create($request->all());
    }

    public function check($day)
    {
        $query = Factoryuser::query()->where('day_record_check', '!=', $day)->orderBy('number','asc');
        $factoryusers = $query->get();

        return $factoryusers;
    }

    public function show(Factoryuser $factoryuser) 
    {

        return Factoryuser::find($factoryuser);
    }

    public function update(Request $request, Factoryuser $factoryuser) 
    {
        $factoryuser->update($request->all());

        return $factoryuser;
    }
    
    public function serch($day, $factoryuser_keyword, $floor_keyword, $care_level_keyword) {

    
         if($floor_keyword !== '・') {
             $number = $floor_keyword * 1000 + 1000;
             $under_number = $number - 1001;
         }
       

          if(Factoryuser::where('day_record_check', '=', "%{$day}%")->first() === null) {

              if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first() ) {
                    $query = Factoryuser::query()
                    ->where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")
                    ->where('number', '>', $under_number)
                    ->where('number', '<', $number)
                    ->where('care_level', 'like', "%{$care_level_keyword}%")
                    ->orderBy('number','asc');
      
                } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() === null && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first()) {
                    $query = Factoryuser::query()
                    ->where('factoryuser_name', '=', "%{$factoryuser_keyword}%")
                    ->where('number', '>', $under_number)
                    ->where('number', '<', $number)
                    ->where('care_level', 'like', "%{$care_level_keyword}%")
                    ->orderBy('number','asc');
            
                } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() === null && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first() === null) {
                    $query = Factoryuser::query()
                    ->where('factoryuser_name', '=', "%{$factoryuser_keyword}%")
                    ->where('number', '>', $under_number)
                    ->where('number', '<', $number)
                    ->orderBy('number','asc');
                    
                } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() === null && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() === null && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first()) {
                    $query = Factoryuser::query()
                    ->where('factoryuser_name', '=', "%{$factoryuser_keyword}%")
                    ->where('care_level', 'like', "%{$care_level_keyword}%")
                    ->orderBy('number','asc');
                    
                } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first() === null ) {
                               
                    $query = Factoryuser::query()
                    ->where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")
                    ->where('number', '>', $under_number)
                    ->where('number', '<', $number)
                    ->orderBy('number','asc');
                    
                } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() === null && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first() === null ) {
                    $query = Factoryuser::query()
                    ->where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")
                    ->orderBy('number','asc');
                    
                } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first()  && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() === null && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first()) {
                    $query = Factoryuser::query()
                    ->where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")
                    ->where('care_level', 'like', "%{$care_level_keyword}%")
                    ->orderBy('number','asc');                    
              } 

          } else if(Factoryuser::where('day_record_check', '=', "%{$day}%")->first() !== null ) {
            if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first() ) {
                $query = Factoryuser::query()
                ->where('day_record_check', '!=', "$day")
                ->where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")
                ->where('number', '>', $under_number)
                ->where('number', '<', $number)
                ->where('care_level', 'like', "%{$care_level_keyword}%")
                ->orderBy('number','asc');
                
            } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() === null && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() === null && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first() === null) {
                $query = Factoryuser::query()
                ->where('day_record_check', '!=', $day)
                ->where('factoryuser_name', '=', $factoryuser_keyword);
                
            } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() === null && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first()) {
                $query = Factoryuser::query()
                ->where('day_record_check', '!=', $day)
                ->where('factoryuser_name', '=', "%{$factoryuser_keyword}%")
                ->where('number', '>', $under_number)
                ->where('number', '<', $number)
                ->where('care_level', 'like', "%{$care_level_keyword}%")
                ->orderBy('number','asc');
                
            } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() === null && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first() === null) {
                $query = Factoryuser::query()
                ->where('factoryuser_name', '=', "%{$factoryuser_keyword}%")
                ->where('day_record_check', '!=', $day)
                ->where('number', '>', $under_number)
                ->where('number', '<', $number)
                ->orderBy('number','asc');
                
            } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() === null && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() === null && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first()) {
                $query = Factoryuser::query()
                ->where('factoryuser_name', '=', "%{$factoryuser_keyword}%")
                ->where('day_record_check', '!=', $day)
                ->where('care_level', 'like', "%{$care_level_keyword}%")
                ->orderBy('number','asc');
                
            } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first() === null ) {
                $query = Factoryuser::query()
                ->where('day_record_check', '!=', $day)
                ->where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")
                ->where('number', '>', $under_number)
                ->where('number', '<', $number)
                ->orderBy('number','asc');
                
            } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first() && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() === null && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first() === null ) {
                $query = Factoryuser::query()
                ->where('day_record_check', '!=', $day)
                ->where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")
                ->orderBy('number','asc');
                
            } else if( Factoryuser::where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")->first()  && Factoryuser::where('number', 'like', "%{$floor_keyword}%")->first() === null && Factoryuser::where('care_level', 'like', "%{$care_level_keyword}%")->first()) {
                $query = Factoryuser::query()
                ->where('day_record_check', '!=', $day)
                ->where('factoryuser_name', 'like', "%{$factoryuser_keyword}%")
                ->where('care_level', 'like', "%{$care_level_keyword}%")
                ->orderBy('number','asc');                    
            }  
        }

        // dd($query->get());
       
            $record = $query->get();

        return $record;
    }

}
