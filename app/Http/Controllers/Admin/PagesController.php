<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller {
	
	# Index
	public function index() {
		return view('pages.admin.pages.index', [
			'pages' => \App\Page::Sorted()->paginate(10)
		]);
	}

	# Create
	public function create() {
		return view('pages.admin.pages.create', [
			
		]);
	}

	public function edit($id) {
		return view('pages.admin.pages.edit', [
	    	'pages' => \App\Page::find($id),
	    ]);
  	}

	public function store(Requests\StorePagesRequest $request) {
		$pages = new \App\Page;
		$pages->title = $request->title;
		$pages->slug = str_slug($request->slug);
		$pages->content = $request->content;
		$pages->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.pages.index');
	}

	# Update
	public function update(Requests\UpdateNewsRequest $request, $id) {
		$pages = \App\Page::find($id);
		$pages->title = $request->title;
		$pages->slug = str_slug($request->slug);
		$pages->content = $request->content;
		$pages->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.pages.index');
	}

	# Delete
	public function destroy($id){
		$pages = \App\Page::find($id);
		$pages->delete();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.pages.index');
  	}
}