@component('vendor.mail.html.message')
<h1 class="align-center">Hi {{ $notify->name }}</h1>

<div class="align-center">

 {{ $sender->name }} Post a bid on your project, Check following Bidder details.

</div>

Project : **{{ $project_bid->project->title }}**

{{ $project_bid->name }}

{{ $project_bid->email }}

Bid: {{ $project_bid->your_bid }}


@php

        $url = route("project_detail",[$project_bid->project->slug]);

@endphp
@component('mail::button', ['url' => $url,'color'=>'red'])
Project detail
@endcomponent

{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
