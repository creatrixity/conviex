<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('view-title', 'Fashlogue')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ec6c68">
    <meta name="theme-color" content="#ffffff">


    <!-- App CSS -->
    <link rel="stylesheet" href="{{ elixir('/css/charm.css') }}">

    <style media="screen">

        .form-control + .form-hint
        {
          display: none;
        }

        .form-control:focus + .form-hint
        {
          display: block;
        }

        .form-group--is-invalid .form-control + .form-hint
        {
          display: block;
        }

    </style>

    @yield('view-styles')
</head>

<body class="theme-default" id="top">
    @include('shared.svg-defs')

    <div class="wrapper">
        <section class="main fcds-main clearfix">
          <div class="fcds-navbar fcds-navbar--default">
    				<section class="container fcds-navbar__container">

    					<section class="fcds-navbar__section hidden-md hidden-lg">

    						<a href="#explore" class="fcds-navbar__link fcds-navbar__link--trigger">
    							<span class="icon icon--hamburger u-mr-xs">
    								<span class="hamburger"></span>
    							</span>

    							<span class="icon-label">Menu</span>

    						</a>

    					</section> <!-- End .fcds-navbar__section -->


    					<section class="fcds-navbar__brand fcds-navbar__brand--center-bmd">

    						<a href="{{ url('/#top') }}" class="fcds-navbar__brand-link">
    							<svg class="icon fcds-navbar__brand-icon u-mr-xs" style="width: 2.5em; height: 2.5em;"><use xlink:href="#icon-Fashlog-Logo"></use></svg>

    							<span class="fcds-navbar__brand-wordmark hidden-xs">Fashlogue</span>
    						</a>

                <li class="fcds-navbar__dropdown hidden-xs hidden-sm u-ml-sm">

  								<a href="javascript: void(0);" class="fcds-navbar__link">
  									<span class="icon icon--ellipses">
  										<span class="ellipses"></span>
  									</span>

  								</a><!-- /.fcds-navbar__peeker -->

  								<ul class="fcds-navbar__dropdown-menu">
  									<li class="fcds-navbar__dropdown-item">
  										<a href="{{ route('about') }}" class="fcds-navbar__dropdown-link">
  											What's this?
  										</a>
  									</li>
  									<li class="fcds-navbar__dropdown-item">
  										<a href="{{ route('designers') }}" class="fcds-navbar__dropdown-link">
  											Designers
  										</a>
  									</li>
  									<li class="fcds-navbar__dropdown-item">
  										<a href="{{ route('contact') }}" class="fcds-navbar__dropdown-link">
  											Say hi
  										</a>
  									</li>
  									<li class="fcds-navbar__dropdown-item">
  										<a href="{{ route('testimonials') }}" class="fcds-navbar__dropdown-link">
  											Testimonials
  										</a>
  									</li>
  								</ul>


  							</li>

    					</section> <!-- End .fcds-navbar__brand -->


    					<form method="get" action="{{ url('/search') }}" class="fcds-search-bar fcds-search-bar--xs hidden-sm hidden-xs">
    						<input type="search" name="q" required="" value="" id="search" placeholder="Search" class="fcds-search-bar__input" />
    						<label for="search" class="fcds-search-bar__controls">
    							<section class="icon-group text-center" style="display: block; width: 100%; height: 100%; background: transparent;">

    								<svg class="icon icon--search icon--outlined icon--md u-mr-xs"><use xlink:href="#icon-search"></use></svg>
    								<span class="icon-label">Search</span>

    							</section>

    						</label>
    					</form> <!-- Ends .fcds-search-bar -->

    					<section class="fcds-navbar__section">

                @if (!Auth::user())

    						<ul class="fcds-navbar__nav">

    							<li class="fcds-navbar__item">
    								<a href="{{ url('/register') }}" class="fcds-navbar__button btn btn-primary">Sign up</a>
    							</li>

    							<li class="fcds-navbar__item hidden-xs hidden-sm">
    								<a href="{{ url('/login') }}" class="fcds-navbar__link">Login</a>
    							</li>

    						</ul> <!-- End .fcds-navbar__nav -->

                @else

                <li class="fcds-navbar__item">
                  <a href="{{ url('/entry') }}" class="fcds-navbar__button btn btn-primary"> Add entry</a>
                </li>

                <li class="fcds-navbar__dropdown fcds-navbar__dropdown--right">
                  <a href="{{ url('/'. Auth::user()->username) }}" class="fcds-navbar__link hidden-xs">
                    <img src="{{ Auth::user()->getUserAvatar('mini') }}" class="avatar avatar--small img-circle u-mr-xs" alt="" />

                    {{ Auth::user()->getFirstName() }}
                    <b class="caret"></b>
                  </a>

                  <ul class="fcds-navbar__dropdown-menu">

  									<li class="fcds-navbar__dropdown-item">
  										<a href="{{ url(Auth::user()->username) }}" class="fcds-navbar__dropdown-link">
  											Your profile
  										</a>
  									</li>

  									<li class="fcds-navbar__dropdown-item">
  										<a href="{{ url('/accounts/edit') }}" class="fcds-navbar__dropdown-link">
  											Edit account
  										</a>
  									</li>
                    <hr style="margin: 0;">

  									<li class="fcds-navbar__dropdown-item">
  										<a href="{{ url('logout') }}" class="fcds-navbar__dropdown-link">
  											Logout
  										</a>
  									</li>

                  </ul>

                </li>

                @endif
    					</section>

    				</section>
    			</div>

    @if(session()->has('appStatus'))
    <section class="container u-mt-md">
      <div class="row">
        <section class="col-md-6 col-md-offset-3">

          <div class="alert alert-{{ json_decode(session('appStatus'))->type }}">
            <p class="text-center">{!! json_decode(session('appStatus'))->message !!}</p>
          </div>

        </section>
      </div>
    </section>
    @endif

    @if(session()->has('message'))
    <section class="container u-mt-md">
      <div class="row">
        <section class="col-md-6 col-md-offset-3">

          <div class="alert alert-info">
            <p class="text-center">{!! session('message') !!}</p>
          </div>

        </section>
      </div>
    </section>
    @endif
