<?php

namespace App\Http\Livewire\Frontend\Userinfo;

use Livewire\Component;

class Skills extends Component
{
    public $user;
    public $skills;
    public $delete_skill;

    public function mount($user){
        $this->user = $user;
        $this->skills = $this->getSkills();
    }

    public function getSkills()
    {
        return $this->user->skill;
    }

    public function delete_skill($skill_id){

        $skill = $this->skills->find($skill_id);
        $skill->delete();

        $this->emit('flash_notification','Delete Skill Successfully!','success');

        $this->skills = $this->getSkills();

        $this->delete_skill = $skill_id;
    }

    public function render()
    {
        return view('livewire.frontend.userinfo.skills');
    }
}
