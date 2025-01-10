<!DOCTYPE html>
 <html dir="ltr" lang="en">
 
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <!-- Tell the browser to be responsive to screen width -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="">
     <meta name="author" content="">
     <!-- Favicon icon -->
     <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
     <title>Free2kart</title>
     <!-- Custom CSS -->
     <link href="{{asset('assets/libs/flot/css/float-chart.css')}}" rel="stylesheet">
     <!-- Custom CSS -->
     <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
     <link href="{{asset('dist/css/style.css')}}" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="{{asset('assets/extra-libs/multicheck/multicheck.css')}}">
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/jquery-minicolors/jquery.minicolors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/quill/dist/quill.snow.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/css/ionicons.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    
    
</head>
 
 <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">


       
    

        @includeIf('admin.body.header')
        @includeIf('admin.body.sidebar')

        
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
                            </ol>
                        </nav>                      
                    </div>
                </div>
            </div>

            
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                @includeIf('admin.flesh-message')

                @yield('admin')

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
 
 
 
 
 <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <!--This page JavaScript -->
    <!-- <script src="{{asset('dist/js/pages/dashboards/dashboard1.js')}}"></script> -->
    <!-- Charts js Files -->
    <script src="{{asset('assets/libs/flot/excanvas.js')}}"></script>
    <script src="{{asset('assets/libs/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/libs/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assets/libs/flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('assets/libs/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
    <script src="{{asset('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/chart/chart-page-init.js')}}"></script>
    <script src="{{asset('assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>
    <script src="{{asset('assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
    <script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
    // Initialize Select2 for the dropdown
    $(document).ready(function() {
        $('.select_multiple').select2({
            width: 'resolve', // Adjust width automatically
            placeholder: "Type to search and select categories", // Placeholder text
            allowClear: true // Allow clearing selection
        });
    });
</script>
    
    
    

    <script>
        /**************
         *       Basic Table                   *
         **************/
        $('#zero_config').DataTable();
    </script>
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
    </script>
    <!--<script>-->
    <!--    document.querySelectorAll('.has-arrow > .sidebar-link').forEach(item => {-->
    <!--        item.addEventListener('click', function() {-->
    <!--        const submenu = this.nextElementSibling; // Get the submenu-->
    <!--        if (submenu) {-->
    <!--            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';-->
    <!--        }-->
    <!--    });-->
    <!--});-->
    <!--</script>-->
    
    <script>
document.addEventListener("DOMContentLoaded", function() {
    let wakeLock = null;

    // Function to request the wake lock
    async function requestWakeLock() {
    try {
        if ('wakeLock' in navigator) {
            wakeLock = await navigator.wakeLock.request('screen');
            console.log("Wake lock is active");
        } else {
            console.error("Wake Lock API is not supported on this browser.");
        }
    } catch (err) {
        console.error(`${err.name}: ${err.message}`); // Correct string interpolation
    }
}


    // Function to release the wake lock
    function releaseWakeLock() {
    if (wakeLock !== null) {
        wakeLock.release()
            .then(() => {
                wakeLock = null;
                console.log("Wake lock is released");
            })
            .catch(err => console.error(`${err.name}: ${err.message}`));  // Fixed string interpolation
    }
}

    // Request the wake lock when the page is visible
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'visible') {
            requestWakeLock();
        } else {
            releaseWakeLock();
        }
    });

    // Initial wake lock request when the page loads
    requestWakeLock();

    // Clean up wake lock on page unload
    window.addEventListener('unload', releaseWakeLock);
});
</script>


</body>

</html>