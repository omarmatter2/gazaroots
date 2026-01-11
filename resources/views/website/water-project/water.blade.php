<!doctype html>
<html lang="en" dir="ltr">

@includeIf('website.layouts.partials.head')


<body>
  <x-website.navbar />
  <!-- Page content -->
  <main class="">

    <section class="categories_section water">
      <div class="container">
        <div class="row">

          <div class="col-lg-7">

            <article class="gr-post">
              <!-- Title -->
              <h1 class="gr-post__title">
                Water
              </h1>

              <!-- Cover -->
              <div class="gr-post__cover">
                <img src="{{ asset('website/assets/img/single-post-cover.svg') }}" alt="Water Projects">
              </div>

              <div class="gr-title">
                <h2>Water Well Projects in Gaza</h2>
              </div>

              <!-- Content -->
              <div class="gr-post__content">
                <p>
                  Several humanitarian organizations continue to play a vital role in Gaza by implementing essential
                  projects that support the resilience of local communities. Among the most impactful initiatives are
                  water well projects, which provide a critical lifeline in areas suffering from severe shortages of
                  clean and accessible water.
                </p>

                <p>
                  These organizations identify neighborhoods with the greatest need, then construct deep wells equipped
                  with modern pumping systems, storage tanks, and small distribution networks that supply families with
                  safe water for drinking, cooking, and daily use.
                  Such efforts do more than provide water—they restore dignity, reduce daily hardship, and improve
                  public health, especially for women and children who are most affected by water scarcity.
                </p>

                <p>Thanks to these projects, thousands of individuals gain reliable access to clean, safe water,
                  contributing significantly to better living conditions and strengthened community resilience.
                </p>
              </div>

            </article>


            <div class="gr-stats">
              <div class="gr-stats__item">
                <div class="gr-stats__num">{{ number_format($stats['wells_built']) }}</div>
                <div class="gr-stats__label">wells built</div>
              </div>

              <div class="gr-stats__item">
                <div class="gr-stats__num">{{ number_format($stats['beneficiaries']) }}</div>
                <div class="gr-stats__label">beneficiaries</div>
              </div>

              <div class="gr-stats__item">
                <div class="gr-stats__num">{{ number_format($stats['families_served']) }}</div>
                <div class="gr-stats__label">families served daily</div>
              </div>

              <div class="gr-stats__item">
                <div class="gr-stats__num">{{ number_format($stats['neighborhoods']) }}</div>
                <div class="gr-stats__label">neighborhoods covered</div>
              </div>
            </div>


            <div class="gr-title">
              <h2>Latest News</h2>
            </div>

            @forelse($articles as $article)
            <div class="gr-blog gr-blog__inline gr-blog__inline--lg">
              <a href="{{ route('article.show', $article->slug) }}" class="gr-blog__img">
                <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('website/assets/img/inline_post1.svg') }}" alt="{{ $article->getTranslation('title', 'en') }}">
              </a>
              <div class="gr-blog__text">
                <a href="{{ route('category.show', $article->category->slug) }}" class="h2">{{ $article->category->getTranslation('name', 'en') }}</a>
                <a href="{{ route('article.show', $article->slug) }}" class="h3">{{ $article->getTranslation('title', 'en') }}</a>
                <p>{{ Str::limit($article->getTranslation('excerpt', 'en'), 100) }}</p>
              </div>
            </div>
            @empty
            <p class="text-muted">No articles available.</p>
            @endforelse

          </div>


          <div class="col-lg-5">

            <div class="gr-donation-box">

              <div class="gr-donation-header">
                @if($donationProject)
                <h3 class="gr-donation-title">
                  <span>{{ $donationProject->getTranslation('title', 'en') }}</span>
                </h3>

                <p class="gr-donation-desc">
                  {{ $donationProject->getTranslation('description', 'en') ?: 'Your donation, in any amount, can help build a well in Gaza' }}
                </p>
                @else
                <h3 class="gr-donation-title">
                  <span>"Help us bring clean water to Gaza."</span>
                </h3>

                <p class="gr-donation-desc">
                  Your donation, in any amount, can help build a well in Gaza
                </p>
                @endif
              </div>

              <!-- Amounts -->
              <div class="gr-donation-amounts">

                <label class="gr-donation-option">
                  <input type="radio" name="donation_amount" value="5">
                  <span>5$</span>
                </label>

                <label class="gr-donation-option">
                  <input type="radio" name="donation_amount" value="10">
                  <span>10$</span>
                </label>

                <label class="gr-donation-option active">
                  <input type="radio" name="donation_amount" value="20" checked>
                  <span>20$</span>
                </label>

                <label class="gr-donation-option">
                  <input type="radio" name="donation_amount" value="25">
                  <span>25$</span>
                </label>

                <label class="gr-donation-option">
                  <input type="radio" name="donation_amount" value="30">
                  <span>30$</span>
                </label>

                <label class="gr-donation-option">
                  <input type="radio" name="donation_amount" value="35">
                  <span>35$</span>
                </label>

                <label class="gr-donation-option">
                  <input type="radio" name="donation_amount" value="40">
                  <span>40$</span>
                </label>

                <label class="gr-donation-option">
                  <input type="radio" name="donation_amount" value="50">
                  <span>50$</span>
                </label>

                <!-- Custom amount -->
                <label class="gr-donation-option gr-donation-option--custom">
                  <input type="radio" name="donation_amount" value="custom">
                  <span>+50$</span>
                </label>

              </div>

              <!-- Custom input -->
              <div class="gr-donation-custom">
                <input type="number" placeholder="Enter amount" min="1">
              </div>

              <!-- Donation type -->
              <div class="gr-donation-type">
                <p>Please choose your donation type.</p>

                <label class="gr-radio">
                  <input type="radio" name="donation_type" checked>
                  <span class="gr-radio__circle"></span>
                  <span class="gr-radio__label">One-Time Donation</span>
                </label>

                <label class="gr-radio">
                  <input type="radio" name="donation_type">
                  <span class="gr-radio__circle"></span>
                  <span class="gr-radio__label">Monthly Donation</span>
                </label>
              </div>

              <button class="gr-donation-btn">
                Confirm & Continue
              </button>

            </div>



          </div>


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
