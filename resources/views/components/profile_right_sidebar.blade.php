@php
    use App\Http\Controllers\ChatController as Chat;
@endphp

<div>
    <div class="right-sidebar">
        @auth
        @if (auth()->user()->id != $user->id && auth()->user()->role_type != 'admin')
        <div class="message-btn">
            <a href="{{ Chat::create_link(auth()->user()->role_type,$user->id) }}" target="_blank" title="chat" ><i class="fa fa-envelope"></i> Сообщения</a>
        </div>
        @endif
        @endauth

        <livewire:frontend.portfolio.sidebar-gallery :user='$user'>
    </div><!--right-sidebar end-->
</div>
