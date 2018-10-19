<!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                Made by Jeric John Carillo
            </div>
            <!-- Default to the left -->
            <strong>Copyright © {{ date('Y') }} <a href="http://purpleplate.com/">Purple Plate</a>.</strong> All rights reserved.
        </footer>

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.3 -->
    <script src="{{ asset ('/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ('/bower_components/admin-lte/dist/js/adminlte.min.js') }}" type="text/javascript"></script>
    <!-- select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
    <!-- Extra JS -->
    @yield('js')
    </body>
</html>