<div class="modal" id="mymodal" wire:ignore.self>
    <div class="modal-dialog">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-light text-center">Подать заявку</h3>
            </div>
            <form wire:submit.prevent='apply_job'>
            <div class="modal-body">
                <div class="innerbody apply-jobbox">
                    <h3>Прикрепить CV</h3>

                        <input type="text" placeholder="Полное имя" value="{{ old('full_name') }}" wire:model='full_name'>
                        @error('full_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        <input type="email" placeholder="Почта" value="{{ old('email') }}" wire:model='email'>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        <input type="text" placeholder="Контактный номер" value="{{ old('contact') }}" wire:model='contact'>
                        @error('contact')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        <input type="number" placeholder="Опыт в годах" value="{{ old('experience') }}" wire:model='experience'>
                        @error('experience')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>


                    <div class="select-files">
                        <input type="file" class="custom-file-input" wire:model='file'>
                        <p>Загрузите cv / резюме. Макс размер файла : 3MB</p>
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                @if($btn_disable)
                <button class="place-bid-btn" type="button" disabled>Загрузка...</button>
                @else
                <button class="place-bid-btn" type="submit">Подать заявку</button>
                @endif

                {{--  <button>Cancel</button>  --}}
            </div>
        </form>
        </div>
    </div>
</div>
