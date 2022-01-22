@php
    $user = App\User::findOrFail(auth()->user()->id);
@endphp
<div>
    <div class="main-left-sidebar">
        <div class="user_profile">
            <div class="user-pro-img">
                @if ($user->role_type == 'company')
                    <img src="{{ asset('storage/'.$user->company->logo) }}" alt="{{ $user->company->company_logo }}" id="profile_pic" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                    @else
                     <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}" id="profile_pic" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                    {{--  <img src="{{ get_file($user->image) }}" alt="{{ $user->name }}" id="profile_pic" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">  --}}

                    @endif

                <div class="spinner-border propic-load" style="display: none;"></div>

                <div class="add-dp" id="OpenImgUpload">
                    <input type="file" id="file-profile_picupload">
                    <label id="profile_picbtn" >
                        <i class="fa fa-camera"></i>
                    </label>
                </div>
            </div><!--user-pro-img end-->
            <div class="user_pro_status">
                <ul class="flw-status">
                    <li>
                        <span>Подписки</span>
                        <b>{{ App\follow_list::my_following()->count() }}</b>
                    </li>
                    <li>
                        <span>Подписчики</span>
                        <b>{{ App\follow_list::my_follower()->count() }}</b>
                    </li>
                </ul>
            </div><!--user_pro_status end-->

            <livewire:frontend.social-links :user="auth()->user()">

        </div><!--user_profile end-->

    </div><!--main-left-sidebar end-->
</div>
@push('styles')
    <style>
        .propic-load{
            position: absolute;

    right: 100px;
    top: 75px;
        }
        </style>
@endpush
@push('scripts')
    <script>

        var profile_pic = $('#profile_pic');
        var profile_picupload = $('#file-profile_picupload');
        var profile_picbtn = $('#profile_picbtn');
        var propic_load = $('.propic-load');

            profile_picbtn.click(function () {
                profile_picupload.click();
            })

            profile_picupload.change(function (e){

                var image = e.target.files[0];

                var reader = new FileReader();
                     reader.readAsDataURL(image);
                    reader.onload = e => {
                        profile_pic.attr('src',e.target.result);
                        // console.log(e.target.result);
                    }

                var profile_picform = new FormData;
                profile_picform.append('profile_pic',image)

                profile_picbtn.hide();
                propic_load.show();

                    $.ajax({
                    method: "POST",
                    url: "{{ url('api') }}/update-profile-pic",
                    data: profile_picform,
                    processData: false,
                    contentType: false,

                    })
                    .done(function( data ) {
                        profile_picbtn.show();
                propic_load.hide();
                        if(data.status=='success'){
                            flash_notification(data.msg,'success')
                        }
                        else{
                            flash_notification(data.msg,'error')
                        }
                    });
            })
    </script>
@endpush
