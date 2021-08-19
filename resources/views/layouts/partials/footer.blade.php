<!-- Block 1 -->

<div class="border-b dark:border-dark-800">
    @include('layouts.partials.footer.menus')
    <x-container class="py-3 md:py-5">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="md:order-2 pb-3 md:pb-0 border-b md:border-0 dark:border-dark-800 -mx-4 md:mx-0">
                @include('layouts.partials.footer.social')
            </div>
            <div class="md:order-1 pt-3 md:pt-0 font-miriam font-medium">
                @include('layouts.partials.footer.conected-users')
            </div>
        </div>
    </x-container>
</div>

<!-- Block 2 -->
<div class="border-b dark:border-dark-800">
    @include('layouts.partials.footer.web-description')
</div>

<!-- Block 3 -->
<x-container class="flex flex-col items-center py-3 md:py-5">
    @include('layouts.partials.footer.developed')
    @include('layouts.partials.footer.copyright')
</x-container>