@extends('layouts.app', ['title' => 'Posts List'])

@section('styles')
	<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
	<style>
		.flickity-viewport {
		  height: 500px !important;
		}
	</style>
@endsection

@section('js')
	<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.11.0/dist/alpine.js"></script>
	<script>
		function carousel() {
		  return {
		    active: 0,
		    init() {
		      var flkty = new Flickity(this.$refs.carousel, {
		        wrapAround: true
		      });
		      flkty.on('change', i => this.active = i);
		    }
		  }
		}

		function carouselFilter() {
		  return {
		    active: 0,
		    changeActive(i) {
		      this.active = i;

		      this.$nextTick(() => {
		        let flkty = Flickity.data( this.$el.querySelectorAll('.carousel')[i] );
		        flkty.resize();

		        console.log(flkty);
		      });
		    }
		  }
		}
	</script>
@endsection

@section('content')
    @include('layouts.partials.flash_status_messages')

    <div class="custom-container below-fixed-header">
        <div class="py-8">



<div class="min-w-screen bg-gray-900 flex items-center justify-center px-5 py-5">
    <div class="bg-indigo-600 text-white rounded shadow-xl py-5 px-5 w-full lg:w-10/12 xl:w-3/4" x-data="{welcomeMessageShow:true}" x-show="welcomeMessageShow" x-transition:enter="transition-all ease duration-500 transform" x-transition:enter-start="opacity-0 scale-110" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-all ease duration-500 transform" x-transition:leave-end="opacity-0 scale-90">
        <div class="flex flex-wrap -mx-3 items-center">
            <div class="w-1/4 px-3 text-center hidden md:block">
                <div class="p-5 xl:px-8 md:py-5">
                    <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 868 731"><style>.st0{opacity:.5;fill:#434190;enable-background:new}.st1{fill:url(#SVGID_1_)}.st2{fill:url(#SVGID_2_)}.st3{fill:#434190}.st4{fill:url(#SVGID_3_)}.st5{fill:url(#SVGID_4_)}.st6{fill:url(#SVGID_5_)}.st7{fill:url(#SVGID_6_)}.st8{fill:url(#SVGID_7_)}.st9{fill:url(#SVGID_8_)}.st10{fill:url(#SVGID_9_)}.st11{fill:url(#SVGID_10_)}.st12{fill:url(#SVGID_11_)}.st13{fill:url(#SVGID_12_)}.st14{fill:url(#SVGID_13_)}.st15{fill:url(#SVGID_14_)}.st16{fill:url(#SVGID_15_)}.st17{fill:url(#SVGID_16_)}.st18{fill:url(#SVGID_17_)}.st19{fill:#fff}.st20{fill:url(#SVGID_18_)}.st21{fill:url(#SVGID_19_)}.st22{fill:url(#SVGID_20_)}.st23{opacity:.5;enable-background:new}.st24{fill:url(#SVGID_21_)}.st25{fill:#263238}.st26{fill:#f8c198}.st27{fill:#ff9800}.st28,.st29{opacity:.2}.st29{fill:#fff;enable-background:new}</style><title>welcome</title><path class="st0" d="M179 68.2h510v595.5H179V68.2z"/><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="731.5" y1="102" x2="731.5" y2="627" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-color="gray" stop-opacity=".25"/><stop offset=".54" stop-color="gray" stop-opacity=".12"/><stop offset="1" stop-color="gray" stop-opacity=".1"/></linearGradient><path class="st1" d="M595 105h273v525H595V105z"/><linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="136.5" y1="100" x2="136.5" y2="625" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-color="gray" stop-opacity=".25"/><stop offset=".54" stop-color="gray" stop-opacity=".12"/><stop offset="1" stop-color="gray" stop-opacity=".1"/></linearGradient><path class="st2" d="M0 107h273v525H0V107z"/><path class="st3" d="M604 113h255v506H604V113zM264 619H9V113h255v506z"/><linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="136.5" y1="542" x2="136.5" y2="573" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st4" d="M51 159h171v31H51v-31z"/><linearGradient id="SVGID_4_" gradientUnits="userSpaceOnUse" x1="732.5" y1="495" x2="732.5" y2="526" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st5" d="M647 206h171v31H647v-31z"/><linearGradient id="SVGID_5_" gradientUnits="userSpaceOnUse" x1="731.5" y1="447" x2="731.5" y2="478" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st6" d="M646 254h171v31H646v-31z"/><linearGradient id="SVGID_6_" gradientUnits="userSpaceOnUse" x1="731.5" y1="399" x2="731.5" y2="430" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st7" d="M646 302h171v31H646v-31z"/><linearGradient id="SVGID_7_" gradientUnits="userSpaceOnUse" x1="731.5" y1="351" x2="731.5" y2="382" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st8" d="M646 350h171v31H646v-31z"/><linearGradient id="SVGID_8_" gradientUnits="userSpaceOnUse" x1="731.5" y1="303" x2="731.5" y2="334" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st9" d="M646 398h171v31H646v-31z"/><linearGradient id="SVGID_9_" gradientUnits="userSpaceOnUse" x1="731.5" y1="255" x2="731.5" y2="286" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st10" d="M646 446h171v31H646v-31z"/><linearGradient id="SVGID_10_" gradientUnits="userSpaceOnUse" x1="731.5" y1="207" x2="731.5" y2="238" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st11" d="M646 494h171v31H646v-31z"/><linearGradient id="SVGID_11_" gradientUnits="userSpaceOnUse" x1="731.5" y1="159" x2="731.5" y2="190" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st12" d="M646 542h171v31H646v-31z"/><linearGradient id="SVGID_12_" gradientUnits="userSpaceOnUse" x1="731.5" y1="542" x2="731.5" y2="573" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st13" d="M646 159h171v31H646v-31z"/><linearGradient id="SVGID_13_" gradientUnits="userSpaceOnUse" x1="51" y1="508.5" x2="222" y2="508.5" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st14" d="M51 208h171v31H51v-31z"/><linearGradient id="SVGID_14_" gradientUnits="userSpaceOnUse" x1="51" y1="461.5" x2="222" y2="461.5" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st15" d="M51 255h171v31H51v-31z"/><linearGradient id="SVGID_15_" gradientUnits="userSpaceOnUse" x1="51" y1="414.5" x2="222" y2="414.5" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st16" d="M51 302h171v31H51v-31z"/><linearGradient id="SVGID_16_" gradientUnits="userSpaceOnUse" x1="51" y1="366.5" x2="222" y2="366.5" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st17" d="M51 350h171v31H51v-31z"/><linearGradient id="SVGID_17_" gradientUnits="userSpaceOnUse" x1="51" y1="318.5" x2="222" y2="318.5" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st18" d="M51 398h171v31H51v-31z"/><path class="st19" d="M55 163h164v24H55v-24zm-.5 47h164v24h-164v-24zm0 48h164v24h-164v-24zm0 48h164v24h-164v-24zm0 48h164v24h-164v-24zm0 48h164v24h-164v-24z"/><linearGradient id="SVGID_18_" gradientUnits="userSpaceOnUse" x1="51" y1="270.5" x2="222" y2="270.5" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-opacity=".12"/><stop offset=".55" stop-opacity=".09"/><stop offset="1" stop-opacity=".02"/></linearGradient><path class="st20" d="M51 446h171v31H51v-31z"/><path class="st19" d="M54.5 450h164v24h-164v-24z"/><path class="st19" d="M54.5 450h164v24h-164v-24zm0 48h164v24h-164v-24zm0 48h164v24h-164v-24zM650 162h164v24H650v-24zm0 48h164v24H650v-24zm0 48h164v24H650v-24zm0 48h164v24H650v-24zm0 48h164v24H650v-24zm0 48h164v24H650v-24zm0 48h164v24H650v-24zm0 48h164v24H650v-24zm0 48h164v24H650v-24z"/><linearGradient id="SVGID_19_" gradientUnits="userSpaceOnUse" x1="132" y1="68" x2="735" y2="68" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-color="gray" stop-opacity=".25"/><stop offset=".54" stop-color="gray" stop-opacity=".12"/><stop offset="1" stop-color="gray" stop-opacity=".1"/></linearGradient><path class="st21" d="M132 645h603v38H132v-38z"/><path class="st3" d="M137 649h594v30H137v-30z"/><linearGradient id="SVGID_20_" gradientUnits="userSpaceOnUse" x1="435" y1="643" x2="435" y2="682" gradientTransform="matrix(1 0 0 -1 0 732)"><stop offset="0" stop-color="gray" stop-opacity=".25"/><stop offset=".54" stop-color="gray" stop-opacity=".12"/><stop offset="1" stop-color="gray" stop-opacity=".1"/></linearGradient><path class="st22" d="M134 50h602v39H134V50z"/><path class="st3" d="M137 53h594v30H137V53z"/><path class="st23" d="M289 113h292v506H289V113z"/><linearGradient id="SVGID_21_" gradientUnits="userSpaceOnUse" x1="601" y1="27.2" x2="601" y2="326.022" gradientTransform="matrix(1 0 0 -1 -166 647.5)"><stop offset="0" stop-color="gray" stop-opacity=".25"/><stop offset=".54" stop-color="gray" stop-opacity=".12"/><stop offset="1" stop-color="gray" stop-opacity=".1"/></linearGradient><path class="st24" d="M659.7 333c7 9.4-3.5 20.5-3.5 20.5l1.8.6c-2.6 2.9-12.8 15.8-52.3 74.4-50.5 75-118.5 93.7-118.5 93.7-8.3-6.5-17.7-11.3-27.7-14.3v-7.1c26.1-7.7 46.7-27.7 55.3-53.5 6-11.9 9.2-25.1 9.1-38.4 0-48-39.8-86.9-88.8-86.9s-88.8 38.9-88.8 86.9c0 13.4 3.1 26.5 9.1 38.4 8.6 25.8 29.2 45.8 55.3 53.5v7.1c-10.1 3-19.5 7.8-27.7 14.3 0 0-68.1-18.7-118.6-93.7-39.4-58.6-49.7-71.5-52.3-74.4l1.8-.6s-10.5-11.1-3.5-20.5-46.1-20.5-40.1 0 13.9 30.7 13.9 30.7 111.2 175.4 169.2 204.4c-1.4 5.9-2.1 12-2.1 18.1v34.1h167.2v-34.1c0-6.1-.7-12.2-2.1-18.1 58-29 169.2-204.4 169.2-204.4s7.8-10.2 13.9-30.7-46.8-9.3-39.8 0z"/><circle class="st25" cx="435" cy="413.5" r="85.1"/><circle class="st26" cx="435" cy="426.8" r="80.1"/><circle class="st25" cx="403.3" cy="409.3" r="10"/><circle class="st25" cx="468.4" cy="409.3" r="10"/><path class="st19" d="M458.4 463.5c0 6-10.5 15.9-23.4 15.9s-23.4-9.9-23.4-15.9 10.5-5.8 23.4-5.8 23.4-.2 23.4 5.8z"/><circle class="st19" cx="405.8" cy="409.3" r="3.3"/><circle class="st19" cx="471.7" cy="409.3" r="3.3"/><path class="st25" d="M443 382.4c-4.9 0-9.3-4.2-9.8-9.1-.3-5 2.4-9.7 7-11.8.5-.2 1-.4 1.5-.4 1.7 0 2.5 2 3 3.6 1.7 4.9 4.7 9.7 9.3 12s11.2 1.1 13.7-3.5c-6.6-3-9.5-12.2-5.6-18.4 1.5-2.4 3.8-4.4 4.3-7.1.9-5-4.6-8.6-9.5-10.1-14-4.3-62.8-4.8-65.5 16.1-2.7 22.1 36.2 31.6 51.6 28.7z"/><ellipse transform="rotate(-21.534 358.22 427.678)" class="st26" cx="358.3" cy="427.7" rx="5" ry="14.2"/><ellipse transform="rotate(-68.469 511.725 427.634)" class="st26" cx="511.7" cy="427.6" rx="14.2" ry="5"/><path class="st27" d="M484.9 524.3s65.2-18.3 113.5-91.7 50.9-73.6 50.9-73.6l25.8 10.2S555 562.7 503.3 572.7s-18.4-48.4-18.4-48.4z"/><path class="st26" d="M646.8 359.3s10-10.8 3.3-20 44.2-20 38.4 0-13.3 30-13.3 30l-28.4-10z"/><path class="st27" d="M385.1 524.3s-65.2-18.3-113.5-91.7-50.9-73.6-50.9-73.6l-25.9 10.2s120.1 193.5 171.8 203.5 18.5-48.4 18.5-48.4z"/><path class="st26" d="M223.2 359.3s-10-10.8-3.3-20-44.2-20-38.4 0 13.3 30 13.3 30l28.4-10z"/><g class="st28"><path class="st19" d="M462.3 342.8c-.5 2.8-2.8 4.8-4.3 7.1-3.4 5.4-1.6 13.2 3.3 17-1.4-3.6-1.1-7.8.9-11.1 1.5-2.4 3.8-4.4 4.3-7.1.5-3.1-1.4-5.7-4.1-7.6 0 .5 0 1.1-.1 1.7zM441.5 362c-.3-.8-.6-1.5-.9-2.3-.5-1.6-1.4-3.5-3-3.6-.5 0-1 .1-1.5.4-4.6 2.1-7.3 6.8-7 11.8.4 3 2 5.6 4.5 7.4l-.3-1.5c-.3-5 2.4-9.7 7-11.8.3-.2.7-.3 1.2-.4zm-7.1 15.9c-12.2.5-31.8-4.1-41.5-14 7.2 15.4 37 21.8 50 19.3-3.5-.2-6.8-2.2-8.5-5.3zm28.3-8.3c-2.9 3.4-8.6 4.1-12.8 2.1-1.4-.7-2.6-1.6-3.7-2.6 1.6 3.6 4.4 6.6 7.9 8.4 4.7 2.3 11.2 1.1 13.7-3.5-2.1-.9-3.9-2.4-5.1-4.4z"/></g><path class="st29" d="M671.8 369.3S551.7 562.8 500 572.8c-3 .6-6 1-9.1 1.1 4.2.1 8.3-.3 12.4-1.1 51.7-10 171.8-203.5 171.8-203.5l-2.7-1c-.3.7-.5 1-.6 1zm-473.7 0S318.2 562.8 370 572.8c3 .6 6 1 9.1 1.1-4.2.1-8.3-.3-12.4-1.1-51.7-10-171.8-203.5-171.8-203.5l2.7-1c.3.7.5 1 .5 1z"/><path class="st27" d="M435 506.9c44.2 0 80.1 35.8 80.1 80.1v33.4H354.9V587c0-44.3 35.9-80.1 80.1-80.1z"/><path class="st29" d="M435.8 507.3c-2.9 0-5.8.2-8.7.5 1 0 1.9-.1 2.9-.1 44.2 0 80.1 35.8 80.1 80.1v32.9h5.8v-33.3c0-44.3-35.9-80.1-80.1-80.1z"/><path class="st29" d="M434.2 507.3c2.9 0 5.8.2 8.7.5-1 0-1.9-.1-2.9-.1-44.2 0-80.1 35.8-80.1 80.1v32.9h-5.8v-33.3c0-44.3 35.9-80.1 80.1-80.1z"/><path class="st26" d="M435 484.8c12.9 0 23.4 10.5 23.4 23.4v9.6c0 12.9-10.5 23.3-23.4 23.3-12.9 0-23.4-10.5-23.4-23.3v-9.6c0-13 10.5-23.4 23.4-23.4z"/></svg>
                </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-2/4 px-3 text-left">
                <div class="p-5 xl:px-8 md:py-5">
                    <h3 class="text-2xl">Welcome, Scott!</h3>
                    <h5 class="text-xl mb-3">Lorem ipsum sit amet</h5>
                    <p class="text-sm text-indigo-200">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro sit asperiores perferendis odit enim natus ipsum reprehenderit eos eum impedit tenetur nemo corporis laboriosam veniam dolores quos necessitatibus, quaerat debitis.</p>
                </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4 px-3 text-center">
                <div class="p-5 xl:px-8 md:py-5">
                    <a class="block w-full py-2 px-4 rounded text-indigo-600 bg-gray-200 hover:bg-white hover:text-gray-900 focus:outline-none transition duration-150 ease-in-out mb-3" href="https://codepen.io/ScottWindon" target="_blank">Find out more?</a>
                    <button class="w-full py-2 px-4 rounded text-white bg-indigo-900 hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out" @click.prevent="welcomeMessageShow=false;setTimeout(()=>{welcomeMessageShow=true},2000)">No thanks</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="absolute bottom-0 pb-2 text-gray-700 text-xs w-full text-center">
  See more: <a href="https://codepen.io/ScottWindon" class="underline hover:text-gray-500" target="_blank">https://codepen.io/ScottWindon</a>
