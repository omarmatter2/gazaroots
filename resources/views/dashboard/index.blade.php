@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fixed p-5">
    <!-- Page Header -->
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">
                Dashboard
            </h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                Welcome back, {{ auth()->user()->name }}!
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid gap-5 lg:gap-7.5 lg:grid-cols-4 mb-7.5">
        <!-- Articles -->
        <div class="kt-card">
            <div class="kt-card-content p-5 lg:p-7.5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm font-medium text-secondary-foreground">Articles</span>
                        <h3 class="text-2xl font-semibold text-mono mt-1">{{ $stats['articles'] ?? 0 }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-primary/10">
                        <i class="ki-filled ki-document text-xl text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="kt-card">
            <div class="kt-card-content p-5 lg:p-7.5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm font-medium text-secondary-foreground">Categories</span>
                        <h3 class="text-2xl font-semibold text-mono mt-1">{{ $stats['categories'] ?? 0 }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-success/10">
                        <i class="ki-filled ki-category text-xl text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Authors -->
        <div class="kt-card">
            <div class="kt-card-content p-5 lg:p-7.5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm font-medium text-secondary-foreground">Authors</span>
                        <h3 class="text-2xl font-semibold text-mono mt-1">{{ $stats['authors'] ?? 0 }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-info/10">
                        <i class="ki-filled ki-people text-xl text-info"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donations -->
        <div class="kt-card">
            <div class="kt-card-content p-5 lg:p-7.5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm font-medium text-secondary-foreground">Total Donations</span>
                        <h3 class="text-2xl font-semibold text-mono mt-1">${{ number_format($stats['donations'] ?? 0, 2) }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-warning/10">
                        <i class="ki-filled ki-dollar text-xl text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="grid gap-5 lg:gap-7.5 lg:grid-cols-4 mb-7.5">
        <!-- Subscribers -->
        <div class="kt-card">
            <div class="kt-card-content p-5 lg:p-7.5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm font-medium text-secondary-foreground">Subscribers</span>
                        <h3 class="text-2xl font-semibold text-mono mt-1">{{ $stats['subscribers'] ?? 0 }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-purple-500/10">
                        <i class="ki-filled ki-sms text-xl text-purple-500"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assistance Requests -->
        <div class="kt-card">
            <div class="kt-card-content p-5 lg:p-7.5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm font-medium text-secondary-foreground">New Requests</span>
                        <h3 class="text-2xl font-semibold text-mono mt-1">{{ $stats['assistance_requests'] ?? 0 }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-danger/10">
                        <i class="ki-filled ki-message-question text-xl text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Water Projects -->
        <div class="kt-card">
            <div class="kt-card-content p-5 lg:p-7.5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm font-medium text-secondary-foreground">Water Projects</span>
                        <h3 class="text-2xl font-semibold text-mono mt-1">{{ $stats['water_projects'] ?? 0 }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-cyan-500/10">
                        <i class="ki-filled ki-drop text-xl text-cyan-500"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="kt-card">
            <div class="kt-card-content p-5 lg:p-7.5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm font-medium text-secondary-foreground">Testimonials</span>
                        <h3 class="text-2xl font-semibold text-mono mt-1">{{ $stats['testimonials'] ?? 0 }}</h3>
                    </div>
                    <div class="flex items-center justify-center size-12 rounded-lg bg-orange-500/10">
                        <i class="ki-filled ki-message-text text-xl text-orange-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
