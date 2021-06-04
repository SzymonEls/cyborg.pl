<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource. to powinno być też niżej:
     *
     * @return Application|Factory|View
     */
    public function index()
    {


        return view('users.index', [
            'users' => User::paginate(6)
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return View
     */
    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->fill($request->all());
        $user->save();
        return redirect(route('users.index'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try{
            $projects = $user->projects();  
            foreach($projects->get() as $project) {
                $events = $project->events();        
                foreach($events->get() as $event) {
                    $event->actiones()->delete();
                }
                    
                $events->delete();

                $project->delete();
            }
                
            $projects->delete();

            $user->delete();



            $user->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e){
            return response()->json([
               'status' => 'error'
            ])->setStatusCode(500);
        }
        
    }
}
