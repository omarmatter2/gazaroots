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
                {{ $article->getTranslation('title', 'en') }}
              </h1>

              <!-- Cover -->
              <div class="gr-post__cover">
                <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('website/assets/img/single-post-cover.svg') }}" alt="{{ $article->getTranslation('title', 'en') }}">
              </div>

              <!-- Caption -->
              <p class="gr-post__caption">
                {{ $article->getTranslation('excerpt', 'en') }}
              </p>

              <!-- Meta -->
              <div class="gr-post__meta">
                <span class="gr-post__meta-item">
                  <span class="gr-post__meta-icon gr-post__meta-icon--date"></span>
                  {{ $article->published_at ? $article->published_at->format('d M, Y') : $article->created_at->format('d M, Y') }}
                </span>

                <span class="gr-post__meta-item">
                  <span class="gr-post__meta-icon gr-post__meta-icon--author"></span>
                  {{ $article->author ? $article->author->getTranslation('name', 'en') : 'Unknown' }}
                </span>
              </div>

              <!-- Content -->
              <div class="gr-post__content">
                {!! $article->getTranslation('content', 'en') !!}
              </div>


              <!-- Share -->
              {{-- <div class="gr-post__share">
                <span class="gr-post__share-label">Share via</span>

                <div class="gr-post__share-icons">
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" aria-label="Facebook" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/facebook.svg') }}" alt="Facebook">
                  </a>
                  <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->getTranslation('title', 'en')) }}" target="_blank" aria-label="X" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/twitter.svg') }}" alt="X">
                  </a>
                  <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->getTranslation('title', 'en')) }}" target="_blank" aria-label="Telegram" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/telegram.svg') }}" alt="Telegram">
                  </a>
                  <a href="https://wa.me/?text={{ urlencode($article->getTranslation('title', 'en') . ' ' . request()->url()) }}" target="_blank" aria-label="WhatsApp" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/whatsapp.svg') }}" alt="WhatsApp">
                  </a>
                  <a href="#" onclick="navigator.clipboard.writeText('{{ request()->url() }}'); alert('Link copied!'); return false;" aria-label="Copy link" class="gr-post__share-btn">
                    <img src="{{ asset('website/assets/img/icons/link.svg') }}" alt="Copy Link">
                  </a>
                </div>
              </div> --}}

              <!-- Highlight box -->
              <section class="gr-post-highlight">
                <h3 class="gr-post-highlight__title">Gaza.. Strength Born from Endless Trials</h3>
                <p class="gr-post-highlight__text">
                  Gaza stands as a living reminder that even when the world feels heavy, the human spirit can rise above
                  it.
                  Through loss, pressure, and uncertainty, its people continue to move forward with a bravery that
                  inspires.
                </p>
                <a href="#" class="btn gr-post-highlight__btn">Donate Now</a>
              </section>
            </article>

          </div>


          <div class="col-lg-5">


            <div class="gr-urgent gr-urgent__bg">
              <div class="gr-title">
                <h2>Most Urgent</h2>
              </div>

              <ul class="gr-urgent__list">
                @forelse($urgentArticles as $index => $urgent)
                <li class="gr-urgent__item {{ $index == 0 ? 'active' : '' }}">
                  <span class="gr-urgent__index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                  <span class="gr-urgent__line"></span>
                  <a href="{{ route('article.show', $urgent->slug) }}" class="gr-urgent__text">
                    {{ Str::limit($urgent->getTranslation('title', 'en'), 60) }}
                  </a>
                </li>
                @empty
                <li class="gr-urgent__item">
                  <span class="gr-urgent__text">No urgent articles available</span>
                </li>
                @endforelse
              </ul>
            </div>

            <div class="gr-selections">
              <div class="gr-title">
                <h2>Related Articles</h2>
              </div>

              @forelse($relatedArticles as $related)
              <div class="gr-blog gr-blog__inline">
                <a href="{{ route('article.show', $related->slug) }}" class="gr-blog__img">
                  <img src="{{ $related->image ? asset('storage/' . $related->image) : asset('website/assets/img/inline_post1.svg') }}" alt="{{ $related->getTranslation('title', 'en') }}">
                </a>
                <div class="gr-blog__text">
                  <a href="#" class="h2">{{ $related->category ? $related->category->getTranslation('name', 'en') : 'Uncategorized' }}</a>
                  <a href="{{ route('article.show', $related->slug) }}" class="h3">{{ Str::limit($related->getTranslation('title', 'en'), 60) }}</a>
                  <p>{{ Str::limit($related->getTranslation('excerpt', 'en'), 80) }}</p>
                </div>
              </div>
              @empty
              <p class="text-muted">No related articles available</p>
              @endforelse

            </div>
          </div>


        </div>
      </div>
    </section>


    <section class="slides_section" style="background-color: #FAFAFA;">
      <div class="container">
        <div class="gr-title">
          <h2>Testimonies</h2>
          <a href="#">View Details</a>
        </div>


        <div class="owl-carousel">
          @forelse($testimonials as $testimonial)
          <div>
            <div class="gr-blog gr-blog__slide">
              <a href="#" class="gr-blog__img">
                <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('website/assets/img/main_post.svg') }}" alt="{{ $testimonial->getTranslation('name', 'en') }}">
              </a>
              <div class="gr-blog__text">
                <a href="#" class="h2">{{ $testimonial->getTranslation('name', 'en') }}</a>
                <a href="#" class="h3">{{ Str::limit($testimonial->getTranslation('content', 'en'), 100) }}</a>
              </div>
            </div>
          </div>
          @empty
          <div>
            <div class="gr-blog gr-blog__slide">
              <div class="gr-blog__text">
                <p>No testimonials available</p>
              </div>
            </div>
          </div>
          @endforelse
        </div>


      </div>
    </section>


    <x-website.subscribe-form />



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
