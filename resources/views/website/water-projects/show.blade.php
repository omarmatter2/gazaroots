<!doctype html>
<html lang="en" dir="ltr">

@includeIf('website.layouts.partials.head')


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


@includeIf('website.layouts.partials.footer')


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
