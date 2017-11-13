<?php

namespace App\Http\Controllers;

use App\Radar;
use Illuminate\Http\Request;
use Validator;
use App\Repositories\RadarRepository;

class RadarsController extends Controller
{
    private $radarRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $radars = $this->radarRepository->paginate(5);  
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
        $this->radarRepository->store($request);
        return redirect('/radars');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Radar  $radar
     * @return \Illuminate\Http\Response
     */
    public function show(Radar $radar)
    {
        return view('radars.show', compact('radar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Radar  $radar
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
     * @param  \App\Radar  $radar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Radar $radar)
    {
        $this->radarRepository->update($request, $radar);
        return redirect('/radars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Radar  $radar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Radar $radar)
    {
        $this->radarRepository->destroy($radar);
        return redirect('/radars');
    }
}
