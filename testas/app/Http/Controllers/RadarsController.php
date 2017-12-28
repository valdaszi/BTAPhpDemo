<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Radar;
use Validator;
use App\Http\Requests\RadarFormRequest;
use App\Repositories\RadarRepository;

class RadarsController extends Controller
{
    private $radarRepository;

    public function __construct(RadarRepository $radarRepository)
    {
        $this->middleware('auth');
        $this->radarRepository = $radarRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $radars = $this->radarRepository->list(10);
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
        $this->radarRepository->save($request);
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
        $this->radarRepository->update($request, $radar);
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
        $this->radarRepository->delete($radar);
        return redirect('/radars');        
    }
}
