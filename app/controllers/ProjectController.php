<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;

class ProjectController
{
	protected $pageTitle;

	public function index()
	{
		$pageTitle = "Projects";
		$user_id = Auth::user('id');

		$project_datas = DB()->selectLoop('*', 'projects', "user_id = '$user_id'")->get();
		return view('/projects/index', compact('project_datas', 'pageTitle', 'user_id'));
	}

	public function detail($id)
	{
		$pageTitle = "Project Detail";
		$user_id = Auth::user('id');

		$project_details = DB()->select("*", 'projects', "id='$id' AND user_id = '$user_id'")->get();

		if (!$project_details) {
			redirect('/project');
		}

		return view('/projects/detail', compact('project_details', 'pageTitle'));
	}

	public function add()
	{
		$pageTitle = "Project Add";
		$projectCode = "PROJ-" . strtoupper(randChar(8));
		return view('/projects/new', compact('projectCode', 'pageTitle'));
	}

	public function store()
	{
		$request = Request::validate('project/add', [
			'proj-code' => 'required',
			'proj-name' => 'required'
		]);

		$project_form = [
			'project_code' => $request['proj-code'],
			'project_name' => $request['proj-name'],
			'description' => $request['proj-description'],
			'date_added' => date("Y-m-d H:i:s"),
			'user_id' => Auth::user('id')
		];

		DB()->insert("projects", $project_form);
		redirect('/project/add', ["message" => "Added successfully.", "status" => 'success']);
	}

	public function delete($id)
	{
		$user_id = Auth::user('id');
		DB()->delete('projects', "id = '$id' AND user_id = '$user_id'");
		redirect('/project', ["message" => "Deleted successfully.", "status" => 'success']);
	}

	public function updateDetail($id)
	{
		$request = Request::validate('project/detail/' . $id, [
			'edit-proj-code' => 'required',
			'edit-proj-name' => 'required'
		]);

		$update_project_form = [
			'project_code' => $request['edit-proj-code'],
			'project_name' => $request['edit-proj-name'],
			'description' => $request['edit-proj-description']
		];

		DB()->update("projects", $update_project_form, "id = '$id'");
		redirect('/project/detail/' . $id, ["message" => "Updated successfully.", "status" => 'success']);
	}

	public function view($id)
	{
		$pageTitle = "Project Detail";
		$user_id = Auth::user('id');

		$project = DB()->select("*", 'projects', "id='$id' AND user_id = '$user_id'")->get();

		if (!$project) {
			redirect('/project');
		}

		return view('/projects/show', compact('project', 'pageTitle'));
	}
}
