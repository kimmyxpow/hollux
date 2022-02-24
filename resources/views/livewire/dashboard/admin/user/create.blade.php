<div x-data="{ open: false }">
    <button class="btn" x-on:click='open = true'>New</button>
    <div x-show="open" @user:created.window="open = false" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
        <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
        <form method="POST" action="#" wire:submit.prevent='store' x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
            <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-2xl w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                <div class="text-center space-y-4">
                    <i class='bx bx-plus-circle text-8xl text-gray-600'></i>
                    <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">New User</h2>
                </div>
                <div class="grid sm:grid-cols-2 gap-4 items-start">
                    <div class="form-control">
                        <label for="name" class="label">Name</label>
                        <input type="text" id="name" name="name" wire:model='name' class="input">
                        @error('name')
                            <span class="invalid text-left">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label for="email" class="label">Email</label>
                        <input type="email" id="email" name="email" wire:model='email' class="input">
                        @error('email')
                            <span class="invalid text-left">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label for="phone_number" class="label">Phone Number</label>
                        <input type="number" id="phone_number" name="phone_number" wire:model='phone_number' class="input">
                        @error('phone_number')
                            <span class="invalid text-left">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label for="role" class="label">Role</label>
                        <select id="role" wire:model='role' name="role" class="select capitalize">
                            @foreach ($roles as $role)
                                <option class='capitalize' value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label for="password" class="label">Password</label>
                        <input type="password" id="password" name="password" wire:model='password' class="input" autocomplete="new-password">
                        @error('password')
                            <span class="invalid">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label for="password_confirmation" class="label">Password Confirmation</label>
                        <input type="password" id="password_confirmation" wire:model='password_confirmation' name="password_confirmation" class="input">
                        @error('password_confirmation')
                            <span class="invalid">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" class="space-y-4">
                    <div class="form-control">
                        <label for="avatar" class="btn w-full text-center">Upload Avatar</label>
                        <input class="sr-only" type="file" id="avatar" wire:model='avatar'>
                        @error('avatar')
                            <span class="invalid">{{ $message }}</span>
                        @enderror
                    </div>
                    <div x-show="isUploading" class="rounded-tr-xl rounded-bl-xl overflow-hidden">
                        <progress max="100" class="w-full" x-bind:value="progress"></progress>
                    </div>
                </div>
                @if ($avatar)
                    <div class="overflow-hidden rounded-tr-2xl rounded-bl-2xl aspect-[1/1]">
                        <img class="w-full h-full object-cover" wire:loading.class="blur-sm" wire:target="avatar" src="{{ $avatar->temporaryUrl() }}">
                    </div>
                @endif
                <div class="flex space-x-2 justify-center">
                    <button type="submit" class="btn" wire:loading.attr="disabled">
                        Confirm
                    </button>
                    <button type="button" x-on:click="open = false" wire:click='resetAll' class="btn btn-outline">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>