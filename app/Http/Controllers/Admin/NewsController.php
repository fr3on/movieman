<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller {
	
	# Index
	public function index() {
		return view('pages.admin.news.index', [
			'news' => \App\News::Sorted()->paginate(10)
		]);
	}

	# Create
	public function create() {
		return view('pages.admin.news.create', [
			
		]);
	}

	# Edit
	public function edit($id) {
		return view('pages.admin.news.edit', [
	    	'news' => \App\News::find($id),
	    ]);
  	}

  	public function store(Requests\StoreNewsRequest $request) {
		$news = new \App\News;
		$news->title = $request->title;
		$news->content = $request->content;
		if ($request->hasFile('image')) {
			$imageName = \Carbon\Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
			$request->file('image')->move(base_path() . '/public/uploads/news/', $imageName);
			$news->image = '/public/uploads/news/'. $imageName;
		}
		$news->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.news.index');
	}

	# Update
	public function update(Requests\UpdateNewsRequest $request, $id) {
		$news = \App\News::find($id);
		$news->title = $request->title;
		$news->content = $request->content;
		if ($request->hasFile('image')) {
			$imageName = \Carbon\Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
			$request->file('image')->move(base_path() . '/public/uploads/news/', $imageName);
			$news->image = '/public/uploads/news/'. $imageName;
		} else {
	        $news->image = $request->get('old_image');
        }
		$news->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.news.index');
	}

	# Delete
	public function destroy($id){
		$news = \App\News::find($id);
		$news->delete();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.news.index');
  	}
}