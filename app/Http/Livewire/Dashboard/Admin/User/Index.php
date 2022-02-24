<?php

namespace App\Http\Livewire\Dashboard\Admin\User;

use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rules;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination, WithFileUploads;

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
    public $search;
    public $filter_role;

    protected $queryString = [
        'search' => ['except' => ''],
        'filter_role' => ['except' => ''],
    ];


    protected $listeners = ['user:created' => 'userCreated', 'user:edited' => 'userEdited', 'user:deleted' => 'userDeleted'];

    public function userCreated()
    {
        $this->dispatchBrowserEvent('user:created');
    }

    public function userEdited()
    {
        $this->dispatchBrowserEvent('user:edited');
    }

    public function userDeleted()
    {
        $this->dispatchBrowserEvent('user:deleted');
    }

    public function render()
    {
        return view('livewire.dashboard.admin.user.index', ['users' => User::filter(['search' => $this->search, 'filter_role' => $this->filter_role])->latest()->paginate(50)])->layoutData(['title' => 'User Dashboard | Hollux']);
    }

    public function mount()
    {
        $user = User::first();
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

    public function edit(User $user)
    {
        $this->fill([
            'user' => $user,
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'role' => $user->getRoleNames()->first(),
            'oldImage' => $user->avatar,
        ]);
        $this->dispatchBrowserEvent('user:edit');
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
            if (preg_match('/upload/', $this->oldImage)) {
                Storage::delete($this->oldImage);
            }
        } else {
            $validatedData['avatar'] = $this->oldImage;
        }

        $this->user->update($validatedData);
        $this->user->syncRoles($this->role);
        $this->emitSelf('user:edited');
    }

    public function delete(User $user)
    {
        $this->fill(['user' => $user]);
        $this->dispatchBrowserEvent('user:delete');
    }

    public function destroy()
    {
        if (preg_match('/upload/', $this->user->avatar)) {
            Storage::delete($this->user->avatar);
        }
        $this->user->delete();
        $this->emitSelf('user:deleted');
    }
}
