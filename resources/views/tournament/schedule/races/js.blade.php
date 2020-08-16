<script>
	var next_race = '{{ $racing->nextRace() }}';

	if (next_race && '{{ $racing->nextRaceDate() }}' > '{{ \Carbon\Carbon::now() }}') {
		const second = 1000,
		minute = second * 60,
		hour = minute * 60,
		day = hour * 24;

		var next_race_date = '{{ $racing->nextRaceDateTimestamp() }}';

		let countDown = new Date(next_race_date * 1000).getTime(),
		x = setInterval(function() {
			let now = new Date().getTime(),
			  distance = countDown - now;
			$('#days').text(Math.floor(distance / (day)));
			if ($('#days').text() == '0') {
				$('#days').text('-');
			}
			$('#hours').text(Math.floor((distance % (day)) / (hour)));
			if ($('#hours').text() == '0' && $('#days').text() == '-') {
				$('#hours').text('-');
			}
			$('#minutes').text(Math.floor((distance % (hour)) / (minute)));
			if ($('#minutes').text() == '0' && $('#hours').text() == '-' && $('#days').text() == '-') {
				$('#minutes').text('-');
			}
			$('#seconds').text(Math.floor((distance % (minute)) / (second)));
			if ($('#seconds').text() == '0' && $('#minutes').text() == '-' && $('#hours').text() == '-' && $('#days').text() == '-') {
				$('#seconds').text('-');
			}
			//do something later when date is reached
			if (distance < 0) {
				$('#days').text('-');
				$('#hours').text('-');
				$('#minutes').text('-');
				$('#seconds').text('-');
				location.reload();
			}
		}, second)
	}

</script>