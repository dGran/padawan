<script>
    $(function() {
        Mousetrap.bind(['/'], function() {
            $('.search-input').focus();
            return false;
        });
    });


    function rowSelect(element) {
        $(element).siblings('.select').find('.mark').trigger('click');
    }

    function showHideRowOptions(element) {
        if ($(element).is(':checked')) {
            $(element).parents('tr').addClass('selected');
        } else {
            $(element).parents('tr').removeClass('selected');
        }

        elements = $(".mark:checked").length;
        if (elements > 0) {
        	$(".table-wrap").addClass('mb-20');
        	$(".selected-regs").addClass('fadeInUp');
        	$(".selected-regs").removeClass('fadeOutDown hidden');
        	if (elements == 1) {
        		$(".selected-regs-count").text($(".mark:checked").parents('tr').attr('data-name'));
        	} else {
        		$(".selected-regs-count").text(elements + ' registros');
        	}
        } else {
        	$(".table-wrap").removeClass('mb-20');
        	$(".selected-regs").removeClass('fadeInUp hidden');
        	$(".selected-regs").addClass('fadeOutDown');
        }
    }

    function changeSort(field, direction) {
    	$("#sortField").val(field);
    	if (!direction) {
    		$("#sortDirection").val('asc');
    	} else if (direction == 'asc') {
    		$("#sortDirection").val('desc');
    	} else {
    		$("#sortDirection").val('asc');
    	}
    	applyFilters();
    }

    function applyFilters() {
    	$("#frmFilter").submit();
    }

    function showHideAllRowOptions() {
        if ($("#allMark").is(':checked')) {
            $(".mark").prop('checked', true);
            $(".mark").parents('tr').addClass('selected');
        } else {
            $(".mark").prop('checked', false);
            $(".mark").parents('tr').removeClass('selected');
        }
        showHideRowOptions();
    }

    function disabledActionsButtons() {
        $('a').addClass('disabled');
        $('button').attr("disabled", "disabled");
    }


</script>