<!-- Block 1 -->
<div class="">
    @include('layouts.partials.app.footer.menus')
    <x-container class="pt-6 pb-4 md:py-4">
        <div class="md:hidden">
            @include('layouts.partials.app.footer.social')
        </div>
    </x-container>
</div>

<!-- Block 2 -->
<div class="border-t border-gray-300 dark:border-transparent | pt-2 md:pt-6">
    <x-container class="flex items-center justify-center">
        @include('layouts.partials.app.footer.copyright')
    </x-container>
</div>
