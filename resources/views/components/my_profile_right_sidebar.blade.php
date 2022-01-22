<div>
    <div class="right-sidebar">
        <div class="message-btn">
            @if(auth()->user()->role_type == 'user')
                <a href="{{ route('user_dashboard.setting') }}" title=""><i class="fas fa-cog"></i> Настройки</a>
            @else
                <a href="{{ route('company_dashboard.setting') }}" title=""><i class="fas fa-cog"></i> Настройки</a>
            @endif

        </div>

        <livewire:frontend.portfolio.sidebar-gallery :user="auth()->user()" />
    </div><!--right-sidebar end-->


</div>
