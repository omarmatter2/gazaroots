<header>
    <nav class="navbar navbar-expand-lg navbar-dark gr-navbar">
        <div class="container gr-navbar__container">
            <!-- Brand -->
            <a class="navbar-brand gr-navbar__brand" href="{{ route('home') }}">
                <img src="{{ asset('website/assets/img/favicon.png') }}" alt="Gaza Roots" />
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler gr-navbar__toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links + Right actions -->
            <div class="collapse navbar-collapse gr-navbar__collapse" id="navbarSupportedContent">
                <!-- Center nav -->
                <ul class="navbar-nav mx-auto gr-navbar__nav">
                    @foreach($menuItems as $item)
                        @if($item->type === 'dropdown' && $item->children->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $item->getTranslation('title', 'en') }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($item->children as $child)
                                        <li>
                                            <a class="dropdown-item" href="{{ $child->getLink() }}" target="{{ $child->target }}">
                                                {{ $child->getTranslation('title', 'en') }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->url() === $item->getLink() ? 'active' : '' }}"
                                   href="{{ $item->getLink() }}"
                                   target="{{ $item->target }}"
                                   @if(request()->url() === $item->getLink()) aria-current="page" @endif>
                                    {{ $item->getTranslation('title', 'en') }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>

                <!-- Right actions -->
                <div class="gr-navbar__actions">
                    @foreach($buttonItems as $button)
                        @if(str_starts_with($button->url ?? '', '#'))
                            {{-- Modal trigger button --}}
                            <button type="button" class="btn gr-btn {{ $button->css_class }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="{{ $button->url }}">
                                {{ $button->getTranslation('title', 'en') }}
                            </button>
                        @else
                            <a class="btn gr-btn {{ $button->css_class }}" href="{{ $button->getLink() }}" target="{{ $button->target }}">
                                {{ $button->getTranslation('title', 'en') }}
                            </a>
                        @endif
                    @endforeach

                    <div class="gr-navbar__meta">
                        <span class="gr-navbar__time">{{ now()->format('H:i') }}</span>
                        <span class="gr-navbar__weather">24°C</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
