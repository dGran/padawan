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