</div>

<div class="my-20">
  <div class="max-w-sm rounded-sm border border-gray-200 bg-white shadow-lg">
    <div class="text-right p-4">
      <span class="text-xs text-gray-500 tracking-widest uppercase">few weeks ago</span>
    </div>

    <div class="flex items-center relative mb-10">
      <div class="border-t border-gray-200 z-20 w-full"></div>

      <div class="rounded-full bg-red-400 z-30 p-2 inline-block absolute mx-8">
        <svg class="fill-current text-white inline-block h-10 w-10" height="72" viewBox="0 0 72 72" width="72" xmlns="http://www.w3.org/2000/svg">
          <path d="M24.0624545,22.6532727 C26.4559091,22.6532727
                   28.4607273,20.7771818 28.4607273,18.3185455
                   C28.4607273,15.8615455 26.4559091,13.986
                   24.0624545,13.986 C21.669,13.986 19.6644545,15.8615455
                   19.6644545,18.3185455 C19.6644545,20.7771818
                   21.669,22.6532727 24.0624545,22.6532727
                   L24.0624545,22.6532727 Z M14.9424545,45.8620909
                   C14.6841818,46.9617273 14.5543636,48.1491818
                   14.5543636,49.1179091 C14.5543636,52.9347273
                   16.6240909,55.4686364 21.0226364,55.4686364
                   C24.6706364,55.4686364 27.6278182,53.3020909
                   29.757,49.8043636 L28.4569091,55.0224545
                   L35.7005455,55.0224545 L39.8405455,38.4177273
                   C40.8752727,34.2133636 42.8803636,32.0312727
                   45.9207273,32.0312727 C48.3139091,32.0312727
                   49.8016364,33.5195455 49.8016364,35.9765455
                   C49.8016364,36.6886364 49.7367273,37.464
                   49.4781818,38.3050909 L47.3432727,45.9373636
                   C47.0198182,47.037 46.8910909,48.1374545
                   46.8910909,49.1713636 C46.8910909,52.7948182
                   49.0251818,55.4451818 53.4880909,55.4451818
                   C57.3043636,55.4451818 60.3441818,52.9884545
                   62.0260909,47.1021818 L59.1804545,46.0033636
                   C57.7570909,49.947 56.5281818,50.6599091
                   55.5580909,50.6599091 C54.5877273,50.6599091
                   54.0700909,50.0135455 54.0700909,48.7205455
                   C54.0700909,48.1385455 54.1999091,47.4924545
                   54.3935455,46.7146364 L56.4638182,39.2787273
                   C56.9809091,37.5327273 57.1753636,35.9844545
                   57.1753636,34.5619091 C57.1753636,28.9993636
                   53.8115455,26.0964545 49.7367273,26.0964545
                   C45.9207273,26.0964545 42.0395455,29.5385455
                   40.0996364,33.1611818 L41.5221818,26.6588182
                   L30.462,26.6588182 L28.9093636,32.3860909 L34.0840909,32.3860909
                   L30.8978182,45.1437273 C28.3952727,50.7062727 23.7987273,50.7965455
                   23.2219091,50.6672727 C22.2747273,50.4537273 21.669,50.094 21.669,48.8631818
                   C21.669,48.153 21.7982727,47.133 22.1217273,45.903 L26.9732727,26.6588182
                   L14.6841818,26.6588182 L13.1315455,32.3860909 L18.2410909,32.3860909 L14.9424545,45.8620909
                   L14.9424545,45.8620909 Z"></path>
        </svg>
      </div>
    </div>
    <div class="px-8 pb-4">
      <h4 class="text-gray-500 text-sm font-light">InVision</h4>
      <h2 class="text-gray-800 text-xl font-bold">InVision</h2>
      <p class="text-gray-600 text-xs">
        Put toy mouse in food bowl run out of litter box at full speed drool but pee in the shoe purr when being pet but chew foot.
      </p>
    </div>
  </div>
