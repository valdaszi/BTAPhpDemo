<?php

namespace App\Repositories;

use App\Radar;
use App\Log;

class RadarRepository
{

    public function list($page) 
    {
        $radars = Radar::orderBy('date', 'desc')->paginate($page);
        return $radars;
    }

    public function save($request)
    {
        $radar = new Radar;
        $radar->date = $request->input('date');
        $radar->number = $request->input('number');
        $radar->distance = $request->input('distance');
        $radar->time = $request->input('time');
        $radar->creator_id = \Auth::user()->id;
        $radar->updator_id = \Auth::user()->id;
        $radar->save();
    }

    public function update($request, Radar $radar)
    {
        $oldValues = json_encode($radar);
        
        $radar->date = $request->input('date');
        $radar->number = $request->input('number');
        $radar->distance = $request->input('distance');
        $radar->time = $request->input('time');
        $radar->updator_id = \Auth::user()->id;
        $radar->save();

        $newValues = json_encode($radar);

        $log = new Log();
        $log->user_id = \Auth::user()->id;
        $log->table = 'radar';
        $log->old_values = $oldValues;
        $log->new_values = $newValues;
        $log->save();
    }

    public function delete(Radar $radar) 
    {
        $radar->delete();
    }
}
