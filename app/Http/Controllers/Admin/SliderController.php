<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SliderController extends Controller {
	
	# Index
	public function index() {
		return view('pages.admin.slider.index', [
			'sliders' => \App\Slider::Sorted()->paginate(10),
			'movies' => \App\Movies::first()
		]);
	}

	# Create
	public function create() {
		return view('pages.admin.slider.create', [
			
		]);
	}

	# Edit
	public function edit($id) {
		return view('pages.admin.slider.edit', [
	    	'sliders' => \App\Slider::find($id),
	    ]);
  	}

	public function store(Requests\StoreSliderRequest $request) {
		$slider = new \App\Slider;
		$slider->movie_id = $request->id;
		if ($request->hasFile('image')) {
			$imageName = \Carbon\Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
			$request->file('image')->move(base_path() . '/public/uploads/slider/', $imageName);
			$slider->image = '/public/uploads/slider/'. $imageName;
		}
		$slider->sort = $request->sort;
		$slider->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.slider.index');
	}

	# Update
	public function update(Requests\UpdateSliderRequest $request, $id) {
		$slider = \App\Slider::find($id);
		$slider->movie_id = $request->id;
		if ($request->hasFile('image')) {
			$imageName = \Carbon\Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
			$request->file('image')->move(base_path() . '/public/uploads/slider/', $imageName);
			$slider->image = '/public/uploads/slider/'. $imageName;
		} else {
	        $slider->image = $request->get('old_image');
        }
		$slider->sort = $request->sort;
		$slider->save();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.slider.index');
	}

	# Delete
	public function destroy($id){
		$slider = \App\Slider::find($id);
		$slider->delete();

		session()->flash('success', 'Success!');
		return redirect()->route('admin.slider.index');
  	}
}