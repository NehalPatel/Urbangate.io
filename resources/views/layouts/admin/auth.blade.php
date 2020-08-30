<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- begin::Head -->
    <head>

        <meta charset="utf-8">
        <meta name="description" content="Login page example">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- ==========  Stylesheets  ========== -->
        @include('layouts.admin.include.stylesheets')

        <!-- ==========  Scoped Styles  ========== -->
        @yield('styles')

    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

        <!-- begin:: Page -->

        @yield('content')

        <!-- end:: Page -->

        <!-- ==========  Scripts  ========== -->
        @include('layouts.admin.include.scripts')

        <!-- ==========  Scoped Scripts  ========== -->
        @yield('scripts')


    </body>

    <!-- end::Body -->
</html>