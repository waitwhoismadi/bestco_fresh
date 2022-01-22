<div class="modal" id="hire_modal" wire:ignore.self>
    <div class="modal-dialog">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-light text-center">Наймите меня</h3>
            </div>
            <form wire:submit.prevent='hire_me'>
            <div class="modal-body">
                <div class="innerbody apply-jobbox">

                        <input type="text" placeholder="Ваше имя/Название вашей компании" value="{{ old('name') }}" wire:model='name'>
                        @error('name')
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
                        <input type="text" placeholder="Зарплата" value="{{ old('salary') }}" wire:model='salary'>
                        <br>
                        <br>
                        <textarea placeholder="Немного о вас или о вашей компании..." class="form-control" wire:model='detail'></textarea>
                        <br>


                </div>
            </div>
            <div class="modal-footer">
                <button class="place-bid-btn" type="submit">Отправит заявку</button>
                {{--  <button>Отмена</button>  --}}
            </div>
        </form>
        </div>
    </div>
</div>
