@component('vendor.mail.html.message')
<h1 class="align-center">Hi {{ $notify->name }}</h1>

<div class="align-center">

 {{ $sender->name }} add new comment on your feed, Check comment & and reply this comment.

</div>

@php
    if($feed->feed_type == 'project'){
        $url = route("project_detail",[$feed->slug]);
    }
    else{
        $url = route("job_detail",[$feed->slug]);
    }
@endphp
@component('mail::button', ['url' => $feed->feed_type == 'project'?route("project_detail",[$feed->slug]):route("job_detail",[$feed->slug]),'color'=>'red'])
Check Feed
@endcomponent

{{--  Thanks,<br>
{{ $data['name'] }}  --}}
@endcomponent
