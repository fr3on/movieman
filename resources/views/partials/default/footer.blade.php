@inject('menu', 'App\Menu')
@inject('settings', 'App\Settings')
<div class="clear"></div>
<footer class="footer">
    <div class="footer-left">
        <p class="text">{{ $settings->first()->footer_text }}</p>
    </div>
    <div class="footer-right">
        <ul class="footer__page-list">
            @foreach($menu->OfFooter()->get() as $men)
            <li class="footer__page-item">
                <a href="{{ env('APP_URL') }}{{ $men->slug }}" class="footer__page-link">{{ $men->title }}</a>
            </li>
            @endforeach
        </ul>
        <div class="clear"></div>
        <ul class="footer__nav-list">
            @foreach($menu->OfBlock()->get() as $men)
            <li class="footer__nav-item">
                <a href="{{ env('APP_URL') }}{{ $men->slug }}" class="footer__nav-link">{{ $men->title }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</footer>