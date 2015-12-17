<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use App\Models\Tasks;

class TasksController extends Controller {
	public function index(){
		$tasks = Tasks::all();

        return View::make('tasks.index')->with("tasks", $tasks);
	}

	public function create(){
		return View::make('tasks.new');
	}

	public function store(){
	    $name = Input::has("name") ? Input::get("name") : "";
        
		if($name == ""){
            Session::flash("error", trans("tasks.notifications.field_name_missing"));

            return Redirect::to("/tasks/create")->withInput();
        }

		Tasks::create(
			array(
				'name' => $name
			)
		);

		Session::flash('success', trans("tasks.notifications.register_successful"));

		return Redirect::to("/tasks");
	}

	public function edit($id){
        $tasks = Tasks::find($id);

        if(!$tasks){
            Session::flash('error', trans("tasks.notifications.no_exists"));

            return Redirect::to("/tasks");
        }

        return View::make('tasks.edit')->with("tasks", $tasks);
	}

	public function update(){
        $tasks = Tasks::find(Input::get("id"));

        if(!$tasks){
            Session::flash('error', trans("tasks.notifications.no_exists"));

            return Redirect::to("/tasks");
        }

        $name = Input::has("name") ? Input::get("name") : "";
        
        if($name == ""){
            Session::flash("error", trans("tasks.notifications.field_name_missing"));

            return Redirect::to("/tasks/$tasks->id/edit")->withInput();
        }

        $tasks->name = $name;

        $tasks->save();

        Session::flash('success', trans("tasks.notifications.update_successful"));

        return Redirect::to("/tasks");
	}

	public function active($id){
        $tasks = Tasks::find($id);

        if(!$tasks){
            Session::flash('error', trans("tasks.notifications.no_exists"));

            return Redirect::to("/tasks");
        }

        $tasks->active = 1;
        $tasks->save();

        Session::flash('success', trans("tasks.notifications.activated_successful"));

        return Redirect::to("/tasks");
	}

	public function deactive($id){
        $tasks = Tasks::find($id);

        if(!$tasks){
            Session::flash('error', trans("tasks.notifications.no_exists"));

            return Redirect::to("/tasks");
        }

        $tasks->active = 0;
        $tasks->save();

        Session::flash('success', trans("tasks.notifications.deactivated_successful"));

        return Redirect::to("/tasks");
    }

    public function destroy(){
        $tasks = Tasks::find(Input::get("id"));

        if(!$tasks){
            Session::flash('error', trans("tasks.notifications.no_exists"));

            return Redirect::to("/tasks");
        }

        $tasks->delete();

        Session::flash('success', trans("tasks.notifications.delete_successful"));

        return Redirect::to("/tasks");
    }
}