<div class="flex items-center leading-6">
    <i class="{{ $usersOnline == 1 ? 'fas fa-user' : 'fas fa-users' }} w-6 text-center"></i>
    <div class="w-28 md:w-32 ml-2 text-xxs md:text-xs uppercase">usuarios online</div>
    <span class="text-xs md:text-sm font-medium {{ $usersOnline == 0 ?: 'text-sky-700 dark:text-cyan-300' }}">{{ $usersOnline }}</span>
</div>
<div class="flex items-center leading-6">
    <i class="{{ $visitorsOnline == 1 ? 'fas fa-user-slash' : 'fas fa-users-slash' }} w-6 text-center"></i>
    <div class="w-28 md:w-32 ml-2 text-xxs md:text-xs uppercase">invitados online</div>
    <span class="text-xs md:text-sm font-medium {{ $visitorsOnline == 0 ?: 'text-yellow-600 dark:text-yellow-300' }}">{{ $visitorsOnline }}</span>
</div>