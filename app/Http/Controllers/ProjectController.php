<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;
use Auth;
use App\Models\Event;
use App\Models\Action;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource. to powinno być też niżej:
     *
     * @return Application|Factory|View
     */
    public function index(): View
    {
        return view('projects.index', [
            'projects' => Project::where('user_id', Auth::id())->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $project = new Project($request->all());
        $project->user_id = Auth::id();
        $project->save();
        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return View
     */
    public function show(Project $project): View
    {
        if($project->user_id == Auth::id()){
            return view('projects.show', [
                'project' => $project,
                'events' => Event::where('project_id', $project->id)->paginate(6),
                //'actions' => Action::where('event_id', $project->id)->paginate(6),
            ]);
        }
        else{
            return view('needpermissions');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @param  Event  $event
     * @return View
     */
    public function show_e(Project $project, Event $event): View
    {
        if($project->user_id == Auth::id()){
            return view('projects.show', [
                'project' => $project,
                'event_e' => $event,
                'events' => Event::where('project_id', $project->id)->paginate(6),
                //'actions' => Action::where('event_id', $project->id)->paginate(6),
            ]);
        }
        else{
            return view('needpermissions');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return View
     */
    public function edit(Project $project): View
    {
        if($project->user_id == Auth::id()){
            return view('projects.edit', [
                'project' => $project
            ]);
            }
        else{
            return view('needpermissions');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Project  $project
     * @return RedirectResponse
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        if($project->user_id == Auth::id()){
            $project->fill($request->all());
            $project->save();
            return redirect(route('projects.index'));
        }
        else{
            return redirect(route('needpermissions'));
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(Project $project): JsonResponse
    {
        if($project->user_id == Auth::id()){
            try{
                $events = $project->events();        
                foreach($events->get() as $event) {
                    $event->actiones()->delete();
                }
                    
                $events->delete();

                $project->delete();

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

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return View
     */
    public function export(Project $project): View
    {
        if($project->user_id == Auth::id()){
            return view('projects.export', [
                'project' => $project,
            ]);
        }
        else{
            return view('needpermissions');
        }
    }
}
