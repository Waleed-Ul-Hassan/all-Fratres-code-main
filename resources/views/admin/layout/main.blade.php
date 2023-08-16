@php $settings = \App\AdminSetting::first(); @endphp
<!DOCTYPE html>
<html>
@include('admin.partials.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin.partials.header')
    @include('admin.partials.sidebar')


    @yield('content')


    @include('admin.partials.footer')

    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>

</div>
@include('admin.partials.scripts')
</body>
</html>