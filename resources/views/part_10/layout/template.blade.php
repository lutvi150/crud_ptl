@include('part_10.layout.header')

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>
    @include('part_10.layout.aside')
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        @include('part_10.layout.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content')
            @include('part_10.layout.footer')
        </div>
    </main>
    @include('part_10.layout.fixed_plugin')
    </div>
    @include('part_10.layout.script')
</body>
@yield('script')
</html>