<div class="relative | bg-white dark:bg-dt-dark p-4 sm:py-8">
    <div class="flex flex-col items-center">
        <img src="{{ $user->getAvatarUrl() }}" alt="" class="mx-auto | w-32 h-32 | rounded-full | border border-border-color dark:border-dt-border-color">
        <h3 class="mt-1.5 text-lg | font-medium text-title-color dark:text-dt-title-color | text-center">
            {{ $user->name }}
        </h3>
        <x-link href="mailto:{{ $user->email }}">{{ $user->email }}</x-link>
    </div>
    @if ($user->profile)
        <div class="flex items-center justify-center space-x-0.5 pt-4">
            <a class="{{ $user->profile->whatsapp ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{-- {{ $user->profile->getWhatsappUrl() }} --}}" target="_blank">
                <i class="icon-whatsapp mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->twitter ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{ $user->profile->getTwitterUrl() }}" target="_blank">
                <i class="icon-twitter mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->facebook ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{ $user->profile->getFacebookUrl() }}" target="_blank">
                <i class="icon-facebook mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->instagram ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{ $user->profile->getInstagramUrl() }}" target="_blank">
                <i class="icon-instagram mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->twitch ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{ $user->profile->getTwitchUrl() }}" target="_blank">
                <i class="icon-twitch mr-3 rounded-full text-xl"></i>
            </a>
            <a class="{{ $user->profile->discord ?: 'hidden' }} opacity-70 hover:opacity-100 focus:outline-none focus:opacity-100" href="{{-- {{ $user->profile->getDiscordUrl() }} --}}" target="_blank">
                <i class="icon-discord mr-3 rounded-full text-xl"></i>
            </a>
        </div>
    @endif

    <i class="fas fa-times | absolute top-0 right-0 mt-2 mr-4 | text-lg | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>
</div>
