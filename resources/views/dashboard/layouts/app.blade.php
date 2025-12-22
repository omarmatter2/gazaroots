<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
<head>
    <base href="{{ asset('') }}">
    <title>@yield('title', 'Dashboard') - Gaza Roots Admin</title>
    @includeIf('dashboard.layouts.head')
</head>
<body class="antialiased flex h-full text-base text-foreground bg-background demo1 kt-sidebar-fixed kt-header-fixed">
    <!-- Theme Mode -->
    <script>
        const defaultThemeMode = 'light';
        let themeMode;
        if (document.documentElement) {
            if (localStorage.getItem('kt-theme')) {
                themeMode = localStorage.getItem('kt-theme');
            } else if (document.documentElement.hasAttribute('data-kt-theme-mode')) {
                themeMode = document.documentElement.getAttribute('data-kt-theme-mode');
            } else {
                themeMode = defaultThemeMode;
            }
            if (themeMode === 'system') {
                themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            document.documentElement.classList.add(themeMode);
        }
    </script>

    <!-- Page -->
    <div class="flex grow">
        <!-- Sidebar -->
        @includeIf('dashboard.layouts.sidebar')

        <!-- Wrapper -->
        <div class="kt-wrapper flex grow flex-col">
            <!-- Header -->
            @includeIf('dashboard.layouts.header')

            <!-- Content -->
            <main class="grow pt-5" id="content" role="content">
                @yield('content')
            </main>

            <!-- Footer -->
            @includeIf('dashboard.layouts.footer')
        </div>
    </div>

    <!-- Scripts -->
    @includeIf('dashboard.layouts.script')
    @stack('scripts')
</body>
</html>

