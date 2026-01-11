    <!doctype html>
    <html lang="en" dir="ltr">

@includeIf('website.layouts.partials.head')
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
            <div class="gr-blog gr-blog__inline">
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

    <div class="news-ticker">
      <div class="news-marquee">
        @foreach($urgentArticles as $urgent)
        <a href="{{ route('article.show', $urgent->slug) }}">{{ $urgent->getTranslation('title', 'en') }}</a>
        @if(!$loop->last)<span> • </span>@endif
        @endforeach
      </div>
    </div>

    <section class="categories_section">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">

            <div class="gr-urgent">
              <div class="gr-title">
                <h2>Most Urgent</h2>
                <!-- <a href="#">View Details</a> -->
              </div>

              <ul class="gr-urgent__list">
                @foreach($urgentArticles as $index => $urgent)
                <li class="gr-urgent__item {{ $index == 0 ? 'active' : '' }}">
                  <span class="gr-urgent__index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                  <span class="gr-urgent__line"></span>
                  <a href="{{ route('article.show', $urgent->slug) }}" class="gr-urgent__text">
                    {{ Str::limit($urgent->getTranslation('title', 'en'), 60) }}
                  </a>
                </li>
                @endforeach
              </ul>
            </div>


          </div>

          <div class="col-lg-8">

            <section class="gr-category">
              <div class="gr-category__grid">
                @foreach($categories as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="gr-category__item">
                  <h3 class="gr-category__title">{{ $category->getTranslation('name', 'en') }}</h3>
                  <div class="gr-category__box">
                    <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('website/assets/img/category_img.svg') }}" alt="">

                  </div>
                </a>
                @endforeach
              </div>
            </section>




          </div>
        </div>
      </div>
    </section>


    <section class="single-category_section">
      <div class="container">

        <div class="gr-title">
          <h2>Water Projects</h2>
          <a href="{{ route('water.index') }}">View All</a>
        </div>


        <div class="row">
          <div class="col-lg-8">
            @if($waterProjects->count() > 0)
            @php $mainProject = $waterProjects->first(); @endphp
            <div class="gr-blog gr-blog__secondary">
              <a href="{{ route('water-project.show', $mainProject->slug) }}" class="gr-blog__img gr-blog__opacity">
                <img src="{{ $mainProject->image ? asset('storage/' . $mainProject->image) : asset('website/assets/img/sec_post.svg') }}" alt="">
              </a>
              <div class="gr-blog__text">
                <a href="{{ route('water-project.show', $mainProject->slug) }}" class="h3">{{ $mainProject->getTranslation('title', 'en') }}</a>

                <p>{{ Str::limit($mainProject->getTranslation('description', 'en'), 120) }}</p>
              </div>


            </div>
            @endif
          </div>

          <div class="col-lg-4">
            <div class="gr-title">
              <h2>The latest water wells that have been drilled</h2>
            </div>
            @foreach($waterProjects->skip(1)->take(3) as $project)
            <div class="gr-blog gr-blog__inline">
              <a href="{{ route('water-project.show', $project->slug) }}" class="gr-blog__img">
                <img src="{{ $project->image ? asset('storage/' . $project->image) : asset('website/assets/img/inline_post1.svg') }}" alt="">
              </a>
              <div class="gr-blog__text">
                <a href="{{ route('water-project.show', $project->slug) }}" class="h3">{{ $project->getTranslation('title', 'en') }}</a>
              </div>
            </div>
            @endforeach

          </div>
        </div>

        <div class="gr-stats">
          <div class="gr-stats__item">
            <div class="gr-stats__num">{{ number_format($waterStats['wells_built']) }}</div>
            <div class="gr-stats__label">wells built</div>
          </div>

          <div class="gr-stats__item">
            <div class="gr-stats__num">{{ number_format($waterStats['beneficiaries']) }}</div>
            <div class="gr-stats__label">beneficiaries</div>
          </div>

          <div class="gr-stats__item">
            <div class="gr-stats__num">{{ number_format($waterStats['families_served']) }}</div>
            <div class="gr-stats__label">families served daily</div>
          </div>

          <div class="gr-stats__item">
            <div class="gr-stats__num">{{ number_format($waterStats['neighborhoods']) }}</div>
            <div class="gr-stats__label">neighborhoods covered</div>
          </div>
        </div>


      </div>
    </section>



    <section class="slides_section">
      <div class="container">
        <div class="gr-title">
          <h2>Testimonies</h2>
          <a href="#">View Details</a>
        </div>


        <div class="owl-carousel">
          @foreach($testimonials as $testimonial)
          <div>
            <div class="gr-blog gr-blog__slide">
              <a href="#" class="gr-blog__img">
                <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('website/assets/img/main_post.svg') }}" alt="">
              </a>
              <div class="gr-blog__text">
                <a href="#" class="h2">{{ $testimonial->getTranslation('name', 'en') }}</a>
                <a href="#" class="h3">{{ Str::limit($testimonial->getTranslation('content', 'en'), 100) }}</a>
              </div>
            </div>
          </div>
          @endforeach

        </div>


      </div>
    </section>



    <x-website.subscribe-form />



  </main>

  @includeIf('website.layouts.partials.footer')
  <!-- jQuery -->
  <script src="{{asset('website/assets/js/jquery-3.7.1.min.js')}}"></script>
  <!-- <script src="assets/js/jquery.pause.js" type="text/javascript"></script>
    <script src="assets/js/jquery.easing.min.js" type="text/javascript"></script> -->
  <script src="{{asset('website/assets/js/jquery.marquee.js')}}" type="text/javascript"></script>
  <!-- Bootstrap JS (Bundle includes Popper) -->
  <script src="{{asset('website/assets/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('website/assets/js/owl.carousel.min.js')}}"></script>

  <!-- Your main script -->
  <script src="{{asset('website/assets/js/main.js')}}"></script>
</body>

</html>
