{{-- Toastr --}}
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "300",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

      // success message popup notification
      @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
      @endif
      // info message popup notification
      @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
      @endif
      // warning message popup notification
      @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
      @endif
      // error message popup notification
      @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
      @endif
</script>
{{-- END: Toastr --}}