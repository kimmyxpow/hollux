<?php

namespace App\Http\Livewire\Dashboard\Admin\User;

use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $phone_number;
    public $password;
    public $password_confirmation;
    public $avatar;
    public $roles;
    public $role;
    public $oldImage;

    public function render()
    {
        return view('livewire.dashboard.admin.user.edit');
    }

    public function mount(User $user)
    {
        $this->fill([
            'roles' => Role::all()->pluck('name'),
            'user' => $user,
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'role' => $user->getRoleNames()->first(),
            'oldImage' => $user->avatar,
        ]);
    }

    public function update()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', new PhoneNumber],
        ];

        if ($this->avatar) {
            $rules['avatar'] = ['required', 'image'];
        }

        if ($this->password) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }

        if ($this->email !== $this->user->email) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
        }

        $validatedData = $this->validate($rules);

        $validatedData['password'] = bcrypt($this->password);

        if ($this->avatar) {
            $validatedData['avatar'] = $this->avatar->store('img/avatar/upload');
            if (preg_match('/upload/', $this->avatar)) {
                Storage::delete($this->avatar);
            }
        } else {
            $validatedData['avatar'] = $this->oldImage;
        }

        $this->user->update($validatedData);
        $this->user->syncRoles($this->role);
        $this->emit('user:edited');
    }
}
