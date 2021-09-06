<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Audit;
use App\Traits\SearchTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;
    use SearchTrait;
    public $filter = null;
    public $search = null;
    public $pagination = null;
    public $sortBy = null;

    public $user;
    public $name;
    public $email;
    public $account_type;
    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email',
        'user.account_type' => 'required',

    ];
    public function mount()
    {
        $this->user = User::make()->setConnection(env('DB_CONNECTION'));
    }

    public function render()
    {

        $query = User::query();

        if ($this->filter) {
            if ($this->filter == "unassigned") {
                $query->whereNull('assigned_to_email');
            } elseif ($this->filter == "unresponsive") {
                $query->whereNull('root_cause')->whereNotNull('assigned_to_email');
            } elseif ($this->filter == "review") {
                $query->whereNotNull('root_cause')->where('finalized', 0);
            } elseif ($this->filter == "toMe") {
                $query->where('assigned_to_email', Auth::user()->email)->whereNotNull('root_cause')->where('finalized', 0);
            } else {
                $query->where('finalized', $this->filter);
            }
        }
        if ($this->sortBy) {
            $query->orderBy($this->sortBy);
        } else {
            $query->orderBy('created_at', 'DESC');
        }
        if ($this->search) {
            $query->search($this->search, []);
        }
        if ($this->pagination) {
            $users = $query->paginate($this->pagination);;
        } else {
            $users = $query->paginate(10);
        }
        return view('livewire.user.user-management')->with(compact('users'));
    }

    public function saveUser()
    {
       // dd($this->user);
        $this->validate();
        User::create(array(
            'name' => $this->user->name,
            'email' => $this->user->email,
            'account_type' => $this->user->account_type,
            'password' => Hash::make('Test1234')
        ));
    }
}
