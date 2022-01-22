@component('vendor.mail.html.message')
<h1 class="align-center">Dear {{ $user->name }}</h1>

<div class="align-center">
@if ($data['detail'] != '')
    {!! nl2br($data['detail']) !!}
@else

 I wanted to connect you to our team. i think this can be really interesting for you.

@endif
</div>

<div class="align-left">

If you are interested check below detail and contact us.

<p>Name : {{ $data['name'] }}</p>
<p>Email : {{ $data['email'] }}</p>
<p>Contact No : {{ $data['contact'] }}</p>
<p>Salary : {{ $data['salary']?$data['salary']:'Not mention' }}</p>

</div>
@component('mail::button', ['url' => route("login"),'color'=>'red'])
Check Profile
@endcomponent

Thanks,<br>
{{ $data['name'] }}
@endcomponent
