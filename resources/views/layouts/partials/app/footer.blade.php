<div class="bg-gray-700 py-2">
	<div class="custom-container text-xs">
        <div class="py-2">
            <span class="text-xl">Pending! check this</span>
            <div class="text-gray-500">
                <i class="fa fa-info mr-2" aria-hidden="true"></i>
                <a target="_blank" href="https://github.com/spatie/laravel-blade-javascript" class="hover:text-white">
                    https://github.com/spatie/laravel-blade-javascript
                </a>
            </div>
            <div class="text-gray-500">
                <i class="fa fa-info mr-2" aria-hidden="true"></i>
                <a target="_blank" href="https://github.com/spatie/laravel-database-mail-templates" class="hover:text-white">
                    https://github.com/spatie/laravel-database-mail-templates
                </a>
            </div>
            <div class="text-gray-500">
                <i class="fa fa-info mr-2" aria-hidden="true"></i>
                <a target="_blank" href="https://github.com/spatie/laravel-newsletter" class="hover:text-white">
                    https://github.com/spatie/laravel-newsletter
                </a>
            </div>
            <div class="text-gray-500">
                <i class="fa fa-info mr-2" aria-hidden="true"></i>
                <a target="_blank" href="https://github.com/spatie/laravel-sitemap" class="hover:text-white">
                    https://github.com/spatie/laravel-sitemap
                </a>
            </div>
	        <a href="https://api.whatsapp.com/send?phone=34662120199&text=Whatsapp%20test%20message%0ASalto de linea%0A*y negrita*">
	        	Whatsapp test to Marcel
	        </a>
        </div>
	</div>
</div>

<div class="bg-gray-800 text-gray-600">
	<div class="custom-container text-xs">
		<div class="flex items-center py-3">
			<div class="flex-1">
				<ul class="">
					<li class="inline-block mr-4">
						<a href="{{ route('contact') }}" class="hover:text-gray-400">
							Contact
						</a>
					</li>
					<li class="inline-block mr-4">
						<a href="{{ route('privacy_policy') }}" class="hover:text-gray-400">
							Privacy Policy
						</a>
					</li>
					<li class="inline-block">
						<a href="{{ route('cookie_policy') }}" class="hover:text-gray-400">
							Cookie Policy
						</a>
					</li>
				</ul>
			</div>
			<div class="flex-2">
				<span class="hidden md:inline-block mr-4">
					Follow us
				</span>
			</div>
			<div class="flex-2">
				<ul class="inline-block">
					<li class="inline-block">
						<a href="#" class="hover:text-gray-400">
							<i class="fab fa-facebook text-2xl"></i>
						</a>
					</li>
					<li class="inline-block ml-2"><a href="#">
						<a href="#" class="hover:text-gray-400">
							<i class="fab fa-twitter text-2xl"></i>
						</a>
					</li>
					<li class="inline-block ml-2"><a href="#">
						<a href="#" class="hover:text-gray-400">
							<i class="fab fa-instagram text-2xl"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="custom-container text-gray-400 text-xs text-center py-3">
    <div class="px-4">
		{{ env('APP_NAME') }}. Copyright &copy; <?php echo date("Y"); ?> All rights reserved.
	</div>
</div>