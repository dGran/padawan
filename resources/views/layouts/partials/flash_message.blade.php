<div class="custom-container relative">
    <div class="px-4">
        <div id="flash-container" style="z-index:9999; " class="fixed top-0 left-0 right-0 autoHide5s">
            <div class="container mx-auto">
                <div class="text-white text-sm p-4 m-4 rounded bg-{{ flash()->class }}-500 relative animated fadeInDown fast text-center">
					<span class="inline-block align-middle mr-10">
						{{ flash()->message }}
					</span>
                    <button class="bg-transparent text-2xl font-semibold leading-none absolute right-0 top-0 mt-4 mr-4 outline-none focus:outline-none" onclick="closeAlert()">
                        <span>×</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	function closeAlert(){
		animateCSS_remove('#flash-container div', 'fadeInDown');
		animateCSS_add('#flash-container div', 'fadeOutUp', function() {
			$('#flash-container').remove();
		});
	}
</script>
