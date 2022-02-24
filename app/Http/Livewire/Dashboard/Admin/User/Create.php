<?php

namespace App\Http\Livewire\Dashboard\Admin\User;

use App\Models\User;
use App\Rules\PhoneNumber;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone_number;
    public $password;
    public $password_confirmation;
    public $avatar;
    public $roles;
    public $role = 'user';

    protected $listeners = ['user:created' => 'userCreated'];

    public function userCreated()
    {
        $this->resetAll();
    }

    public function render()
    {
        return view('livewire.dashboard.admin.user.create')->layoutData(['title' => 'New User']);
    }

    public function mount()
    {
        $this->fill(['roles' => Role::all()->pluck('name')]);
    }

    public function store()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', new PhoneNumber],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        if ($this->avatar) {
            $rules['avatar'] = ['required', 'image'];
        }

        $validatedData = $this->validate($rules);

        $validatedData['password'] = bcrypt($this->password);

        if ($this->avatar) {
            $validatedData['avatar'] = $this->avatar->store('img/avatar/upload');
        } else {
            $validatedData['avatar'] = 'img/avatar/' . substr($this->name, 0, 1) . '.png';
        }

        $validatedData['code'] = bin2hex(random_bytes(20));
        
        $user = User::create($validatedData);

        $user->syncRoles($this->role);
        $this->emit('user:created');
    }

    public function resetAll()
    {
        $this->resetExcept('roles');
    }
}
