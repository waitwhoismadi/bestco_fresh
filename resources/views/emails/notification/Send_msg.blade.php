@component('vendor.mail.html.message')
<h1 class="align-center">Hi {{ $notify->name }}</h1>

<div class="align-center">

 {{ $sender->name }} send you a new messgage, Please login your account chat with user.

</div>

@php
    if($notify->role_type == 'company'){
        $url = route("company_dashboard.chat",['user'=>$sender->id]);
    }
    else{
        $url = route("user_dashboard.chat",['user'=>$sender->id]);
    }
@endphp
@component('mail::button', ['url' => {{ $url }},'color'=>'red'])
Start Chat
@endcomponent

{{--  Thanks,<br>
{{ $data['name'] }}
@endcomponent
