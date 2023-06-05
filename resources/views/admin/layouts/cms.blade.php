@include('admin.includes.head')

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('admin.includes.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('admin.includes.navigation')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; APSD Market 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
           
        </div>
    </div>

    @include('admin.includes.foot')

</body>