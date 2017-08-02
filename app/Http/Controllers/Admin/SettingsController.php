<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('pages.admin.settings', [
			'settings' => \App\Settings::first()
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreSettingsRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		getenv('TMDB_API') ?: $request->get('tmdb_key');
		$settings = \App\Settings::first();
		$process = $settings->update([
            'site_name' => $request->get('site_name'),
            'site_description' => $request->get('site_description'),
            'contact_email' => $request->get('contact_email'),
            'footer_text' => $request->get('footer_text'),
        ]);


        session()->flash('success', 'Success!');
		return redirect()->route('admin.settings.index');
	}
}