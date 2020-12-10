<div class="custom-container text-gray-800">
    <div class="mt-4 mb-8">
    	<ul>
    	@foreach ($notifications as $notification)
    		<li class="{{ $notification->read ?: 'font-bold' }}">
    			{{ $notification->created_at }} - {{ $notification->text }}
    		</li>
    	@endforeach
    	<ul>

    </div>
</div>