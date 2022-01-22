<div class="acc-setting">
    <h3>Уведомления</h3>
    <div class="notifications-list">

        <notifications base_url="{{ url('/') }}" :notifications="{{ auth()->user()->Notifications }}" :user="{{ auth()->user() }}"></notifications>

    </div><!--notifications-list end-->
</div><!--acc-setting end-->
