@inject('settings', 'App\Settings')
<header class="header" id="header">
    <div class="container">
    	<h1 class="header--logo float--left"><a href="{{ route('admin') }}"><b>{{ $settings->first()->site_name }}</b> CMS</a></h1>

    	<a href="{{ env('APP_URL') }}" class="button button--secondary button--medium button--radius text--uppercase button--bottom-medium float--right" target="_blank">View Website</a>
    </div>
</header>