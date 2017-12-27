<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Radar;
use Validator;
use App\Http\Requests\RadarFormRequest;

class RadarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$radars = Radar::all();
        $radars = Radar::orderBy('date', 'desc')->paginate(10);
        return view('radars.index', compact('radars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('radars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RadarFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RadarFormRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'date' => 'required | date',
        //     'distance' => 'required | numeric',
        //     'time' => 'required | numeric',
        //     'number' => 'required | string | max:6 | min:1'
        // ]);
            
        // $validator->after(function($validator) {
        //     $data = $validator->getData();
        //     $speed = $data['distance'] / $data['time'] * 3.6;
        //     if ($speed < 50 || $speed > 300) {
        //         $validator->errors()->add('speed', 'Wrong speed: '.$speed.' km/h !');
        //     }
        // });
        // $validator->validate();
        
        $radar = new Radar;
        $radar->date = $request->input('date');
        $radar->number = $request->input('number');
        $radar->distance = $request->input('distance');
        $radar->time = $request->input('time');
        $radar->creator_id = \Auth::user()->id;
        $radar->updator_id = \Auth::user()->id;
        $radar->save();

        return redirect('/radars');
    }

    /**
     * Display the specified resource.
     *
     * @param  Radar  $radar
     * @return \Illuminate\Http\Response
     */
    public function show(Radar $radar)
    {
        return view('radars.show', compact('radar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Radar  $radar
     * @return \Illuminate\Http\Response
     */
    public function edit(Radar $radar)
    {
        return view('radars.edit', compact('radar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Radar  $radar
     * @return \Illuminate\Http\Response
     */
    public function update(RadarFormRequest $request, Radar $radar)
    {
        // $validator = Validator::make($request->all(), [
        //     'date' => 'required | date',
        //     'distance' => 'required | numeric',
        //     'time' => 'required | numeric',
        //     'number' => 'required | string | max:6 | min:1'
        // ]);
            
        // $validator->after(function($validator) {
        //     $data = $validator->getData();
        //     $speed = $data['distance'] / $data['time'] * 3.6;
        //     if ($speed < 50 || $speed > 300) {
        //         $validator->errors()->add('speed', 'Wrong speed: '.$speed.' km/h !');
        //     }
        // });
        // $validator->validate();

        $radar->date = $request->input('date');
        $radar->number = $request->input('number');
        $radar->distance = $request->input('distance');
        $radar->time = $request->input('time');
        $radar->updator_id = \Auth::user()->id;
        $radar->save();

        return redirect('/radars');
    }

    public function delete(Radar $radar)
    {
        return view('radars.destroy', compact('radar'));        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Radar  $radarid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Radar $radar)
    {
        $radar->delete();

        return redirect('/radars');        
    }
}
