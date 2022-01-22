<div>

    @if (Route::currentRouteName() == 'user_dashboard.profile' || Route::currentRouteName() == 'company_dashboard.profile')
    <div class="message-btn mb-0">
        <a href="javascript:void(0)" title="Update Social Links" class="update_links-open mr-2">
            <i class="fas fa-wrench"></i> Обновить ссылки
        </a>
    </div>
    @endif

    <ul class="social_links">
        {{-- {{ $links }} --}}

        <li><a href="{{ $links?$links->website:'#/' }}" title="Website" target="_blank"><i class="la la-globe"></i> {{ $links? Str::limit($links->website,25,'..'):'..' }}</a></li>
        <li><a href="{{ $links?$links->facebook:'#/' }}" title="Facebook" target="_blank"><i class="fa fa-facebook-square"></i> {{ $links? Str::limit($links->facebook,25,'..'):'..' }}</a></li>
        <li><a href="{{ $links?$links->instagram:'#/' }}" title="Instagram" target="_blank"><i class="fa fa-instagram"></i> {{ $links? Str::limit($links->instagram,25,'..'):'..' }}</a></li>
        <li><a href="{{ $links?$links->twitter:'#/' }}" title="Twitter" target="_blank"><i class="fa fa-twitter"></i> {{ $links? Str::limit($links->twitter,25,'..'):'..' }}</a></li>
        <li><a href="{{ $links?$links->github:'#/' }}" title="Github" target="_blank"><i class="fa fa-github"></i> {{ $links? Str::limit($links->github,25,'..'):'..' }}</a></li>
        <li><a href="{{ $links?$links->pinterest:'#/' }}" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i> {{ $links? Str::limit($links->pinterest,25,'..'):'..' }}</a></li>
        <li><a href="{{ $links?$links->youtube:'#/' }}" title="Youtube" target="_blank"><i class="fa fa-youtube"></i> {{ $links? Str::limit($links->youtube,25,'..'):'..' }}</a></li>

    </ul>

    <div class="overview-box" id="update_links-box"  wire:ignore.self>
        <div class="overview-edit text-left">
            <h3>Социльные сети</h3>

            <form wire:submit.prevent='update_links'>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="la la-globe"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Вебсайт" wire:model="website">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-facebook-square"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Facebook" wire:model="facebook">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Instagram" wire:model="instagram">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-twitter"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Twitter" wire:model="twitter">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-github"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Github" wire:model="github">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-pinterest"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Pinterest" wire:model="pinterest">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-youtube"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Youtube" wire:model="youtube">
                </div>

                <button type="submit" class="save">Update</button>
            <button type="submit" class="cancel" onclick="$('.close-box').click()">Отмена</button>

            </form>
            <a href="#/" title="" class="close-box"><i class="la la-close"></i></a>
        </div><!--links-edit end-->
    </div><!--links-box end-->
</div>
