<x-app-layout>
    <x-slot name="header">
        <h2 class="font-fjalla | text-xl md:text-2xl | text-black dark:text-white | tracking-wide">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="py-6 bg-contain md:bg-auto bg-no-repeat bg-center " style="background-image: url(https://www.footyrenders.com/render/kylian-mbappe-fifa-22.png)"> --}}

    <x-container class="py-6 text-base my-6">


<p class="bg-shark-500 p-6 font-light ...">The quick brown fox ...</p>
<p class="bg-shark-550 p-6 font-normal ...">The quick brown fox ...normal</p>

<p class="bg-shark-600 p-6 font-semibold ...">The quick brown fox ...semibold</p>
<p class="bg-shark-650 p-6 font-bold ...">The quick brown fox ...bold</p>
<p class="bg-shark-700 p-6 font-extrabold ...">The quick brown fox ...</p>
<p class="bg-shark-750 p-6 font-extrabold ...">The quick brown fox ...</p>
<p class="bg-shark-800 p-6 font-extrabold ...">The quick brown fox ...</p>
<p class="bg-shark-850 p-6 font-extrabold ...">The quick brown fox ...</p>
<p class="bg-shark-900 p-6 font-extrabold ...">The quick brown fox ...</p>

<style>
  body {
    background-color: white;
  }

.md-input-main {
    @apply font-sans text-xl w-full;
    width: 50%;
    font-size: 0.875rem;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";

}
.md-input-box {
    @apply relative;
    position: relative;
}
.md-input {
    @apply w-full;
    width: 100%;
    outline: none;
    height: 50px;
}
.md-label {
    @apply absolute pointer-events-none block;
    display: block;
    position: absolute;
    pointer-events: none;
    transform-origin: top left;
    transform: translate(0, -40px) scale(1);
    transition: color 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
}
.md-label-focus {
    @apply text-blue;
    color: #3182ce;
    transform: translate(0, -65px) scale(0.75);
    transform-origin: top left;
}
.md-input-underline {
    border-bottom: 1px solid #718096;;
}
.md-input-underline:after {
    @apply absolute left-0 right-0 pointer-events-none;
    position: absolute;
    left: 0;
    right: 0;
    pointer-events: none;
    bottom: -0.05rem;
    content: "";
    transition: transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
    transform: scaleX(0);
    border-bottom: 2px solid #805ad5;
}
.md-input:focus ~ .md-input-underline:after {
    transform: scaleX(1);
}
.md-input:focus + .md-label, .md-input:not(:placeholder-shown) + .md-label {
    @apply md-label-focus;
    color: #3182ce;
    transform: translate(0, -65px) scale(0.75);
    transform-origin: top left;
}
/* enable to leave border-bottom in modified color when the field is populated */
/*
.md-input:not(:placeholder-shown) ~ .md-input-underline:after {
    transform: scaleX(1);
}
*/

</style>

<div class="md-input-main">
  <div class="md-input-box">
    <input
           id="fullName"
           name="fullName"
           type="text"
           class="md-input"
           placeholder=" "
           />
    <label for="fullName" class="md-label">Full Name</label>
    <div class="md-input-underline" />
  </div>
</div>



    </x-container>

</x-app-layout>
