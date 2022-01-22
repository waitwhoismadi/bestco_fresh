<div>
    <div class="user-profile-ov">
        <h3>Категория

        </h3>


            <div id="usercat{{ $user->id }}" class="pb-2 usercat">
                <h4><span>{{ $user->category_detail->category_name }}</span>
                    @auth
                    @if (auth()->user()->id == $user->id)
                    <a href="javascript:void(0)" title="" class="cat-box-open" data-category="{{ $user->category_detail->id }}"><i class="fa fa-pencil"></i></a>
                    @endif
                    @endauth
                </h4>

            </div>


    </div><!--user-profile-ov end-->
</div>
