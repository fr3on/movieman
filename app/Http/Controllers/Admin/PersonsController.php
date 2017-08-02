<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonsController extends Controller {
	
	# Index
	public function index() {
		return view('pages.admin.persons.index', [
			'persons' => \App\Persons::Sorted()->paginate(10)
		]);
	}

	# Create
	public function create() {
		return view('pages.admin.persons.create', [
			
		]);
	}

	# Edit
	public function edit($id) {
		return view('pages.admin.persons.edit', [
	    	'persons' => \App\Persons::find($id),
	    ]);
  	}

  	# getData
	public function getData($providerName, $id) {
		$showPerson = tmdb()->getPerson($id)->get();
		return \Response::json($showPerson);
	}

	public function store(Requests\StorePersonsRequest $request) {
		$person = \App\Persons::firstOrNew(['tmdb' =>  $request->get('tmdb')]);
		$person->name = $request->name;
		$person->image = $request->image;
		$person->biography = $request->biography;
		$person->birth_date = $request->birth_date;
		$person->birth_place = $request->birth_place;
		$person->sex = $request->sex;
		$person->tmdb = $request->tmdb;
		$person->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.persons.index');
	}

	# Update
	public function update(Requests\UpdatePersonsRequest $request, $id) {
		$person = \App\Persons::find($id);
		$person->name = $request->name;
		$person->image = $request->image;
		$person->biography = $request->biography;
		$person->birth_date = $request->birth_date;
		$person->birth_place = $request->birth_place;
		$person->sex = $request->sex;
		$person->tmdb = $request->tmdb;
		$person->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.persons.index');
	}

	# Delete
	public function destroy($id){
		$person = \App\Persons::find($id);
		$person->delete();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.persons.index');
  	}
}