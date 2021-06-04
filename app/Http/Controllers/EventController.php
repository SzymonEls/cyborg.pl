<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request, $id): RedirectResponse
    {
        $event = new Event($request->all());
        $event->project_id = $id;
        $event->save();
        return redirect(route('projects.show_e', [
            'project' => $id,
            'event' => $event->id ]));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $project = Project::find($event->project_id);
        if($project->user_id == Auth::id()){
            try{
                $actiones = $event->actiones();
            
                $actiones->delete();

                $event->delete();

                return response()->json([
                    'status' => 'success'
                ]);
            } catch (Exception $e){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Wystapil blad!',
                ])->setStatusCode(500);
            }
        }
        else{
            return response()->json([
                'status' => 'error'
                ])->setStatusCode(500);
        }
    }
}
