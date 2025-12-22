<!doctype html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $category->getTranslation('name', 'en') }} - Gaza Roots</title>

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
    <section class="hero_section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            @if($featuredArticles->count() > 0)
            @php $mainArticle = $featuredArticles->first(); @endphp
            <div class="gr-blog gr-blog__main">
              <a href="{{ route('article.show', $mainArticle->slug) }}" class="gr-blog__img gr-blog__opacity">
                <img src="{{ $mainArticle->image ? asset('storage/' . $mainArticle->image) : asset('website/assets/img/main_post.svg') }}" alt="">
              </a>
              <div class="gr-blog__text">
                <a href="{{ route('category.show', $mainArticle->category->slug) }}" class="h2">{{ $mainArticle->category->getTranslation('name', 'en') }}</a>
                <a href="{{ route('article.show', $mainArticle->slug) }}" class="h3">{{ $mainArticle->getTranslation('title', 'en') }}</a>
              </div>
            </div>
            @endif
          </div>

          <div class="col-lg-5">
            @if($featuredArticles->count() > 1)
            @php $secondArticle = $featuredArticles->skip(1)->first(); @endphp
            <div class="gr-blog gr-blog__secondary">
              <a href="{{ route('article.show', $secondArticle->slug) }}" class="gr-blog__img gr-blog__opacity">
                <img src="{{ $secondArticle->image ? asset('storage/' . $secondArticle->image) : asset('website/assets/img/sec_post.svg') }}" alt="">
              </a>
              <div class="gr-blog__text">
                <a href="{{ route('category.show', $secondArticle->category->slug) }}" class="h2">{{ $secondArticle->category->getTranslation('name', 'en') }}</a>
                <a href="{{ route('article.show', $secondArticle->slug) }}" class="h3">{{ $secondArticle->getTranslation('title', 'en') }}</a>
              </div>
            </div>
            @endif

            @foreach($featuredArticles->skip(2)->take(2) as $article)
            <div class="gr-blog gr-blog__inline">
              <a href="{{ route('article.show', $article->slug) }}" class="gr-blog__img">
                <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('website/assets/img/inline_post1.svg') }}" alt="">
              </a>
              <div class="gr-blog__text">
                <a href="{{ route('category.show', $article->category->slug) }}" class="h2">{{ $article->category->getTranslation('name', 'en') }}</a>
                <a href="{{ route('article.show', $article->slug) }}" class="h3">{{ $article->getTranslation('title', 'en') }}</a>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
    </section>



    <section class="categories_section">
      <div class="container">
        <div class="row">

          <div class="col-lg-7">

            <div class="gr-title">
              <h2>Latest News in {{ $category->getTranslation('name', 'en') }}</h2>
            </div>

            @forelse($articles as $article)
            <div class="gr-blog gr-blog__inline gr-blog__inline--lg">
              <a href="{{ route('article.show', $article->slug) }}" class="gr-blog__img">
                <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('website/assets/img/inline_post1.svg') }}" alt="{{ $article->getTranslation('title', 'en') }}">
              </a>
              <div class="gr-blog__text">
                <a href="{{ route('category.show', $category->slug) }}" class="h2">{{ $category->getTranslation('name', 'en') }}</a>
                <a href="{{ route('article.show', $article->slug) }}" class="h3">{{ $article->getTranslation('title', 'en') }}</a>
                <p>{{ Str::limit($article->getTranslation('excerpt', 'en'), 100) }}</p>
              </div>
            </div>
            @empty
            <div class="text-center py-5">
              <p>No articles found in this category.</p>
            </div>
            @endforelse

            @if($articles->hasPages())
            <div class="d-flex justify-content-center mt-4">
              {{ $articles->links() }}
            </div>
            @endif

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
                <h2>Selections</h2>
              </div>

              @forelse($selectionArticles as $selection)
              <div class="gr-blog gr-blog__inline">
                <a href="{{ route('article.show', $selection->slug) }}" class="gr-blog__img">
                  <img src="{{ $selection->image ? asset('storage/' . $selection->image) : asset('website/assets/img/inline_post1.svg') }}" alt="{{ $selection->getTranslation('title', 'en') }}">
                </a>
                <div class="gr-blog__text">
                  <a href="{{ route('category.show', $selection->category->slug) }}" class="h2">{{ $selection->category->getTranslation('name', 'en') }}</a>
                  <a href="{{ route('article.show', $selection->slug) }}" class="h3">{{ Str::limit($selection->getTranslation('title', 'en'), 50) }}</a>
                  <p>{{ Str::limit($selection->getTranslation('excerpt', 'en'), 80) }}</p>
                </div>
              </div>
              @empty
              <p class="text-muted">No selections available</p>
              @endforelse

            </div>
          </div>


        </div>
      </div>
    </section>





    <section class="gr-subscribe">
      <div class="container">
        <div class="gr-subscribe__box">
          <h2 class="gr-subscribe__title">
            Subscribe to Gaza Roots News
          </h2>

          <p class="gr-subscribe__desc">
            Enter your email to receive the latest updates and breaking news from Gaza
          </p>

          <form class="gr-subscribe__form" action="{{ route('subscribe') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Enter your email" class="gr-subscribe__input" required />

            <button type="submit" class="gr-subscribe__btn">
            </button>
          </form>
        </div>
      </div>
    </section>

  </main>
  <footer class="gr-footer">
    <div class="container">
      <div class="gr-footer__box">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="gr-footer__logo">
          <img src="{{ asset('website/assets/img/footer-logo.svg') }}" alt="Gaza Roots" />
        </a>

        <!-- Title -->
        <h3 class="gr-footer__title">Gaza Roots News</h3>

        <!-- Links -->
        <ul class="gr-footer__nav">
          <li><a href="#" class="active">CONTRIBUTORS</a></li>
          <li><a href="#">ARTS</a></li>
          <li><a href="#">SOLIDARITY</a></li>
          <li><a href="#">REQUEST HELP</a></li>
          <li><a href="#">ABOUT US</a></li>
        </ul>

        <!-- Social -->
        <p class="gr-footer__social-title">Follow us on Social Media</p>

        <div class="gr-footer__social">
          <a href="#" class="gr-footer__social-link" aria-label="Instagram">
            <img src="{{ asset('website/assets/img/social/instagram.svg') }}" alt="">
            <img src="{{ asset('website/assets/img/social/instagram-hover.svg') }}" alt="">
          </a>

          <a href="#" class="gr-footer__social-link" aria-label="TikTok">
            <img src="{{ asset('website/assets/img/social/tiktok.svg') }}" alt="">
            <img src="{{ asset('website/assets/img/social/tiktok-hover.svg') }}" alt="">
          </a>

          <a href="#" class="gr-footer__social-link" aria-label="X">
            <img src="{{ asset('website/assets/img/social/twitter.svg') }}" alt="">
            <img src="{{ asset('website/assets/img/social/twitter-hover.svg') }}" alt="">
          </a>

          <a href="#" class="gr-footer__social-link" aria-label="Telegram">
            <img src="{{ asset('website/assets/img/social/telegram.svg') }}" alt="">
            <img src="{{ asset('website/assets/img/social/telegram-hover.svg') }}" alt="">
          </a>

          <a href="#" class="gr-footer__social-link" aria-label="Snapchat">
            <img src="{{ asset('website/assets/img/social/snapchat.svg') }}" alt="">
            <img src="{{ asset('website/assets/img/social/snapchat-hover.svg') }}" alt="">
          </a>
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
