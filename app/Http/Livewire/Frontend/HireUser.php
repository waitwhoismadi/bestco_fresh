<?php

namespace App\Http\Livewire\Frontend;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\Hireme;
use App\Facades\Flash_notification;

class HireUser extends Component
{
    public $user;
    public $name;
    public $email;
    public $contact;
    public $salary;
    public $detail;

    public function mount($user){
        $this->user = $user;
    }

    public function hire_me(){
        $validation = Validator::make(array(
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
            'salary' => $this->salary?$this->salary:'',
            'detail' => $this->detail?$this->detail:'',
        ),
        [
            'name'=>'required|string',
            'email'=>'required|email',
            'contact'=>'required|regex:/[0-9]{10}/',
            'salary' => 'string',
            'detail' =>'max:300'
        ])->validate();


       Mail::to($this->user)->send(new Hireme($validation,$this->user));

       Flash_notification::set('Apply Job Successfully','success');
        return redirect()->route('user_profile',[$this->user->slug]);



    }

    public function render()
    {
        return view('livewire.frontend.hire-user');
    }
}
