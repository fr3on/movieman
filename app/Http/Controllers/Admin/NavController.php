<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NavController extends Controller {
	
	# Index
	public function index() {
		return view('pages.admin.nav.index', [
			'navs' => \App\Menu::Sorted()->paginate(10)
		]);
	}

	# Create
	public function create() {
		return view('pages.admin.nav.create', [
			
		]);
	}

	public function edit($id) {
		return view('pages.admin.nav.edit', [
	    	'navs' => \App\Menu::find($id),
	    ]);
  	}

	public function store(Requests\StoreNavRequest $request) {
		$navs = new \App\Menu;
		$navs->title = $request->title;
		$navs->slug = str_slug($request->slug);
		$navs->menu = $request->menu;
		$navs->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.nav.index');
	}

	# Update
	public function update(Requests\UpdateNewsRequest $request, $id) {
		$navs = \App\Menu::find($id);
		$navs->title = $request->title;
		$navs->slug = str_slug($request->slug);
		$navs->menu = $request->menu;
		$navs->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.nav.index');
	}

	# Delete
	public function destroy($id){
		$navs = \App\Menu::find($id);
		$navs->delete();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.nav.index');
  	}
}