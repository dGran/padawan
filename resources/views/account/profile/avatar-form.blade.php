<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="px-6 py-4">
            <div class="flex flex-col items-center space-y-3">
                <figure class="relative">
                    <img src="{{ $avatar ? $avatar->temporaryUrl() : $avatarPreview }}" alt="{{ $user->name }}" class="rounded-full w-32 h-32 object-cover border border-border-color dark:border-dt-border-color | relative">
                    @if ($avatar)
                        <div class="absolute left-0 bottom-0">
                            <div class="flex items-center justify-between space-x-3 w-32">
                                <button type="button" wire:loading.attr="disabled" wire:click="remove"
                                        class="px-4 py-1.5 w-12 bg-rose-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-rose-700 hover:shadow-lg focus:bg-rose-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-rose-800 active:shadow-lg transition duration-150 ease-in-out cursor-default">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <button type="submit" wire:loading.attr="disabled"
                                        class="px-4 py-1.5 w-12 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out cursor-default">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </figure>
                <label class="flex items-center justify-center space-x-3 | mt-1.5 px-4 py-2 | border border-border-color dark:border-dt-border-color | rounded-lg | cursor-pointer | hover:bg-border-color dark:hover:bg-dt-border-color | hover:text-title-color dark:hover:text-dt-title-color">
                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                    </svg>
                    <span class="">Selecciona imagen</span>
                    <input type="file" class="hidden" accept=".jpeg, .png, .jpg, .gif, .svg" wire:model="avatar">
                </label>
                @error('avatar') <p class="text-red-400 | mt-1 | text-xxs md:text-xs">{{ $message }}</p> @enderror
            </div>
        </div>
    </form>
</div>
