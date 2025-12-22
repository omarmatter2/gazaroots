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
                <span>Welcome back,</span>
                <span class="text-primary font-semibold">{{ auth()->user()->name }}</span>
                <span class="text-muted-foreground">|</span>
                <span>{{ now()->format('l, F d, Y') }}</span>
            </div>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.articles.create') }}" class="kt-btn kt-btn-sm kt-btn-primary">
                <i class="ki-filled ki-plus-squared"></i>
                New Article
            </a>
        </div>
    </div>

    <!-- Main Stats Cards - Square Style -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 mb-7.5">
        <!-- Total Articles -->
        <div class="kt-card group hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="kt-card-content p-5 flex flex-col items-center justify-center text-center min-h-[140px]">
                <div class="flex items-center justify-center size-12 rounded-xl bg-primary/10 mb-3 group-hover:scale-110 transition-transform">
                    <i class="ki-filled ki-document text-xl text-primary"></i>
                </div>
                <span class="text-2xl font-bold text-mono">{{ number_format($stats['articles'] ?? 0) }}</span>
                <span class="text-xs text-secondary-foreground mt-1">Articles</span>
            </div>
        </div>

        <!-- Categories -->
        <div class="kt-card group hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="kt-card-content p-5 flex flex-col items-center justify-center text-center min-h-[140px]">
                <div class="flex items-center justify-center size-12 rounded-xl bg-success/10 mb-3 group-hover:scale-110 transition-transform">
                    <i class="ki-filled ki-category text-xl text-success"></i>
                </div>
                <span class="text-2xl font-bold text-mono">{{ number_format($stats['categories'] ?? 0) }}</span>
                <span class="text-xs text-secondary-foreground mt-1">Categories</span>
            </div>
        </div>

        <!-- Authors -->
        <div class="kt-card group hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="kt-card-content p-5 flex flex-col items-center justify-center text-center min-h-[140px]">
                <div class="flex items-center justify-center size-12 rounded-xl bg-info/10 mb-3 group-hover:scale-110 transition-transform">
                    <i class="ki-filled ki-people text-xl text-info"></i>
                </div>
                <span class="text-2xl font-bold text-mono">{{ number_format($stats['authors'] ?? 0) }}</span>
                <span class="text-xs text-secondary-foreground mt-1">Authors</span>
            </div>
        </div>

        <!-- Subscribers -->
        <div class="kt-card group hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="kt-card-content p-5 flex flex-col items-center justify-center text-center min-h-[140px]">
                <div class="flex items-center justify-center size-12 rounded-xl bg-purple-500/10 mb-3 group-hover:scale-110 transition-transform">
                    <i class="ki-filled ki-sms text-xl text-purple-500"></i>
                </div>
                <span class="text-2xl font-bold text-mono">{{ number_format($stats['subscribers'] ?? 0) }}</span>
                <span class="text-xs text-secondary-foreground mt-1">Subscribers</span>
            </div>
        </div>

        <!-- Total Donations -->
        <div class="kt-card group hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="kt-card-content p-5 flex flex-col items-center justify-center text-center min-h-[140px]">
                <div class="flex items-center justify-center size-12 rounded-xl bg-warning/10 mb-3 group-hover:scale-110 transition-transform">
                    <i class="ki-filled ki-dollar text-xl text-warning"></i>
                </div>
                <span class="text-2xl font-bold text-mono">${{ number_format($stats['donations'] ?? 0, 0) }}</span>
                <span class="text-xs text-secondary-foreground mt-1">Donations</span>
            </div>
        </div>

        <!-- Water Projects -->
        <div class="kt-card group hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="kt-card-content p-5 flex flex-col items-center justify-center text-center min-h-[140px]">
                <div class="flex items-center justify-center size-12 rounded-xl bg-cyan-500/10 mb-3 group-hover:scale-110 transition-transform">
                    <i class="ki-filled ki-drop text-xl text-cyan-500"></i>
                </div>
                <span class="text-2xl font-bold text-mono">{{ number_format($stats['water_projects'] ?? 0) }}</span>
                <span class="text-xs text-secondary-foreground mt-1">Water Projects</span>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="kt-card group hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="kt-card-content p-5 flex flex-col items-center justify-center text-center min-h-[140px]">
                <div class="flex items-center justify-center size-12 rounded-xl bg-orange-500/10 mb-3 group-hover:scale-110 transition-transform">
                    <i class="ki-filled ki-message-text text-xl text-orange-500"></i>
                </div>
                <span class="text-2xl font-bold text-mono">{{ number_format($stats['testimonials'] ?? 0) }}</span>
                <span class="text-xs text-secondary-foreground mt-1">Testimonials</span>
            </div>
        </div>

        <!-- Help Requests -->
        <div class="kt-card group hover:shadow-lg transition-all duration-300 hover:-translate-y-1 ring-2 ring-danger/20">
            <div class="kt-card-content p-5 flex flex-col items-center justify-center text-center min-h-[140px]">
                <div class="flex items-center justify-center size-12 rounded-xl bg-danger/10 mb-3 group-hover:scale-110 transition-transform relative">
                    <i class="ki-filled ki-message-question text-xl text-danger"></i>
                    @if(($stats['assistance_requests'] ?? 0) > 0)
                    <span class="absolute -top-1 -right-1 size-4 bg-danger rounded-full flex items-center justify-center">
                        <span class="text-[10px] text-white font-bold">!</span>
                    </span>
                    @endif
                </div>
                <span class="text-2xl font-bold text-danger">{{ number_format($stats['assistance_requests'] ?? 0) }}</span>
                <span class="text-xs text-danger mt-1">Pending</span>
            </div>
        </div>
    </div>


    <!-- Content Row -->
    <div class="grid gap-5 lg:gap-7.5 lg:grid-cols-2 mb-7.5">
        <!-- Recent Articles -->
        <div class="kt-card">
            <div class="kt-card-header">
                <h3 class="kt-card-title">Recent Articles</h3>
                <a href="{{ route('admin.articles.index') }}" class="kt-btn kt-btn-sm kt-btn-ghost">View All</a>
            </div>
            <div class="kt-card-content kt-scrollable-y-auto" style="max-height: 350px;">
                <div class="kt-table-container">
                    <table class="kt-table kt-table-border">
                        <tbody class="kt-table-tbody">
                            @forelse($recentArticles ?? [] as $article)
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-lg overflow-hidden bg-muted shrink-0">
                                            @if($article->image)
                                                <img src="{{ asset('storage/' . $article->image) }}" alt="" class="size-full object-cover">
                                            @else
                                                <div class="size-full flex items-center justify-center bg-primary/10">
                                                    <i class="ki-filled ki-document text-primary"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0.5">
                                            <a href="{{ route('admin.articles.edit', $article) }}" class="text-sm font-medium text-mono hover:text-primary leading-tight line-clamp-1">
                                                {{ Str::limit($article->getTranslation('title', 'en'), 40) }}
                                            </a>
                                            <span class="text-xs text-secondary-foreground">
                                                {{ $article->category?->getTranslation('name', 'en') ?? 'No Category' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-end">
                                    <span class="kt-badge kt-badge-sm {{ $article->is_published ? 'kt-badge-success' : 'kt-badge-warning' }}">
                                        {{ $article->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-6 text-center text-secondary-foreground">
                                    <i class="ki-filled ki-document text-2xl mb-2"></i>
                                    <p>No articles yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Donations -->
        <div class="kt-card">
            <div class="kt-card-header">
                <h3 class="kt-card-title">Recent Donations</h3>
                <a href="{{ route('admin.donations.index') }}" class="kt-btn kt-btn-sm kt-btn-ghost">View All</a>
            </div>
            <div class="kt-card-content kt-scrollable-y-auto" style="max-height: 350px;">
                <div class="kt-table-container">
                    <table class="kt-table kt-table-border">
                        <tbody class="kt-table-tbody">
                            @forelse($recentDonations ?? [] as $donation)
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center size-10 rounded-full bg-success/10">
                                            <i class="ki-filled ki-dollar text-success"></i>
                                        </div>
                                        <div class="flex flex-col gap-0.5">
                                            <span class="text-sm font-medium text-mono">{{ $donation->donor_name ?? 'Anonymous' }}</span>
                                            <span class="text-xs text-secondary-foreground">{{ $donation->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-end">
                                    <span class="text-sm font-semibold text-success">${{ number_format($donation->amount, 2) }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-6 text-center text-secondary-foreground">
                                    <i class="ki-filled ki-dollar text-2xl mb-2"></i>
                                    <p>No donations yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Requests -->
    <div class="kt-card">
        <div class="kt-card-header">
            <h3 class="kt-card-title">Recent Help Requests</h3>
            <a href="{{ route('admin.assistance-requests.index') }}" class="kt-btn kt-btn-sm kt-btn-ghost">View All</a>
        </div>
        <div class="kt-card-content">
            <div class="kt-table-container">
                <table class="kt-table kt-table-border">
                    <thead class="kt-table-thead">
                        <tr>
                            <th class="min-w-[200px]">Name</th>
                            <th class="min-w-[150px]">Type</th>
                            <th class="min-w-[120px]">Status</th>
                            <th class="min-w-[120px]">Date</th>
                            <th class="w-[60px]"></th>
                        </tr>
                    </thead>
                    <tbody class="kt-table-tbody">
                        @forelse($recentRequests ?? [] as $request)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center size-9 rounded-full bg-primary/10">
                                        <span class="text-xs font-semibold text-primary">{{ strtoupper(substr($request->name, 0, 2)) }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-mono">{{ $request->name }}</span>
                                        <span class="text-xs text-secondary-foreground">{{ Str::limit($request->email, 25) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-sm">{{ ucfirst(str_replace('_', ' ', $request->assistance_type ?? 'General')) }}</span>
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'new' => 'kt-badge-primary',
                                        'pending' => 'kt-badge-warning',
                                        'in_progress' => 'kt-badge-info',
                                        'completed' => 'kt-badge-success',
                                        'rejected' => 'kt-badge-danger',
                                    ];
                                @endphp
                                <span class="kt-badge kt-badge-sm {{ $statusColors[$request->status] ?? 'kt-badge-primary' }}">
                                    {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-sm text-secondary-foreground">{{ $request->created_at->format('M d, Y') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.assistance-requests.show', $request) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                    <i class="ki-filled ki-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-secondary-foreground">
                                <i class="ki-filled ki-message-question text-3xl mb-2"></i>
                                <p>No help requests yet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
