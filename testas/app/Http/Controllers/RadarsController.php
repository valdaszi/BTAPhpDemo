<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Radar;

class RadarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$radars = Radar::all();
        $radars = Radar::orderBy('date', 'desc')->paginate(15);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $radar = new Radar;
        $radar->date = $request->input('date');
        $radar->number = $request->input('number');
        $radar->distance = $request->input('distance');
        $radar->time = $request->input('time');
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
    public function update(Request $request, Radar $radar)
    {
        $radar->date = $request->input('date');
        $radar->number = $request->input('number');
        $radar->distance = $request->input('distance');
        $radar->time = $request->input('time');
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
