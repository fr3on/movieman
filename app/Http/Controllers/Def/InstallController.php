<?php

namespace App\Http\Controllers\Def;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InstallController extends Controller {
	
	# Index
	public function index() {
		$url = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		require_once base_path() . '/install_files/' . 'index.php';
	}
}