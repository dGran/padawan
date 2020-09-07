<script>
    $('#second_round').change(function(){
        if ($(this).is(':checked')) {
            $("#inverse_order").prop('disabled', false);
            $('.inverse-order-text').removeClass('text-gray-500');
        } else {
            $("#inverse_order").prop('disabled', true);
            $("#inverse_order").prop('checked', false);
            $('.inverse-order-text').addClass('text-gray-500');
        }
    });
</script>