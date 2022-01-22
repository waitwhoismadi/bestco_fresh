@component('vendor.mail.html.message')
<h1 class="align-center">Hi {{ $notify->name }}</h1>

<div class="align-center">

 {{ $sender->name }} apply your job, Check following candidate details.

</div>

Job : **{{ $apply_job->job->title }}**
{{ $apply_job->name }}

{{ $apply_job->email }}

{{ $apply_job->contact }}

{{ $apply_job->experience }}{{ $apply_job->experience?'Yr Experience':'' }}.


@php

        $url = route("job_detail",[$apply_job->job->slug]);

@endphp
@component('mail::button', ['url' => $url,'color'=>'red'])
Job detail
@endcomponent

{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
