<?php

namespace App\Http\Controllers\Def;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentsController extends Controller {
	
	# Store
	public function store(Request $request) {
		$comment = new \App\Comments;
		$comment->user_id = \Auth::user()->id;
		$comment->type_id = $request->type_id;
		$comment->type = $request->type;
		$comment->content = $request->content;
		$comment->save();
		session()->flash('success', 'Success!');
		return redirect()->back();
	}

	# Delete
	public function destroy($id){
		$comment = \App\Comments::where('comment_id', $id);
		$comment->delete();
  	}
}