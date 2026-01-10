<!doctype html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $project->getTranslation('title', 'en') }} - Gaza Roots</title>

  <!-- Favicon (optional) -->
  <link rel="icon" type="image/png" href="{{ asset('website/assets/img/favicon.png') }}" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('website/assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('website/assets/css/owl.carousel.min.css') }}" />

  <!-- Your reset bootstrap -->
  <link rel="stylesheet" href="{{ asset('website/assets/css/reset.css') }}" />
  <!-- Your main style -->
  <link rel="stylesheet" href="{{ asset('website/assets/css/style.css') }}" />
</head>

<body>
  <x-website.navbar />
  <!-- Page content -->
  <main class="">

    <section class="categories_section">
      <div class="container">
        <div class="row">

          <div class="col-lg-7">

            <article class="gr-post">
              <!-- Title -->
              <h1 class="gr-post__title">
                {{ $project->getTranslation('title', 'en') }}
              </h1>

              <!-- Cover -->
              <div class="gr-post__cover">
                <img src="{{ $project->image ? asset('storage/' . $project->image) : asset('website/assets/img/single-post-cover.svg') }}" alt="{{ $project->getTranslation('title', 'en') }}">
              </div>

              <!-- Location -->
              @if($project->location)
              <div class="gr-post__meta">
                <span class="gr-post__meta-item">
                  <span class="gr-post__meta-icon gr-post__meta-icon--date"></span>
                  {{ $project->location }}
                </span>
              </div>
              @endif

              <!-- Content -->
              <div class="gr-post__content">
                {!! $project->getTranslation('description', 'en') !!}
              </div>

              <!-- Project Stats -->
              <div class="gr-stats" style="margin: 2rem 0;">
                @if($project->wells_built)
                <div class="gr-stats__item">
                  <div class="gr-stats__num">{{ number_format($project->wells_built) }}</div>
                  <div class="gr-stats__label">Wells Built</div>
                </div>
                @endif

                @if($project->beneficiaries)
                <div class="gr-stats__item">
                  <div class="gr-stats__num">{{ number_format($project->beneficiaries) }}</div>
                  <div class="gr-stats__label">Beneficiaries</div>
                </div>
                @endif

                @if($project->families_served)
                <div class="gr-stats__item">
                  <div class="gr-stats__num">{{ number_format($project->families_served) }}</div>
                  <div class="gr-stats__label">Families Served</div>
                </div>
                @endif

                @if($project->neighborhoods)
                <div class="gr-stats__item">
                  <div class="gr-stats__num">{{ number_format($project->neighborhoods) }}</div>
                  <div class="gr-stats__label">Neighborhoods</div>
                </div>
                @endif
              </div>

              <!-- Share -->
              {{-- <div class="gr-post__share">
                <span class="gr-post__share-label">Share via</span>

                <div class="gr-post__share-icons">
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" aria-label="Facebook" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/facebook.svg') }}" alt="Facebook">
                  </a>
                  <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->getTranslation('title', 'en')) }}" target="_blank" aria-label="X" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/twitter.svg') }}" alt="X">
                  </a>
                  <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->getTranslation('title', 'en')) }}" target="_blank" aria-label="Telegram" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/telegram.svg') }}" alt="Telegram">
                  </a>
                  <a href="https://wa.me/?text={{ urlencode($project->getTranslation('title', 'en') . ' ' . request()->url()) }}" target="_blank" aria-label="WhatsApp" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/whatsapp.svg') }}" alt="WhatsApp">
                  </a>
                  <a href="#" onclick="navigator.clipboard.writeText('{{ request()->url() }}'); alert('Link copied!'); return false;" aria-label="Copy link" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/link.svg') }}" alt="Copy Link">
                  </a>
                </div>
              </div> --}}

              <!-- Donate box -->
              <section class="gr-post-highlight">
                <h3 class="gr-post-highlight__title">Support Our Water Projects</h3>
                <p class="gr-post-highlight__text">
                  Your donation helps provide clean water to families in Gaza. Every contribution makes a difference in someone's life.
                </p>
                <a href="#" class="btn gr-post-highlight__btn">Donate Now</a>
              </section>
            </article>

          </div>


          <div class="col-lg-5">
            <div class="gr-selections">
              <div class="gr-title">
                <h2>Other Water Projects</h2>
              </div>

              @forelse($otherProjects as $other)
              <div class="gr-blog gr-blog__inline">
                <a href="{{ route('water-project.show', $other->slug) }}" class="gr-blog__img">
                  <img src="{{ $other->image ? asset('storage/' . $other->image) : asset('website/assets/img/inline_post1.svg') }}" alt="{{ $other->getTranslation('title', 'en') }}">
                </a>
                <div class="gr-blog__text">
                  <a href="{{ route('water-project.show', $other->slug) }}" class="h3">{{ Str::limit($other->getTranslation('title', 'en'), 60) }}</a>
                  <p>{{ Str::limit($other->getTranslation('description', 'en'), 80) }}</p>
                </div>
              </div>
              @empty
              <p class="text-muted">No other projects available</p>
              @endforelse

              {{-- <div class="mt-4">
                <a href="{{ route('water.index') }}" class="btn btn-outline-primary text-black ">View All Projects</a>
              </div> --}}
            </div>
          </div>


        </div>
      </div>
    </section>

  </main>



    <footer class="gr-footer">
    <div class="container">
      <div class="gr-footer__box">
        <!-- Logo -->
        <a href="#" class="gr-footer__logo">
          <img src="{{ asset('website/assets/img/footer-logo.svg') }}" alt="Gaza Roots" />
        </a>

        <!-- Title -->
        <h3 class="gr-footer__title">Gaza Roots News</h3>

        <!-- Links -->
        <ul class="gr-footer__nav">
          <li><a href="#" class="active">CONTRIBUTORS</a></li>
          <li><a href="#">ARTS</a></li>
          <li><a href="#">SOLIDARITY</a></li>
          <li><a href="#assistModal">REQUEST HELP</a></li>
          <li><a href="#">ABOUT US</a></li>
        </ul>

        <!-- Social -->
        <p class="gr-footer__social-title">Follow us on Social Media</p>

        <div class="gr-footer__social">
          @forelse($socialMedia as $social)
            <a href="{{ $social->url }}" class="gr-footer__social-link" aria-label="{{ $social->platform }}" target="_blank" rel="noopener noreferrer">
              <img src="{{ $social->image_url }}" alt="{{ $social->platform }}">
              <img src="{{ $social->hover_image_url }}" alt="">
            </a>
          @empty
            <!-- Fallback to default social media links if none configured -->
            <a href="#" class="gr-footer__social-link" aria-label="Instagram">
              <img src="{{ asset('website/assets/img/social/instagram.svg') }}" alt="">
              <img src="{{ asset('website/assets/img/social/instagram-hover.svg') }}" alt="">
            </a>
          @endforelse
        </div>

        <!-- Divider -->
        <div class="gr-footer__divider"></div>

        <!-- Copyright -->
        <p class="gr-footer__copy">Copyright © 2025. Gaza Roots News</p>
      </div>
    </div>
  </footer>

  <!-- jQuery -->
  <script src="{{ asset('website/assets/js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('website/assets/js/jquery.marquee.js') }}" type="text/javascript"></script>
  <!-- Bootstrap JS (Bundle includes Popper) -->
  <script src="{{ asset('website/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('website/assets/js/owl.carousel.min.js') }}"></script>

  <!-- Your main script -->
  <script src="{{ asset('website/assets/js/main.js') }}"></script>
</body>

</html>
