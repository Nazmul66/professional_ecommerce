<!-- latest jquery-->
<script src="{{ asset('public/backend/assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('public/backend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

<!-- Toastr JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Select2 js-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- feather icon js-->
<script src="{{ asset('public/backend/assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/icons/feather-icon/feather-icon.js') }}"></script>

<!-- Sweet Alert js-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- scrollbar js-->
<script src="{{ asset('public/backend/assets/js/scrollbar/simplebar.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/scrollbar/custom.js') }}"></script>

@stack('add-js')

<!-- Sidebar jquery-->
<script src="{{ asset('public/backend/assets/js/config.js') }}"></script>

<!-- Plugins JS start-->
<script src="{{ asset('public/backend/assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/sidebar-pin.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/slick/slick.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/slick/slick.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/header-slick.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/chart/apex-chart/moment.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/chart/echart/esl.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/chart/echart/config.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/chart/echart/pie-chart/facePrint.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/chart/echart/pie-chart/testHelper.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/chart/echart/pie-chart/custom-transition-texture.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/chart/echart/data/symbols.js') }}"></script>

<!-- calendar js-->
<script src="{{ asset('public/backend/assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/dashboard/dashboard_3.js') }}"></script>
<!-- Plugins JS Ends-->

<!-- Theme js-->
<script src="{{ asset('public/backend/assets/js/script.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/theme-customizer/customizer.js') }}"></script>


<script>
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "showDuration": "3000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "5000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }

    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type') }}";  // Define the JavaScript variable

        switch(type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
        }
    @endif

</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>