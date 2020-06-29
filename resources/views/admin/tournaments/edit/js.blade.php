<script>
	var game_rosters = 0;
	check_game_rosters();
	check_market();

	function showImage(fileInput) {
		thumbnail.src = '{{ asset('img/tournaments/default.png') }}';
		deleteImg.value = 0;

		var files = fileInput.files;
		for (var i = 0; i < files.length; i++) {
			var file = files[i];
			var imageType = /image.*/;
			if (!file.type.match(imageType)) {
				continue;
			}
			var img=document.getElementById("thumbnail");
			img.file = file;
			var reader = new FileReader();
			reader.onload = (function(aImg) {
				return function(e) {
					aImg.src = e.target.result;
				};
			})(img);
			reader.readAsDataURL(file);
		}
		$('#delete_img').removeClass('hidden');
	}

	function deleteImage() {
		var thumbnail = document.getElementById("thumbnail");
		var deleteImg = document.getElementById("deleteImg");

		thumbnail.src = '{{ asset('img/tournaments/default.png') }}';
		deleteImg.value = 1;

		$('#delete_img').addClass('hidden');
	}

	function check_market() {
		if ($('#market').is(':checked')) {
			$('#use_rosters').prop('checked', true).prop('disabled', true);
			$('#use_economy').prop('disabled', false).parents('.custom-label').removeClass('disable');
			$('.info_use_economy').addClass('text-blue-500').removeClass('text-blue-300');
			$('#use_salaries').prop('disabled', false).parents('.custom-label').removeClass('disable');
			$('.info_use_salaries').addClass('text-blue-500').removeClass('text-blue-300');
			$('#use_transfers').prop('disabled', false).parents('.custom-label').removeClass('disable');
			$('.info_use_transfers').addClass('text-blue-500').removeClass('text-blue-300');
			$('#use_clauses').prop('disabled', false).parents('.custom-label').removeClass('disable');
			$('.info_use_clauses').addClass('text-blue-500').removeClass('text-blue-300');
			$('#use_free_agents').prop('disabled', false).parents('.custom-label').removeClass('disable');
			$('.info_use_free_agents').addClass('text-blue-500').removeClass('text-blue-300');
		} else {
			$('#use_rosters').prop('disabled', false);
			$('#use_economy').prop('checked', false).prop('disabled', true).parents('.custom-label').addClass('disable');
			$('.info_use_economy').removeClass('text-blue-500').addClass('text-blue-300');
			$('#use_salaries').prop('checked', false).prop('disabled', true).parents('.custom-label').addClass('disable');
			$('.info_use_salaries').removeClass('text-blue-500').addClass('text-blue-300');
			$('#use_transfers').prop('checked', false).prop('disabled', true).parents('.custom-label').addClass('disable');
			$('.info_use_transfers').removeClass('text-blue-500').addClass('text-blue-300');
			$('#use_clauses').prop('checked', false).prop('disabled', true).parents('.custom-label').addClass('disable');
			$('.info_use_clauses').removeClass('text-blue-500').addClass('text-blue-300');
			$('#use_free_agents').prop('checked', false).prop('disabled', true).parents('.custom-label').addClass('disable');
			$('.info_use_free_agents').removeClass('text-blue-500').addClass('text-blue-300');
		}
	}

	function check_use_rosters() {
		var type = $("#participant_type option:selected").val();
		if (type == "eteam") {
			$('#market').prop('checked', false).prop('disabled', true);
			check_market();
			$('#use_rosters').prop('checked', false).prop('disabled', true);
			$('.info_use_rosters').removeClass('text-blue-500').addClass('text-blue-300');
		} else {
			$('#market').prop('disabled', false);
			$('#use_rosters').prop('disabled', false);
			$('.info_use_rosters').addClass('text-blue-500').removeClass('text-blue-300');
		}
	}

	function check_game_rosters()
	{
		game_rosters = $("#game_id option:selected").attr('data-game-rosters');
		if (game_rosters == 1) {
			$('#use_rosters').parents('.custom-label').show();
			$('.info_use_rosters').show();
			$('#market').parents('.custom-label').show();
			$('#use_economy').parents('.custom-label').show();
			$('.info_use_economy').show();
			$('#use_salaries').parents('.custom-label').show();
			$('.info_use_salaries').show();
			$('#use_transfers').parents('.custom-label').show();
			$('.info_use_transfers').show();
			$('#use_clauses').parents('.custom-label').show();
			$('.info_use_clauses').show();
			$('#use_free_agents').parents('.custom-label').show();
			$('.info_use_free_agents').show();
		} else {
			$('#use_rosters').prop('checked', false).parents('.custom-label').hide();
			$('.info_use_rosters').hide();
			$('#market').prop('checked', false).parents('.custom-label').hide();
			$('#use_economy').prop('checked', false).parents('.custom-label').hide();
			$('.info_use_economy').hide();
			$('#use_salaries').prop('checked', false).parents('.custom-label').hide();
			$('.info_use_salaries').hide();
			$('#use_transfers').prop('checked', false).parents('.custom-label').hide();
			$('.info_use_transfers').hide();
			$('#use_clauses').prop('checked', false).parents('.custom-label').hide();
			$('.info_use_clauses').hide();
			$('#use_free_agents').prop('checked', false).parents('.custom-label').hide();
			$('.info_use_free_agents').hide();
		}
	}

    $("#form-edit").submit(function(event) {
    	$('input:checkbox').prop('disabled', false);
        disabledActionsButtons();
    });
</script>