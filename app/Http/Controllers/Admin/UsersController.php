<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller {
	
	# Index
	public function index() {
		return view('pages.admin.users.index', [
			'users' => \App\User::Sorted()->paginate(10)
		]);
	}

	# Delete
	public function destroy($id){
		$users = \App\User::find($id);
		$users->delete();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.users.index');
  	}
}