@component('vendor.mail.html.layout')
{{-- Header --}}
@slot('header')
@component('vendor.mail.html.header', ['url' => config('app.url')])

@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('web.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
