

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<!-- SlimScroll -->
<script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

<!-- FastClick -->
<script src="{{ asset('assets/plugins/fastclick/fastclick.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/app.min.js') }}"></script>
<!-- page script -->





<script>
    $(function() {

        //Initialize Select2 Elements
        $(".select2").select2();

        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false, // Set autoWidth to false for better performance
            "responsive": true, // Adds responsive design for mobile devices
            "language": { // Customizes the language to Indonesian
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
            },
            "columnDefs": [{
                    "width": "20%",
                    "targets": 0
                }, // Example for setting column width
                {
                    "orderable": false,
                    "targets": [0, 1]
                } // Disable ordering on specific columns
            ]
        });

    });
</script>
<script>
    function confirmLogout(event) {
        event.preventDefault();
        if (confirm('Apakah Anda yakin ingin logout?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