</div>




			@include('home.index.slider')

			<div class="mt-32">
	            <h2 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
	                Content title
	            </h2>
	            <p class="pt-3">
	            	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores pariatur et fuga ut ipsam blanditiis at ullam, earum, doloremque ipsa cumque nam aliquid nulla repudiandae libero quibusdam quidem nisi tempora, facilis veritatis maiores. Odio vero ipsum distinctio quam cum numquam sunt doloribus repellat, nostrum laborum tenetur aliquam voluptas, recusandae laboriosam libero enim, eaque veniam suscipit. Eaque sint debitis minus omnis maxime vero. Illum consequatur, a voluptas, eum ad vel, vero itaque, voluptate accusamus expedita at impedit! Beatae ipsam nobis totam at explicabo atque quos quia voluptatem, ratione quod. Beatae repudiandae at blanditiis, facilis nobis sint vel labore, sit placeat tempora, molestiae. Quo voluptatibus repellat, deleniti qui, quia ipsa? Libero modi itaque delectus vitae eum officia sed harum unde omnis. Asperiores iste laboriosam voluptatibus officia dignissimos incidunt excepturi magni rerum saepe. Harum, fuga error nobis debitis sit suscipit ratione ab obcaecati vitae quibusdam. Reprehenderit, nam, sunt. Inventore fugiat veniam hic. Est molestiae unde nulla consequuntur numquam facilis aliquam totam perspiciatis in corporis, aperiam et quam enim recusandae, harum dolorem at. Assumenda molestias, deserunt quaerat, qui possimus aliquid impedit commodi at vitae expedita, adipisci itaque maxime saepe corporis ducimus hic repellendus dolorem eligendi quasi rerum aut corrupti aperiam voluptates. Odio perspiciatis quasi, placeat. Repudiandae omnis, dolorem harum! Veritatis fuga veniam iusto beatae deleniti non quia voluptate repellendus sed. Porro itaque sit dignissimos aperiam ab beatae quam maxime quasi. Error officia cupiditate atque, repudiandae pariatur quidem perferendis natus tempora expedita quisquam perspiciatis aliquid soluta! Cumque doloribus enim quaerat sed, soluta impedit delectus iure voluptates officia laudantium aspernatur accusamus voluptatem, vitae aut consequatur, ea commodi et. Doloribus, iure, ipsum. Facere numquam beatae illum repellat delectus, consectetur perspiciatis atque sequi hic earum? Hic officiis vitae recusandae perferendis quo excepturi cumque rerum numquam illum quidem, quia facere aut in, deserunt cum iusto rem doloribus quis amet.
	            </p>
            </div>

			{{-- <iframe class="mt-8 w-full h-screen" src="https://docs.google.com/viewer?url=http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf&embedded=true"  frameborder="0"></iframe> --}}

        </div>
    </div>
@endsection