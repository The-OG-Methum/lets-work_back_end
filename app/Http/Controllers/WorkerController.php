<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = Worker::where('status', 'working')->get();   
             
        return response()->json($workers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'nic' => 'required|string|min:10|max:15|unique:workers,nic',
        'name' => 'required|string|max:55',
        'address' => 'required|string|max:220',
        'daily_rate' => 'required|numeric',
        'transportation_fee' => 'nullable|numeric',
        'status' => 'required|in:working,not working'
    ]);

    $worker = Worker::create($validated);

    return response()->json([
        'message' => 'Worker created successfully',
        'worker' => $worker
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $worker = Worker::findOrFail($id);

        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'nic'=>'required|string|max:55',
            'address'=>'required|string|max:255',
            'daily_rate'=>'required|numeric',
            'transportation_fee'=>'required|numeric',
            'status' => 'required|in:working,not working', // <-- add this line

        ]);

        $worker->update($validated);

        return response()->json([
            'success'=>true,
            'message'=>'Worker Edited Successfully!',
            'worker'=>$worker
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Worker deleted successfully'
        ]);
    }
}
