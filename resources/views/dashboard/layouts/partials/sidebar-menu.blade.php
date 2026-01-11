<!-- Sidebar Menu -->
<div class="kt-menu flex flex-col grow gap-1" data-kt-menu="true" data-kt-menu-accordion-expand-all="false" id="sidebar_menu">
    <!-- Dashboard -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.dashboard') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.dashboard') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-element-11 text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Dashboard
            </span>
        </a>
    </div>

    <!-- Content Management -->
    <div class="kt-menu-item pt-2.25 pb-px">
        <span class="kt-menu-heading uppercase text-xs font-medium text-muted-foreground ps-[10px] pe-[10px]">
            Content
        </span>
    </div>

    <!-- Categories -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.categories.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.categories.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-category text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Categories
            </span>
        </a>
    </div>

    <!-- Articles -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.articles.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.articles.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-document text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Articles
            </span>
        </a>
    </div>

    <!-- Authors -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.authors.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.authors.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-people text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Authors
            </span>
        </a>
    </div>

    <!-- Donations -->
    <div class="kt-menu-item pt-2.25 pb-px">
        <span class="kt-menu-heading uppercase text-xs font-medium text-muted-foreground ps-[10px] pe-[10px]">
            Donations
        </span>
    </div>

    <!-- Water Projects -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.water-projects.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.water-projects.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-drop text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Water Projects
            </span>
        </a>
    </div>

    <!-- Donations List -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.donations.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.donations.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-dollar text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Donations
            </span>
        </a>
    </div>

    <!-- Requests & Support -->
    <div class="kt-menu-item pt-2.25 pb-px">
        <span class="kt-menu-heading uppercase text-xs font-medium text-muted-foreground ps-[10px] pe-[10px]">
            Support
        </span>
    </div>

    <!-- Assistance Requests -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.assistance-requests.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.assistance-requests.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-message-question text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Assistance Requests
            </span>
            @php $newRequestsCount = \App\Models\AssistanceRequest::new()->count(); @endphp
            @if($newRequestsCount > 0)
                <span class="kt-badge kt-badge-sm kt-badge-danger">{{ $newRequestsCount }}</span>
            @endif
        </a>
    </div>

    <!-- Testimonials -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.testimonials.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.testimonials.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-message-text text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Testimonials
            </span>
        </a>
    </div>

    <!-- Subscribers -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.subscribers.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.subscribers.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-sms text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Subscribers
            </span>
        </a>
    </div>

    <!-- Newsletters -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.newsletters.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.newsletters.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-send text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Newsletters
            </span>
        </a>
    </div>

    <!-- Settings -->
    <div class="kt-menu-item pt-2.25 pb-px">
        <span class="kt-menu-heading uppercase text-xs font-medium text-muted-foreground ps-[10px] pe-[10px]">
            Settings
        </span>
    </div>

    <!-- Navigation Items -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.nav-items.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.nav-items.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-menu text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Navigation
            </span>
        </a>
    </div>

    <!-- Social Media -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.social-media.*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.social-media.index') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-share text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                Social Media
            </span>
        </a>
    </div>

    <!-- About Us Page -->
    <div class="kt-menu-item">
        <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px] {{ request()->routeIs('admin.pages.about-us*') ? 'kt-menu-item-active bg-accent/60 rounded-lg' : '' }}" href="{{ route('admin.pages.about-us') }}" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
                <i class="ki-filled ki-information text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                About Us Page
            </span>
        </a>
    </div>
</div>

