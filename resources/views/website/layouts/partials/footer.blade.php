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
          <li><a href="{{ route('about-us') }}">ABOUT US</a></li>
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
        <p class="gr-footer__copy">Copyright ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            . Gaza Roots News</p>
      </div>
    </div>
  </footer>
