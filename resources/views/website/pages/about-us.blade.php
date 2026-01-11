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
          <div class="col-lg-8 offset-lg-2">
            <article class="gr-post">
              <!-- Title -->
              <h1 class="gr-post__title">
                {{ $page->getTranslation('title', app()->getLocale()) }}
              </h1>

              <!-- Content -->
              <div class="gr-post__content">
                {!! $page->getTranslation('content', app()->getLocale()) !!}
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>
  </main>

  @includeIf('website.layouts.partials.footer')
  @includeIf('website.layouts.partials.scripts')
</body>

</html>
