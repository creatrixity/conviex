        </section>
        <!-- End main -->

        <section class="footer">
          <div class="container">
            <section class="row u-mb-lg">
              <div class="col-sm-4 u-mb-md">
                <h3 class="h4 u-mb-md">Fashlogue</h3>

                <p id="explore">Find designers, their collections and draw inspiration from their works. </p>

              </div>

              <div class="col-sm-5 u-mb-sm">
                <h3 class="h4 u-mb-md">Explore</h3>

                <ul class="nav">
                  @if(Auth::guest())
                  <li class="hidden visible-xs visible-sm"><a href="{{ route('login') }}">Login</a></li>
                  @else
                  <li class="hidden visible-xs visible-sm"><a href="{{ route('logout') }}">Logout</a></li>
                  @endif
                  <li><a href="{{ route('about') }}">What's this?</a></li>
                  <li><a href="{{ route('designers') }}">Designers</a></li>
                  <li><a href="{{ route('contact') }}">Say hi</a></li>
                  <li><a href="{{ route('testimonials') }}">Testimonials</a></li>

                  <li class="hidden visible-xs visible-sm">
                    <form method="get" action="{{ url('/search') }}" class="fcds-search-bar fcds-search-bar--xs">
          						<input type="search" name="q" required="" value="" id="footer-search" placeholder="Search" class="fcds-search-bar__input" />
          						<label for="footer-search" class="fcds-search-bar__controls">
          							<section class="icon-group text-center" style="display: block; width: 100%; height: 100%; background: transparent;">

          								<svg class="icon icon--search icon--outlined icon--md u-mr-xs"><use xlink:href="#icon-search"></use></svg>
          								<span class="icon-label">Search Fashlogue</span>

          							</section>

          						</label>
          					</form> <!-- Ends .fcds-search-bar -->

                  </li>

                </ul>

              </div>

              <div class="col-sm-3">
                <h3 class="h4 u-mb-md">Follow us</h3>

                <ul class="nav">
                  <li><a href="{{ config('app.social.facebook') }}">Facebook</a></li>
                  <li><a href="{{ config('app.social.instagram') }}">Instagram</a></li>
                  <li><a href="{{ config('app.social.twitter') }}">Twitter</a></li>
                </ul>

              </div>

            </section>

            <section class="row u-mb-md">
              <div class="col-md-4">
                <p class="small u-mb-sm">&copy; {{ config('app.name') }} 2017. All rights reserved. </p>

                <ul class="list list-inline list-unstyled">
                  <li><a href="{{ route('privacy') }}">Privacy</a></li>
                  <li><a href="{{ route('terms') }}">Terms</a></li>
                </ul>

              </div>

              <div class="col-md-5">
                <a href="{{ url(route('catalogue.create')) }}" class="btn btn-default">Start your collection</a>

              </div>

              <div class="col-md-3 hidden">
                30 collections and counting..
              </div>

            </section>
          </div>
        </section> <!-- /.footer -->
    </div>
    <!-- End wrapper -->
</body>
</html>
