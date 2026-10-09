<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">



    <!-- Custom styles for this template-->
    <link href="{{ asset('theme/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/js/app.js'])

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Cairo", sans-serif;
            background-color: #f0f0f0;
        }

        ul {
            padding-inline-start: 0px;

        }

        div.dt-container {
            margin: 0 auto;

        }

        @if (app()->getLocale() == 'ar')
            /* إصلاح الحواف للزر الأول (السابق) في الاتجاه العربي */
            .pagination .page-item:first-child .page-link,
            .dataTables_wrapper .paginate_button.previous {
                border-top-left-radius: 0 !important;
                border-bottom-left-radius: 0 !important;
                border-top-right-radius: 5px !important;
                border-bottom-right-radius: 5px !important;
            }

            /* إصلاح الحواف للزر الأخير (التالي) في الاتجاه العربي */
            .pagination .page-item:last-child .page-link,
            .dataTables_wrapper .paginate_button.next {
                border-top-right-radius: 0 !important;
                border-bottom-right-radius: 0 !important;
                border-top-left-radius: 5px !important;
                border-bottom-left-radius: 5px !important;
            }

            /* حل مشكلة تداخل الخط الفاصل بين الزرين (Border Overlap) في الـ RTL */
            .pagination .page-item:not(:first-child) .page-link {
                margin-left: 0 !important;
                margin-right: -1px !important;
            }
        @endif
    </style>
    <title>Bookstore</title>
    {{ $head ?? '' }}

</head>

<body id="page-top">
    @include('sweetalert2::index')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <x-theme.sidebar />
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <x-theme.header>
                    {{ $title ?? '' }}
                </x-theme.header>

                <!-- End of Topbar -->
                <div class="container-fluid">
                    {{-- Session Flash Message To Be add Here --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif



                    <!-- Content Row -->
                    <div class="row justify-content-center">
                        {{ $slot }}
                    </div>

                    <!-- Content Row -->

                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <x-theme.footer />
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('theme/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('theme/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('theme/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('theme/js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    {{-- <script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('theme/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('theme/js/demo/datatables-demo.js') }}"></script> --}}
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    {{ $script ?? '' }}
</body>

</html>
