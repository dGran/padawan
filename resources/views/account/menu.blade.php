<x-container class="pt-4 lg:pt-8">
    <div class="flex flex-col lg:flex-row lg:justify-between">
        <figure class="flex items-center space-x-3">
            <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name . " avatar" }}" class="flex-none | rounded-full | w-16 h-16 | object-cover">
            <div class="flex-none | flex flex-col justify-center">
                <span class="text-xl lg:text-2xl | font-medium | text-title-color dark:text-dt-title-color">{{ $user->name }}</span>
                <p class="flex items-center space-x-1 | text-xxs lg:text-xs">
                    <i class="fa-solid fa-envelope"></i>
                    <span>{{ $user->email }}</span>
                </p>
            </div>
        </figure>
        <div class="pt-3 lg:pt-0 flex items-center justify-center">
            <div class="flex-1 mt-4 lg:my-0 | flex justify-center lg:justify-end space-x-4 sm:space-x-16">
                <a href="{{ route('profile') }}" class="group | border-r sm:border-r-0 border-border-color dark:border-dt-border-color flex-1 sm:flex-initial flex flex-col sm:flex-row items-center text-center sm:text-left space-y-1.5 sm:space-y-0 sm:space-x-3 | focus:outline-none {{ Route::currentRouteName() !== 'profile' ?: 'pointer-events-none' }}">
                    <i class="fas fa-id-badge | text-lg w-9 h-9 rounded-full | {{ Route::currentRouteName() === 'profile' ? 'bg-sky-600 text-white' : 'bg-sky-200 text-sky-700 group-hover:bg-sky-600 group-hover:text-white' }} | flex items-center justify-center"></i>
                    <p class="flex flex-col | text-xxs lg:text-xs | leading-4">
                        <span class="font-semibold | {{ Route::currentRouteName() === 'profile' ? 'text-edblue-500 dark:text-white' : 'group-hover:text-edblue-500 dark:group-hover:text-white' }}">Perfil</span>
                        <span class="text-text-light-color | {{ Route::currentRouteName() === 'profile' ? 'text-edblue-500 dark:text-gray-300' : 'group-hover:text-edblue-500 dark:group-hover:text-gray-300' }}">Mi cuenta</span>
                    </p>
                </a>
                <a href="{{ route('notifications') }}" class="group | border-r sm:border-r-0 border-border-color dark:border-dt-border-color flex-1 sm:flex-initial flex flex-col sm:flex-row items-center text-center sm:text-left space-y-1.5 sm:space-y-0 sm:space-x-3 | focus:outline-none {{ Route::currentRouteName() !== 'notifications' && Route::currentRouteName() !== 'notifications.view'  ?: 'pointer-events-none' }}">
                    <i class="fas fa-bell | text-lg w-9 h-9 rounded-full | {{ Route::currentRouteName() === 'notifications' || Route::currentRouteName() === 'notifications.view' ? 'bg-sky-600 text-white' : 'bg-sky-200 text-sky-700 group-hover:bg-sky-600 group-hover:text-white' }} | flex items-center justify-center"></i>
                    <p class="flex flex-col | text-xxs lg:text-xs | leading-4">
                        <span class="font-semibold | {{ Route::currentRouteName() === 'notifications' ? 'text-edblue-500 dark:text-white' : 'group-hover:text-edblue-500 dark:group-hover:text-white' }}">Notificaciones</span>
                        <span class="text-text-light-color | {{ Route::currentRouteName() === 'notifications' ? 'text-edblue-500 dark:text-gray-300' : 'group-hover:text-edblue-500 dark:group-hover:text-gray-300' }}">Comunicados</span>
                    </p>
                </a>
                <a href="{{ route('my-teams') }}" class="group | flex-1 sm:flex-initial flex flex-col sm:flex-row items-center text-center sm:text-left space-y-1.5 sm:space-y-0 sm:space-x-3 | focus:outline-none {{ Route::currentRouteName() !== 'my-teams' ?: 'pointer-events-none' }}">
                    <i class="fas fa-user-shield | text-lg w-9 h-9 rounded-full | {{ Route::currentRouteName() === 'my-teams' ? 'bg-sky-600 text-white' : 'bg-sky-200 text-sky-700 group-hover:bg-sky-600 group-hover:text-white' }} | flex items-center justify-center"></i>
                    <p class="flex flex-col | text-xxs lg:text-xs | leading-4">
                        <span class="font-semibold | {{ Route::currentRouteName() === 'my-teams' ? 'text-edblue-500 dark:text-white' : 'group-hover:text-edblue-500 dark:group-hover:text-white' }}">Mis equipos</span>
                        <span class="text-text-light-color | {{ Route::currentRouteName() === 'my-teams' ? 'text-edblue-500 dark:text-gray-300' : 'group-hover:text-edblue-500 dark:group-hover:text-gray-300' }}">Equipos e-sports</span>
                    </p>
                </a>
            </div>
        </div>
    </div>
</x-container>
