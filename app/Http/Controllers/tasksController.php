<?php

namespace App\Http\Controllers;

use App\Tasks;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tasks.create');
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
        $this->validate($request, array(
            'task_name' => 'required',
            'due_date' => 'required',
        ));

        Tasks::create([
            'task_name' => $request['task_name'],
            'status' => $request['status'],
            'due_date' => $request['due_date'],
            'user_id' => $request['user_id'],
            'admin_id' => Session::get('adminID')
        ]);
        return redirect()->back()->with('success', 'New task to the user has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $tasks=Tasks::where('user_id', Auth::user()->id)->sortable()->paginate(5); //cacheFor naudoja CACHE_DRIVER=redis

        $admin=User::join('tasks', 'tasks.admin_id', '=', 'users.id')
            ->select('users.email')
            ->where([
                ['due_date', '<', date('Y-m-d H:i')],
                ['status', '!=', '3']])->get();

        $user=User::join('tasks', 'tasks.user_id', '=', 'users.id')
            ->select('users.email')
            ->where([
                ['due_date', '<', date('Y-m-d H:i')],
                ['status', '!=', '3']])->get();

        return view('users.tasks')->with(compact('tasks', 'admin', 'user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Tasks::find($id);
        $task->status = $request->input('status');

        $task->save();

        return redirect()->back()->with('success', 'Task status has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
