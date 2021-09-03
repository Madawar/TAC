<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserItem extends Component
{
    public $user;
    public $state = false;
    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required',
        'user.account_type' => 'required',

    ];

    public function mount($user)
    {
        $this->user = $user;
    }

    public function toggleEdit()
    {
        //dump(!$this->state);
        $this->state =  !$this->state;
    }

    public function updated()
    {
        $this->validate();
        $this->user->save();
    }

    public function resetPassword()
    {
    }

    public function render()
    {
        return view('livewire.user.user-item');
    }
}
