@component('vendor.mail.html.message')
<h1 class="align-center">Congratulaion {{ $bid->user->name }}!</h1>

<div class="align-center">

 {{ $bid->project->user->name }} Accept your project bid, Check Project and start working.

</div>

Project : **{{ $bid->project->title }}**


@php

        $url = route("project_detail",[$bid->project->slug]);

@endphp
@component('mail::button', ['url' => $url,'color'=>'red'])
Project detail
@endcomponent

{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
