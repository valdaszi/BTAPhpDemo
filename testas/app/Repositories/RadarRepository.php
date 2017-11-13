<?php

namespace App\Repositories;

use App\Radar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RadarRepository
{
    public function paginate($pagesize) 
    {
        return Radar::orderBy('date', 'desc')->orderBy('number')->paginate($pagesize);        
    }

    private function validator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required | date',
            'number' => 'required | string | max:6 | min:1',
            'distance' => 'required | numeric',
            'time' => 'required | numeric',
        ]);
        $validator->after(function($validator) {
            $data = $validator->getData();
            $speed = $data['distance'] / $data['time'] * 3.6;
            if ($speed < 110 || $speed > 400) {
                $validator->errors()->add('speed', __('Wrong speed :speed km/h!', ['speed' =>  $speed]));
            } 
        });
        return $validator;
    }

    public function store(Request $request)
    {
        $this->validator($request)->validate();

        Radar::create([
            'date' => $request->input('date'),
            'number' => $request->input('number'),
            'distance' => $request->input('distance'),
            'time' => $request->input('time'),
            'creator_id' => \Auth::user()->id,
            'updater_id' => \Auth::user()->id,
        ]);
    }

    public function update(Request $request, Radar $radar)
    {
        $this->validator($request)->validate();
        
        $radar->date = $request->input('date');
        $radar->number = $request->input('number');
        $radar->distance = $request->input('distance');
        $radar->time = $request->input('time');

        $radar->updater_id = \Auth::user()->id;
        
        $radar->save();
    }

    public function destroy(Radar $radar)
    {
        $radar->delete();
    }
}