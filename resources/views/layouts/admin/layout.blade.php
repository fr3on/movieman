@inject('settings', 'App\Settings')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Manage {{ $settings->first()->site_name }}</title>
    <link rel="stylesheet" href="<?php echo asset('public/assets/css/admin.css')?>">
    <link rel="stylesheet" href="<?php echo asset('public/assets/css/ionicons.min.css')?>">
</head>
<body>
    <div class="overlay"></div>
    <div class="sk-wandering-cubes">
        <div class="sk-cube sk-cube1"></div>
        <div class="sk-cube sk-cube2"></div>
    </div>
	@include('partials.admin.header')

	<div class="content container clearfix">
		<div class="blocks float--left">
    		@include('partials.admin.left')
    	</div>

    	<div class="page--content float--right">
    		@yield('content')
    	</div>
	</div>
    <script src="<?php echo asset('public/assets/js/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo asset('public/assets/js/select2.min.js')?>"></script>
    <script src="<?php echo asset('public/assets/js/admin.js')?>"></script>
</body>
</html>