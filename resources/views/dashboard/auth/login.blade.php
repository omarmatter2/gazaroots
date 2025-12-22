<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
<head>
    <base href="{{ asset('') }}">
    <title>Login - Gaza Roots Admin</title>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"/>
</head>
<body class="antialiased flex h-full text-base text-foreground bg-background">
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

    <style>
        .page-bg {
            background-image: url('{{ asset('assets/media/images/2600x1200/bg-10.png') }}');
        }
        .dark .page-bg {
            background-image: url('{{ asset('assets/media/images/2600x1200/bg-10-dark.png') }}');
        }
    </style>

    <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
        <div class="kt-card max-w-[400px] w-full">
            <form action="{{ route('admin.login.submit') }}" class="kt-card-content flex flex-col gap-5 p-10" method="POST">
                @csrf
                <div class="text-center mb-2.5">
                    <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                        Gaza Roots Admin
                    </h3>
                    <p class="text-sm text-secondary-foreground">
                        Sign in to access the dashboard
                    </p>
                </div>

                @if ($errors->any())
                    <div class="kt-alert kt-alert-danger">
                        <div class="kt-alert-icon">
                            <i class="ki-filled ki-cross-circle"></i>
                        </div>
                        <div class="kt-alert-content">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex flex-col gap-1">
                    <label class="kt-form-label font-normal text-mono" for="email">
                        Email
                    </label>
                    <input class="kt-input @error('email') border-red-500 @enderror" 
                           id="email"
                           name="email" 
                           type="email" 
                           value="{{ old('email') }}"
                           placeholder="admin@gazaroots.com" 
                           required 
                           autofocus/>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="kt-form-label font-normal text-mono" for="password">
                        Password
                    </label>
                    <div class="kt-input" data-kt-toggle-password="true">
                        <input id="password"
                               name="password" 
                               placeholder="Enter Password" 
                               type="password" 
                               required/>
                        <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5" 
                                data-kt-toggle-password-trigger="true" 
                                type="button">
                            <span class="kt-toggle-password-active:hidden">
                                <i class="ki-filled ki-eye text-muted-foreground"></i>
                            </span>
                            <span class="hidden kt-toggle-password-active:block">
                                <i class="ki-filled ki-eye-slash text-muted-foreground"></i>
                            </span>
                        </button>
                    </div>
                </div>

                <label class="kt-label">
                    <input class="kt-checkbox kt-checkbox-sm" name="remember" type="checkbox" value="1"/>
                    <span class="kt-checkbox-label">Remember me</span>
                </label>

                <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">
                    Sign In
                </button>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/core.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendors/ktui/ktui.min.js') }}"></script>
</body>
</html>

