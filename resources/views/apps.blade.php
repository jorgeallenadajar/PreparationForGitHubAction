<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.headers')
</head>

<body>

    <!-- ======= Header ======= -->

    @include('includes.head_nav')

    <!-- End Header -->

    <!-- ======= Sidebar ======= -->

    @include('includes.sidebar')
        <!-- End Sidebar-->




    <main id="main" class="main">

     

      @yield('section')

    </main>



    <!-- End #main -->

    
    <!-- ======= Footer ======= -->
    @include('includes.footer')

    <!-- End Footer -->


    <!-- Scripts -->
    @include('includes.scripts')
    <!-- scripts -->






    @yield('script')

</body>

</html>