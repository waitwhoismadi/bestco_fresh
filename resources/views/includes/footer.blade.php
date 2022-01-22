<footer>
    <div class="footy-sec mn no-margin">
        <div class="container">
            <ul>
                @foreach (App\Cms_pages::where('page_type','other')->limit(8)->get() as $cms)
                <li><a href="{{ route('cms_page', [$cms->page_slug]) }}" title="{{ $cms->page_title }}">{{ $cms->page_title }}</a></li>
                @endforeach


            </ul>
            <p><img src="{{ asset('images/copy-icon2.png') }}" alt="">Copyright {!! date('Y') !!}</p>
            <img class="fl-rgt" src="{{ config('web.logo') }}" alt="" style="width: 150px;">
        </div>
    </div>
</footer>
