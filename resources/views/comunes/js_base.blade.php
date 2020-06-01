<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>

<!-- Toast Notification -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- FullCalendar -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/locales-all.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-daygrid/main.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-timegrid/main.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-interaction/main.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-bootstrap/main.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>


<script type="text/javascript">
    @if(isset($notification))

        var type = "{{ $notification['alert-type'] }}"

        switch (type) {
            case 'info':
                toastr.info("{{ $notification['message'] }}");
                break;
            case 'warning':
                toastr.warning("{{ $notification['message'] }}");
                break;
            case 'danger':
                toastr.danger("{{ $notification['message'] }}");
                break;
            case 'success':
                toastr.success("{{ $notification['message'] }}");
                break;
        }

    @endif

</script>
