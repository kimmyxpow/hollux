<form wire:submit.prevent='update' method="POST" class="space-y-4">
    <h3 class="text-xl text-gray-800 font-bold">Your Review</h3>
    <div class="grid gap-2">
        <div class="form-control">
            <label for="star" class="label">Star</label>
            <div>
                @for ($i = 0; $i < $star; $i++)
                    <i wire:click="setRating({{ $i+1 }})" class='bx bx-star text-lg cursor-pointer text-orange-600'></i>
                @endfor

                @for ($i = $star; $i < 5; $i++)
                    <i wire:click="setRating({{ $i+1 }})" class='bx bx-star text-lg cursor-pointer text-gray-400'></i>
                @endfor
            </div>
            @error('star')
                <span class="text-red-500 italic font-medium text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-control">
            <label for="message" class="label">Message</label>
            <textarea placeholder="Message..." wire:model="message" id="message" class="textarea" rows="6"></textarea>
            @error('message')
                <span class="text-red-500 italic font-medium text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <button class="btn" type="submit">Update</button>
</form>