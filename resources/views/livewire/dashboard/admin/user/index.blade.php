<div class="space-y-8">
    <h1 class="text-gray-800 text-3xl font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">User</h1>

    <div class="space-y-4">
        <livewire:dashboard.admin.user.create />

        <div class="flex gap-4">
            <div class="form-control">
                <label for="search" class="label">Search</label>
                <input class='input' type="search" name="search" id="search" wire:model='search'>
            </div>
            <div class="form-control">
                <label for="filter_role" class="label">Filter Role</label>
                <select class='input capitalize' name="filter_role" id="filter_role" wire:model='filter_role'>
                    <option class="capitalize" value="" selected>All</option>
                    @foreach ($roles as $role)
                        <option class="capitalize" value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <x-table>
        <thead class="thead">
            <tr>
                <th scope="col" class="th">Avatar</th>
                <th scope="col" class="th">Name</th>
                <th scope="col" class="th">Email</th>
                <th scope="col" class="th">Email Verified</th>
                <th scope="col" class="th">Phone Number</th>
                <th scope="col" class="th">Role</th>
                <th scope="col" class="th">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="bg-white border-b">
                    <td class="td">
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-10 h-10 object-cover rounded-tr-xl rounded-bl-xl" alt="{{ $user->name }}">
                    </td>
                    <td class="td font-medium text-gray-900">{{ $user->name }}</td>
                    <td class="td">{{ $user->email }}</td>
                    <td class="td">{{ $user->email_verified_at ?? 'Not Verified' }}</td>
                    <td class="td">{{ $user->phone_number }}</td>
                    <td class="td capitalize">{{ $user->getRoleNames()->first() }}</td>
                    <td class="td flex space-x-2">
                        <button class="btn btn-sm" wire:click='edit("{{ $user->code }}")'>Edit</button>
                        <button class="btn btn-sm btn-outline" wire:click='delete("{{ $user->code }}")'>Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="td">There is nothing here</td>
                </tr>
            @endforelse
        </tbody>
    </x-table>
    {{ $users->links() }}
    <div x-data="{ open: false }">
        <div x-show="open" @user:created.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Added Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            New user successfully added!
                        </p>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" x-on:click="open = false" class="btn">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" @user:edited.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Edited Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            User data successfully edited!
                        </p>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" x-on:click="open = false" class="btn">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" @user:edited.window="open = false" @user:edit.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <form method="POST" action="#" wire:submit.prevent='update' x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-2xl w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-plus-circle text-8xl text-gray-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Edit User</h2>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4 items-start">
                        <div class="form-control">
                            <label for="e-name" class="label">Name</label>
                            <input type="text" id="e-name" name="name" wire:model='name' class="input">
                            @error('name')
                                <span class="invalid text-left">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label for="e-email" class="label">Email</label>
                            <input type="email" id="e-email" name="email" wire:model='email' class="input">
                            @error('email')
                                <span class="invalid text-left">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label for="e-phone_number" class="label">Phone Number</label>
                            <input type="number" id="e-phone_number" name="phone_number" wire:model='phone_number' class="input">
                            @error('phone_number')
                                <span class="invalid text-left">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label for="e-role" class="label">Role</label>
                            <select id="e-role" wire:model='role' name="role" class="select capitalize">
                                @foreach ($roles as $role)
                                    <option class='capitalize' value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="invalid">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label for="e-password" class="label">New Password</label>
                            <input type="password" id="e-password" name="password" wire:model='password' class="input" autocomplete="new-password">
                            @error('password')
                                <span class="invalid">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label for="e-password_confirmation" class="label">Password Confirmation</label>
                            <input type="password" id="e-password_confirmation" wire:model='password_confirmation' name="password_confirmation" class="input">
                            @error('password_confirmation')
                                <span class="invalid">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" class="space-y-4">
                        <div class="form-control">
                            <label for="e-avatar" class="btn w-full text-center">Change Avatar</label>
                            <input class="sr-only" type="file" id="e-avatar" wire:model='avatar'>
                            @error('avatar')
                                <span class="invalid">{{ $message }}</span>
                            @enderror
                        </div>
                        <div x-show="isUploading" class="rounded-tr-xl rounded-bl-xl overflow-hidden">
                            <progress max="100" class="w-full" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    @if ($avatar)
                        <div class="overflow-hidden rounded-tr-2xl rounded-bl-2xl aspect-[1/1] sm:w-1/2 w-full mx-auto">
                            <img class="w-full h-full object-cover" wire:loading.class="blur-sm" wire:target="avatar" src="{{ $avatar->temporaryUrl() }}">
                        </div>
                    @else
                        <div class="overflow-hidden rounded-tr-2xl rounded-bl-2xl aspect-[1/1] sm:w-1/2 w-full mx-auto">
                            <img class="w-full h-full object-cover" wire:loading.class="blur-sm" wire:target="avatar" src="{{ asset('storage/' . $oldImage) }}">
                        </div>
                    @endif
                    <div class="flex space-x-2 justify-center">
                        <button type="submit" class="btn" wire:loading.attr="disabled">
                            Confirm
                        </button>
                        <button type="button" x-on:click="open = false" class="btn btn-outline">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" @user:deleted.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Deleted Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            User successfully deleted!
                        </p>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" x-on:click="open = false" class="btn">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data='{ open: false }'>
        <div x-show="open" @user:deleted.window="open = false" @user:delete.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-info-circle text-8xl text-red-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Are You Sure?</h2>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" wire:click="destroy" class="btn">
                            Yeah!
                        </button>
                        <button type="button" x-on:click="open = false" class="btn btn-outline">
                            Nah!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
