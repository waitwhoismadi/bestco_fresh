@component('vendor.mail.html.message')
<h1 class="align-center">Hi {{ $notify->name }}</h1>

<div class="align-center">

 {{ $sender->name }} sent you a follow request, Please login your account check profile & accept request.

</div>

@php
    if($notify->role_type == 'company'){
        $url = route("company_dashboard.setting",['page'=>'request']);
    }
    else{
        $url = route("user_dashboard.setting",['page'=>'request']);
    }
@endphp
{{-- @component('mail::button', ['url' => {{ $url }},'color'=>'red'])
Accept Request
@endcomponent --}}

{{--  Thanks,<br>
{{ $data['name'] }}  --}}
@endcomponent
