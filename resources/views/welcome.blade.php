<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Title -->
    <title>Afyapepe.com</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../favicon.ico">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">

    <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}" />
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('vendor/icon-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/icon-line/css/simple-line-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/hamburgers/hamburgers.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/dzsparallaxer/dzsparallaxer.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/dzsparallaxer/dzsscroller/scroller.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/dzsparallaxer/advancedscroller/plugin.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fancybox/jquery.fancybox.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/cubeportfolio-full/cubeportfolio/css/cubeportfolio.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/slick-carousel/slick/slick.css') }}" />

<!-- CSS Unify -->
<link rel="stylesheet" href="{{ asset('assets/css/unify.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/styles.op-app.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
  </head>

  <body>
    <main>
      <!-- Header v1 -->
      <header id="js-header" class="u-header u-header--sticky-top u-header--show-hide u-header--toggle-section"
              data-header-fix-moment="100"
              data-header-fix-effect="slide">
        <div class="u-header__section u-shadow-v27 g-bg-white g-transition-0_3 g-py-12 g-py-20--md">
          <nav class="navbar navbar-toggleable-md py-0 g-px-15">
            <div class="container">
              <!-- Logo -->
              <a href="#" class="navbar-brand u-header__logo">
                <img class="u-header__logo-img u-header__logo-img--main g-width-130" src="assets/img/logo.png1" alt="Afya Pepe">
              </a>
              <!-- End Logo -->

              <div id="navBar" class="collapse navbar-collapse">
                <!-- Navigation -->
                <div class="navbar-collapse align-items-center flex-sm-row">
                  <ul id="js-scroll-nav" class="navbar-nav g-flex-right--xs text-uppercase w-100 g-font-weight-700 g-font-size-11 g-pt-20 g-pt-0--lg">
                    <li class="nav-item g-mr-15--lg g-mb-7 g-mb-0--lg">
                      <a href="#home" class="nav-link p-0">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                      <a href="#about" class="nav-link p-0">About</a>
                    </li>
                    <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                      <a href="#benefits" class="nav-link p-0">Benefits</a>
                    </li>
                    <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                      <a href="#whyWe" class="nav-link p-0">Why we</a>
                    </li>
                    <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                      <a href="#features" class="nav-link p-0">Health Centers</a>
                    </li>
                    <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                      <a href="#howItWorks" class="nav-link p-0">Laboratories</a>
                    </li>
                    <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                      <a href="#subscribe" class="nav-link p-0">Pharmacy</a>
                    </li>
                    <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                      <a href="#FAQ" class="nav-link p-0">Manufacturers</a>
                    </li>
                    <li class="nav-item g-ml-15--lg g-mb-7 g-mb-0--lg">
                      <a href="#contact" class="nav-link p-0">Contact</a>
                    </li>
                    @if (Auth::guest())
                         <li class="nav-item g-ml-15--lg g-mb-7 g-mb-0--lg"><a href="{{ url('/login') }}">Login</a></li>
                         <li class="nav-item g-ml-15--lg g-mb-7 g-mb-0--lg"><a href="{{ url('/register') }}">Register</a></li>
                    @else
                          <li class="nav-item g-ml-15--lg g-mb-7 g-mb-0--lg"><a href="#">{{ Auth::user()->name }}</a></li>
                          <li class="nav-item g-ml-15--lg g-mb-7 g-mb-0--lg"><a href="{{ url('/logout') }}">Logout</a></li>
                        </ul>
                     @endif
                  </ul>
                </div>
                <!-- End Navigation -->

              </div>

              <!-- Responsive Toggle Button -->
              <button class="navbar-toggler btn g-line-height-1 g-brd-none g-pa-0 g-mt-12 ml-auto" type="button"
                      aria-label="Toggle navigation"
                      aria-expanded="false"
                      aria-controls="navBar"
                      data-toggle="collapse"
                      data-target="#navBar">
                <span class="hamburger hamburger--slider">
                  <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                  </span>
                </span>
              </button>
              <!-- End Responsive Toggle Button -->
            </div>
          </nav>
        </div>
      </header>
      <!-- End Header v1 -->

      <!-- Section Content -->
      <section id="home" class="g-theme-bg-gray-light-v1 g-pt-90">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-5 offset-lg-1 d-flex text-center text-md-left">
              <div class="align-self-center">
                <h2 class="text-uppercase g-line-height-1_3 g-font-size-36 g-mb-20 g-mb-30--lg"><strong>Afya Pepe</strong></h2>
                  <h3>Organizing Health Information</h3>
                <p class="g-mb-20 g-mb-35--lg">Organizes health information in kenya by bringing patients, doctors, pharmacies and facilities on one platform
           Afya Pepe Patient Centered with patients using their mobile phones to start a visit with a doctor
           Open platform - available to all facilities for free
                   </p>
                <a href="#" class="btn btn-md u-btn-primary g-font-weight-700 g-letter-spacing-0_5 text-uppercase text-left g-rounded-10 g-py-10 g-mb-15 g-mb-0--lg g-mr-30--md">
                  <span class="pull-right g-font-size-13">
                    Download App
                    <span class="d-block g-font-size-10">From App Store</span>
                  </span>
                  <i class="fa fa-apple float-left g-font-size-26 g-mr-15"></i>
                </a>
                <a href="#" class="btn btn-md u-btn-purple g-font-weight-700 g-letter-spacing-0_5 text-uppercase text-left g-rounded-10 g-py-10 g-mb-15 g-mb-0--lg">
                  <span class="pull-right g-font-size-13">
                    Download App
                    <span class="d-block g-font-size-10">From Play Market</span>
                  </span>
                  <i class="fa fa-android float-left g-font-size-26 g-mr-15"></i>
                </a>
              </div>
            </div>

            <div class="col-md-6 col-lg-6 g-overflow-hidden">
              <img class="img-fluid" src="assets/img-temp/mockups/mockup1.png" alt="Image description"
                   data-animation="slideInUp">
            </div>
          </div>
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="about" class="g-pt-90">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 d-flex g-mb-30 g-mb-0--lg">
              <div class="align-self-center">
                <div class="text-uppercase g-line-height-1_3 g-mb-20">
                  <h4 class="g-font-weight-700 g-font-size-11 g-mb-15">
                    <span class="g-color-primary"></span>About Afyapepe</h4>
                  <h2 class="g-line-height-1_3 g-font-size-36 mb-0">Only <strong>just try</strong></h2>
                </div>

                <p class="g-mb-65">
                Afya Pepe is a health information platform that connects patients, doctors,
                facilities, laboratories and pharmacies.  At the ecosystem level,
                Afya Pepe provides the data to measure and assess the quality of
                healthcare, identify stakeholder pain points, and monitor outcomes of
                interventions
              </p>

                <div id="whyOurAppAccordion" class="u-accordion" role="tablist" aria-multiselectable="true">
                  <!-- Card -->
                  <div class="card rounded-0 g-bg-primary g-color-white g-brd-none">
                    <div id="awesomeFeatures" class="u-accordion__header g-pa-20" role="tab">
                      <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                        <a class="g-color-white g-text-underline--none--hover" href="#awesomeFeaturesBody"
                           data-toggle="collapse"
                           data-parent="#whyOurAppAccordion"
                           aria-expanded="true"
                           aria-controls="awesomeFeaturesBody">
                        <span class="u-accordion__control-icon g-mr-10">
                          <i class="fa fa-plus"></i>
                          <i class="fa fa-minus"></i>
                        </span>
                          Awesome features
                        </a>
                      </h5>
                    </div>

                    <div id="awesomeFeaturesBody" class="collapse show" role="tabpanel" aria-labelledby="awesomeFeatures">
                      <div class="u-accordion__body g-font-size-default g-pa-0-20-20">
                        Afya Pepe organizes health information in a way that gives stakeholders
                        visibility on their processes. Data captured with Afya Pepe also enables
                        policy and decision makers to identify and address bottlenecks within the
                        healthcare ecosystem, as well as to track the effectiveness of their
                        actions.
                      </div>
                    </div>
                  </div>
                  <!-- End Card -->

                  <!-- Card -->
                  <div class="card rounded-0 g-bg-primary-dark-v2 g-color-white g-brd-none">
                    <div id="modernAndCreativeDesign" class="u-accordion__header g-pa-20" role="tab">
                      <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                        <a class="collapsed g-color-white g-text-underline--none--hover" aria-expanded="false" aria-controls="modernAndCreativeDesignBody"
                           href="#modernAndCreativeDesignBody"
                           data-toggle="collapse"
                           data-parent="#whyOurAppAccordion">
                        <span class="u-accordion__control-icon g-mr-10">
                          <i class="fa fa-plus"></i>
                          <i class="fa fa-minus"></i>
                        </span>
                          Modern and creative design
                        </a>
                      </h5>
                    </div>

                    <div id="modernAndCreativeDesignBody" class="collapse" role="tabpanel" aria-labelledby="modernAndCreativeDesign">
                      <div class="u-accordion__body g-font-size-default g-pa-0-20-20">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                    </div>
                  </div>
                  <!-- End Card -->

                  <!-- Card -->
                  <div class="card rounded-0 g-bg-primary g-color-white g-brd-none">
                    <div id="regularUpdates" class="u-accordion__header g-pa-20" role="tab">
                      <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                        <a class="collapsed g-color-white g-text-underline--none--hover" href="#regularUpdatesBody" aria-expanded="false" aria-controls="regularUpdatesBody"
                           data-toggle="collapse"
                           data-parent="#whyOurAppAccordion">
                        <span class="u-accordion__control-icon g-mr-10">
                          <i class="fa fa-plus"></i>
                          <i class="fa fa-minus"></i>
                        </span>
                          Regular updates
                        </a>
                      </h5>
                    </div>

                    <div id="regularUpdatesBody" class="collapse" role="tabpanel" aria-labelledby="regularUpdates">
                      <div class="u-accordion__body g-font-size-default g-pa-0-20-20">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                    </div>
                  </div>
                  <!-- End Card -->

                  <!-- Card -->
                  <div class="card rounded-0 g-bg-primary-dark-v2 g-color-white g-brd-none">
                    <div id="professionalSupport24x7" class="u-accordion__header g-pa-20" role="tab">
                      <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                        <a class="collapsed g-color-white g-text-underline--none--hover" href="#professionalSupport24x7Body" aria-expanded="false" aria-controls="professionalSupport24x7Body"
                           data-toggle="collapse"
                           data-parent="#whyOurAppAccordion">
                          <span class="u-accordion__control-icon g-mr-10">
                            <i class="fa fa-plus"></i>
                            <i class="fa fa-minus"></i>
                          </span>
                          Powered by Priority Mobile Limited  (24/7 professional support)
                        </a>
                      </h5>
                    </div>

                    <div id="professionalSupport24x7Body" class="collapse" role="tabpanel" aria-labelledby="professionalSupport24x7">
                      <div class="u-accordion__body g-font-size-default g-pa-0-20-20">
                        Priority Mobile Limited is a Technology Company that develops breakthrough
                         mobile solutions for Africa. Founded in 2013, we are a team of software
                         developers passionate about helping clients achieve better results with higher
                        quality, timely data on their operations.
                       </div>
                    </div>
                  </div>
                  <!-- End Card -->
                </div>
              </div>
            </div>

            <div class="col-lg-5 text-center g-overflow-hidden">
              <img class="img-fluid" src="assets/img-temp/mockups/mockup3.png" alt="Image description"
                   data-animation="slideInUp">
            </div>
          </div>
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="benefits" class="g-py-90">
        <div class="container text-center g-max-width-750 g-mb-65">
          <div class="text-uppercase g-line-height-1_3 g-mb-20">
            <h4 class="g-font-weight-700 g-font-size-11 g-mb-15"><span class="g-color-primary"></span> Benefits of Using Afyapepe
            </h4>
          </div>
</div>

        <div class="container">
          <!-- Row -->
          <div class="row">
            <div class="col-md-6 col-lg-4 g-mb-30">
              <div class="text-center g-bg-gray-light-v5 g-py-40 g-px-30"
                   data-animation="fadeIn"
                   data-animation-duration="1500">
                <span class="u-icon-v1 g-font-size-36 g-color-primary g-mb-30"><i class="fa fa-search"></i></span>
                <h4 class="text-uppercase g-font-weight-700 g-font-size-11 g-color-black g-mb-20">Confidentiality
                </h4>
                <p class="g-font-size-default mb-0">Fusce mauris eros, ullamcorper in gravida a, feugiat in mauris.
                   Curabitur ac scelerisque nisi. Vivamus accumsan in purus et egestas.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 g-mb-30">
              <div class="text-center g-bg-gray-light-v5 g-py-40 g-px-30"
                   data-animation="fadeIn"
                   data-animation-delay="300"
                   data-animation-duration="1500">
                <span class="u-icon-v1 g-font-size-36 g-color-primary g-mb-30"><i class="fa fa-sliders"></i></span>
                <h4 class="text-uppercase g-font-weight-700 g-font-size-11 g-color-black g-mb-20">Many different filters for<br> easy music search
                </h4>
                <p class="g-font-size-default mb-0">Fusce mauris eros, ullamcorper in gravida a, feugiat in mauris. Curabitur ac scelerisque nisi. Vivamus accumsan in purus et egestas.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 g-mb-30">
              <div class="text-center g-bg-gray-light-v5 g-py-40 g-px-30"
                   data-animation="fadeIn"
                   data-animation-delay="500"
                   data-animation-duration="1500">
                <span class="u-icon-v1 g-font-size-36 g-color-primary g-mb-30"><i class="fa fa-cloud"></i></span>
                <h4 class="text-uppercase g-font-weight-700 g-font-size-11 g-color-black g-mb-20">All your music on our<br> cloud hosting
                </h4>
                <p class="g-font-size-default mb-0">Fusce mauris eros, ullamcorper in gravida a, feugiat in mauris. Curabitur ac scelerisque nisi. Vivamus accumsan in purus et egestas.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 g-mb-30 g-mb-0--lg">
              <div class="text-center g-bg-gray-light-v5 g-py-40 g-px-30"
                   data-animation="fadeIn"
                   data-animation-delay="600"
                   data-animation-duration="1500">
                <span class="u-icon-v1 g-font-size-36 g-color-primary g-mb-30"><i class="fa fa-mobile"></i></span>
                <h4 class="text-uppercase g-font-weight-700 g-font-size-11 g-color-black g-mb-20">Offline playlist on your<br> phone
                </h4>
                <p class="g-font-size-default mb-0">Fusce mauris eros, ullamcorper in gravida a, feugiat in mauris. Curabitur ac scelerisque nisi. Vivamus accumsan in purus et egestas.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 g-mb-30 g-mb-0--md">
              <div class="text-center g-bg-gray-light-v5 g-py-40 g-px-30"
                   data-animation="fadeIn"
                   data-animation-delay="800"
                   data-animation-duration="1500">
                <span class="u-icon-v1 g-font-size-36 g-color-primary g-mb-30"><i class="fa fa-user"></i></span>
                <h4 class="text-uppercase g-font-weight-700 g-font-size-11 g-color-black g-mb-20">Share your mucis and<br> playlists with friends
                </h4>
                <p class="g-font-size-default mb-0">Fusce mauris eros, ullamcorper in gravida a, feugiat in mauris. Curabitur ac scelerisque nisi. Vivamus accumsan in purus et egestas.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="text-center g-bg-gray-light-v5 g-py-40 g-px-30"
                   data-animation="fadeIn"
                   data-animation-delay="1000"
                   data-animation-duration="1500">
                <span class="u-icon-v1 g-font-size-36 g-color-primary g-mb-30"><i class="fa fa-lock"></i></span>
                <h4 class="text-uppercase g-font-weight-700 g-font-size-11 g-color-black g-mb-20">high level of protection of<br> your personal data
                </h4>
                <p class="g-font-size-default mb-0">Fusce mauris eros, ullamcorper in gravida a, feugiat in mauris. Curabitur ac scelerisque nisi. Vivamus accumsan in purus et egestas.</p>
              </div>
            </div>
          </div>
          <!-- End Row -->
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="whyWe" class="dzsparallaxer auto-init height-is-based-on-content use-loading"
               data-options='{direction: "reverse", settings_mode_oneelement_max_offset: "150"}'>
        <!-- Parallax Image -->
        <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-black-opacity-0_5--after" style="height: 140%; background-image: url(assets/img-temp/1400x700/img1.jpg)"></div>
        <!-- End Parallax Image -->

        <div class="text-center d-flex g-height-100vh">
          <div class="container align-self-center g-max-width-750">
            <div class="text-uppercase g-line-height-1_3 g-mb-20">
              <h4 class="g-font-weight-700 g-font-size-11 g-color-white g-mb-15">
                <span class="g-color-primary">03.</span> Presentation</h4>
              <h2 class="g-line-height-1_3 g-font-size-36 g-color-white mb-0">Watch <strong>our presentation</strong></h2>
            </div>

            <p class="g-color-gray-dark-v5 g-mb-65">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas ac nulla vehicula risus pulvinar feugiat ullamcorper sit amet mi. Nam placerat efficitur dui, quis mattis magna.</p>

            <a class="js-fancybox-media btn u-btn-primary g-pos-rel g-width-70 g-height-70 g-rounded-50" href="//vimeo.com/58363288"
               data-open-effect="fadeIn"
               data-close-effect="fadeOut"
               data-open-speed="1000"
               data-close-speed="1000">
              <i class="fa fa-play center-it"></i>
            </a>
          </div>
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="whatsNew" class="g-py-90">
        <div class="container text-center g-max-width-750 g-mb-45">
          <div class="text-uppercase g-line-height-1_3 g-mb-20">
            <h4 class="g-font-weight-700 g-font-size-11 g-mb-15"><span class="g-color-primary">04.</span> What's new
            </h4>
            <h2 class="g-line-height-1_3 g-font-size-36 mb-0">We're always <strong>In trend</strong></h2>
          </div>
        </div>

        <div class="container">
          <!-- Carousel -->
          <div id="carouselCus1" class="js-carousel g-pb-20"
               data-infinite="true"
               data-slides-show="3"
               data-slides-scroll="3"
               data-pagi-classes="text-center u-carousel-indicators-v1 g-absolute-centered--x g-bottom-0 g-width-auto">
            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img1.jpg"
                 data-title="Custom Title 1"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img1.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img2.jpg"
                 data-title="Custom Title 2"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img2.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img3.jpg"
                 data-title="Custom Title 3"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img3.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img4.jpg"
                 data-title="Custom Title 4"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img4.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img5.jpg"
                 data-title="Custom Title 5"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img5.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img6.jpg"
                 data-title="Custom Title 6"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img6.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img7.jpg"
                 data-title="Custom Title 7"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img7.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img8.jpg"
                 data-title="Custom Title 8"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img8.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img9.jpg"
                 data-title="Custom Title 9"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img9.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img10.jpg"
                 data-title="Custom Title 10"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img10.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img11.jpg"
                 data-title="Custom Title 11"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img11.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="js-slide text-center g-px-15">
              <a class="cbp-lightbox d-inline-block g-pos-rel g-parent" href="assets/img-temp/270x481/img12.jpg"
                 data-title="Custom Title 12"
                 data-cbp-lightbox="whatsNewCarousel">
                <img src="assets/img-temp/270x481/img12.jpg" alt="Image description">

                <div class="cbp-caption-activeWrap g-pos-abs g-top-0 g-left-0 w-100 h-100 opacity-0 g-opacity-1--parent-hover g-bg-primary-opacity-0_6 g-transition-0_2 g-transition--ease-in">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <!-- End Carousel -->
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="features" class="g-theme-bg-gray-light-v1 g-py-90">
        <div class="container">
          <div class="row">
            <div class="col-md-5 text-center g-overflow-hidden g-mb-50 g-mb-0--md">
              <img class="img-fluid" src="assets/img-temp/mockups/mockup2.png" alt="Image description"
                   data-animation="slideInLeft">
            </div>

            <div class="col-md-7 d-flex text-center text-md-left">
              <div class="align-self-center">
                <div class="text-uppercase g-mb-20">
                  <h4 class="g-font-weight-700 g-font-size-11 g-mb-15">
                    <span class="g-color-primary">05.</span> Awesome features</h4>
                  <h2 class="g-line-height-1_3 g-font-size-36 mb-0"><strong>Just try</strong> and <strong>use always</strong></h2>
                </div>

                <p class="g-mb-65">Integer ut sollicitudin justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec ullamcorper.</p>

                <div class="media d-block d-md-flex text-center text-md-left g-mb-30">
                  <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                    <span class="u-icon-v2 u-icon-size--lg g-font-size-26 g-color-primary g-rounded-50x"><i class="fa fa-flask"></i></span>
                  </div>

                  <div class="media-body align-self-center">
                    <h4 class="h6 text-uppercase g-font-weight-700 g-color-black g-mb-15">Awesome features</h4>
                    <p class="g-font-size-default mb-0">Vestibulum vulputate lobortis tortor non tempus. Proin in ex blandit velit imperdiet tincidunt sit amet at quam. Nam ac ultrices urna, sit amet fermentum magna. Nulla eu mattis augue.</p>
                  </div>
                </div>

                <div class="media d-block d-md-flex text-center text-md-left">
                  <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                    <span class="u-icon-v2 u-icon-size--lg g-font-size-26 g-color-primary g-rounded-50x"><i class="fa fa-magic"></i></span>
                  </div>

                  <div class="media-body align-self-center">
                    <h4 class="h6 text-uppercase g-font-weight-700 g-color-black g-mb-15">Beautiful and modern design</h4>
                    <p class="g-font-size-default mb-0">Araesent blandit hendrerit justo sed egestas. Proin tincidunt purus in tortor cursus fermentum. Proin laoreet erat vitae dui blandit, vitae faucibus lacus auctor. Proin ornare sit amet arcu at aliquam.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="whyOurApp" class="g-pt-90">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 d-flex g-mb-30 g-mb-0--lg">
              <div class="align-self-center">
                <div class="text-uppercase g-line-height-1_3 g-mb-20">
                  <h4 class="g-font-weight-700 g-font-size-11 g-mb-15">
                    <span class="g-color-primary">06.</span> Why our app</h4>
                  <h2 class="g-line-height-1_3 g-font-size-36 mb-0">Only <strong>just try</strong></h2>
                </div>

                <p class="g-mb-65">Praesent blandit hendrerit justo sed egestas. Proin tincidunt purus in tortor cursus fermentum. Proin laoreet erat vitae dui blandit, vitae faucibus lacus auctor. Proin ornare sit amet arcu at aliquam.</p>

                <div id="whyOurAppAccordion" class="u-accordion" role="tablist" aria-multiselectable="true">
                  <!-- Card -->
                  <div class="card rounded-0 g-bg-primary g-color-white g-brd-none">
                    <div id="awesomeFeatures" class="u-accordion__header g-pa-20" role="tab">
                      <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                        <a class="g-color-white g-text-underline--none--hover" href="#awesomeFeaturesBody"
                           data-toggle="collapse"
                           data-parent="#whyOurAppAccordion"
                           aria-expanded="true"
                           aria-controls="awesomeFeaturesBody">
                        <span class="u-accordion__control-icon g-mr-10">
                          <i class="fa fa-plus"></i>
                          <i class="fa fa-minus"></i>
                        </span>
                          Awesome features
                        </a>
                      </h5>
                    </div>

                    <div id="awesomeFeaturesBody" class="collapse show" role="tabpanel" aria-labelledby="awesomeFeatures">
                      <div class="u-accordion__body g-font-size-default g-pa-0-20-20">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                    </div>
                  </div>
                  <!-- End Card -->

                  <!-- Card -->
                  <div class="card rounded-0 g-bg-primary-dark-v2 g-color-white g-brd-none">
                    <div id="modernAndCreativeDesign" class="u-accordion__header g-pa-20" role="tab">
                      <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                        <a class="collapsed g-color-white g-text-underline--none--hover" aria-expanded="false" aria-controls="modernAndCreativeDesignBody"
                           href="#modernAndCreativeDesignBody"
                           data-toggle="collapse"
                           data-parent="#whyOurAppAccordion">
                        <span class="u-accordion__control-icon g-mr-10">
                          <i class="fa fa-plus"></i>
                          <i class="fa fa-minus"></i>
                        </span>
                          Modern and creative design
                        </a>
                      </h5>
                    </div>

                    <div id="modernAndCreativeDesignBody" class="collapse" role="tabpanel" aria-labelledby="modernAndCreativeDesign">
                      <div class="u-accordion__body g-font-size-default g-pa-0-20-20">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                    </div>
                  </div>
                  <!-- End Card -->

                  <!-- Card -->
                  <div class="card rounded-0 g-bg-primary g-color-white g-brd-none">
                    <div id="regularUpdates" class="u-accordion__header g-pa-20" role="tab">
                      <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                        <a class="collapsed g-color-white g-text-underline--none--hover" href="#regularUpdatesBody" aria-expanded="false" aria-controls="regularUpdatesBody"
                           data-toggle="collapse"
                           data-parent="#whyOurAppAccordion">
                        <span class="u-accordion__control-icon g-mr-10">
                          <i class="fa fa-plus"></i>
                          <i class="fa fa-minus"></i>
                        </span>
                          Regular updates
                        </a>
                      </h5>
                    </div>

                    <div id="regularUpdatesBody" class="collapse" role="tabpanel" aria-labelledby="regularUpdates">
                      <div class="u-accordion__body g-font-size-default g-pa-0-20-20">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                    </div>
                  </div>
                  <!-- End Card -->

                  <!-- Card -->
                  <div class="card rounded-0 g-bg-primary-dark-v2 g-color-white g-brd-none">
                    <div id="professionalSupport24x7" class="u-accordion__header g-pa-20" role="tab">
                      <h5 class="mb-0 text-uppercase g-font-size-default g-font-weight-700">
                        <a class="collapsed g-color-white g-text-underline--none--hover" href="#professionalSupport24x7Body" aria-expanded="false" aria-controls="professionalSupport24x7Body"
                           data-toggle="collapse"
                           data-parent="#whyOurAppAccordion">
                          <span class="u-accordion__control-icon g-mr-10">
                            <i class="fa fa-plus"></i>
                            <i class="fa fa-minus"></i>
                          </span>
                          24/7 professional support
                        </a>
                      </h5>
                    </div>

                    <div id="professionalSupport24x7Body" class="collapse" role="tabpanel" aria-labelledby="professionalSupport24x7">
                      <div class="u-accordion__body g-font-size-default g-pa-0-20-20">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</div>
                    </div>
                  </div>
                  <!-- End Card -->
                </div>
              </div>
            </div>

            <div class="col-lg-5 text-center g-overflow-hidden">
              <img class="img-fluid" src="assets/img-temp/mockups/mockup3.png" alt="Image description"
                   data-animation="slideInUp">
            </div>
          </div>
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="howItWorks" class="g-bg-primary g-py-90">
        <div class="container text-center g-max-width-750 g-mb-65">
          <div class="text-uppercase g-line-height-1_3 g-mb-20">
            <h4 class="g-font-weight-700 g-font-size-11 g-color-white g-mb-15">07. How it works</h4>
            <h2 class="g-line-height-1_3 g-font-size-36 g-color-white mb-0">One time used — <strong>use forever</strong></h2>
          </div>

          <p class="g-color-white mb-0">Integer ut sollicitudin justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
        </div>

        <div class="container">
          <!-- Carousel -->
          <div class="js-carousel"
                   data-infinite="true"
                   data-arrows-classes="u-arrow-v1 g-pos-abs g-top-35x g-width-45 g-height-45 g-color-primary g-bg-white g-rounded-50x g-transition-0_2 g-transition--ease-in"
                   data-arrow-left-classes="fa fa-chevron-left g-left-0"
                   data-arrow-right-classes="fa fa-chevron-right g-right-0">
            <div class="js-slide">
              <div class="container text-center g-max-width-750">
                <div class="g-mb-20">
                  <img class="d-inline-block" src="assets/img-temp/mockups/mockup5.png" alt="Image description">
                  <img class="d-inline-block" src="assets/img-temp/mockups/mockup6.png" alt="Image description">
                </div>

                <h4 class="h6 text-uppercase g-font-weight-700 g-color-white g-mb-15">User Manual</h4>
                <p class="g-font-size-default g-color-white-opacity-0_8 g-mb-30">Sed feugiat porttitor nunc, non dignissim ipsum vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem.</p>
                <a class="btn btn-lg text-uppercase u-btn-white g-font-weight-700 g-font-size-12 g-rounded-10 g-px-25 g-py-12 mb-0" href="#">Learn more</a>
              </div>
            </div>

            <div class="js-slide">
              <div class="container text-center g-max-width-750">
                <div class="g-mb-20">
                  <img class="d-inline-block" src="assets/img-temp/mockups/mockup5.png" alt="Image description">
                  <img class="d-inline-block" src="assets/img-temp/mockups/mockup6.png" alt="Image description">
                </div>

                <h4 class="h6 text-uppercase g-font-weight-700 g-color-white g-mb-15">Made with love</h4>
                <p class="g-font-size-default g-color-white-opacity-0_8 g-mb-30">Sed feugiat porttitor nunc, non dignissim ipsum vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem, vel faucibus ante. Nunc ullamcorper, justo a iaculis elementum, enim orci viverra eros, fringilla porttitor lorem eros vel odio.</p>
                <a class="btn btn-lg text-uppercase u-btn-white g-font-weight-700 g-font-size-12 g-rounded-10 g-px-25 g-py-12 mb-0" href="#">Learn more</a>
              </div>
            </div>

            <div class="js-slide">
              <div class="container text-center g-max-width-750">
                <div class="g-mb-20">
                  <img class="d-inline-block" src="assets/img-temp/mockups/mockup5.png" alt="Image description">
                  <img class="d-inline-block" src="assets/img-temp/mockups/mockup6.png" alt="Image description">
                </div>

                <h4 class="h6 text-uppercase g-font-weight-700 g-color-white g-mb-15">Usability and progresion</h4>
                <p class="g-font-size-default g-color-white-opacity-0_8 g-mb-30">Sed feugiat porttitor nunc, non dignissim ipsum vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem, vel faucibus ante. Nunc ullamcorper.</p>
                <a class="btn btn-lg text-uppercase u-btn-white g-font-weight-700 g-font-size-12 g-rounded-10 g-px-25 g-py-12 mb-0" href="#">Learn more</a>
              </div>
            </div>
          </div>
          <!-- End Carousel -->
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="appScreens" class="g-py-90">
        <div class="container text-center g-max-width-750 g-mb-65">
          <div class="text-uppercase g-line-height-1_3 g-mb-20">
            <h4 class="g-font-weight-700 g-font-size-11 g-mb-15"><span class="g-color-primary">08.</span> App screens
            </h4>
            <h2 class="g-font-size-36 mb-0">Look <strong>how it works</strong></h2>
          </div>
        </div>

        <div class="container">
          <ul id="appScreensCubePortfolioFilter" class="nav justify-content-center d-block d-md-flex u-nav-v5-1 text-uppercase g-overflow-x-scroll g-line-height-1_4 g-font-weight-700 g-font-size-11 g-nowrap g-brd-bottom--md g-brd-gray-light-v4 g-mb-20 g-mb-70--md">
            <li class="cbp-filter-item nav-item cbp-filter-item-active"
                data-filter="*">
              <span class="nav-link g-px-0--md g-pb-15--md g-mr-30--md">Everything</span>
            </li>
            <li class="cbp-filter-item nav-item"
                data-filter=".login">
              <span class="nav-link g-px-0--md g-pb-15--md g-mr-30--md">Login</span>
            </li>
            <li class="cbp-filter-item nav-item"
                data-filter=".sign-up">
              <span class="nav-link g-px-0--md g-pb-15--md g-mr-30--md">Sign up</span>
            </li>
            <li class="cbp-filter-item nav-item"
                data-filter=".home">
              <span class="nav-link g-px-0--md g-pb-15--md g-mr-30--md">Home</span>
            </li>
            <li class="cbp-filter-item nav-item"
                data-filter=".calender">
              <span class="nav-link g-px-0--md g-pb-15--md g-mr-30--md">Calendar</span>
            </li>
            <li class="cbp-filter-item nav-item"
                data-filter=".list">
              <span class="nav-link g-px-0--md g-pb-15--md g-mr-30--md">List</span>
            </li>
          </ul>

          <div id="appScreensCubePortfolio" class="cbp"
               data-controls="#appScreensCubePortfolioFilter"
               data-layout="grid"
               data-animation="slideLeft"
               data-caption-animation="fadeIn"
               data-x-gap="30"
               data-y-gap="30"
               data-media-queries='[
                 {"width": 800, "cols": 4},
                 {"width": 500, "cols": 2},
                 {"width": 320, "cols": 1}
               ]'>
            <div class="cbp-item home">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img1.jpg"
                 data-title="Custom Title 1">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img1.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item home">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img2.jpg"
                 data-title="Custom Title 2">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img2.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item login">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img3.jpg"
                 data-title="Custom Title 3">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img3.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item login">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img4.jpg"
                 data-title="Custom Title 4">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img4.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item sign-up">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img5.jpg"
                 data-title="Custom Title 1">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img5.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item sign-up">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img6.jpg"
                 data-title="Custom Title 2">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img6.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item calender">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img7.jpg"
                 data-title="Custom Title 3">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img7.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item calender">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img8.jpg"
                 data-title="Custom Title 4">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img8.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item list">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img9.jpg"
                 data-title="Custom Title 1">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img9.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item list">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img10.jpg"
                 data-title="Custom Title 2">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img10.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item calender">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img11.jpg"
                 data-title="Custom Title 3">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img11.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="cbp-item sign-up">
              <a class="cbp-caption cbp-lightbox d-block" href="assets/img-temp/270x481/img12.jpg"
                 data-title="Custom Title 4">
                <div class="cbp-caption-defaultWrap">
                  <img src="assets/img-temp/270x481/img12.jpg" alt="Image description">
                </div>

                <div class="cbp-caption-activeWrap g-bg-primary-opacity-0_6">
                  <div class="cbp-l-caption-alignCenter">
                    <div class="cbp-l-caption-body">
                      <div class="cbp-l-caption-title g-font-size-50">+</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="subscribe" class="g-theme-bg-gray-light-v1 g-pt-90">
        <div class="container text-center g-max-width-750 g-mb-65">
          <div class="text-uppercase g-line-height-1_3 g-mb-20">
            <h4 class="g-font-weight-700 g-font-size-11 g-mb-15"><span class="g-color-primary">09.</span> Subscribe</h4>
            <h2 class="g-font-size-36 mb-0">Only <strong>actual information</strong></h2>
          </div>

          <p class="g-mb-65">Integer ut sollicitudin justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

          <form class="g-px-70--md g-mb-70">
            <div class="input-group input-group-lg g-brd-white g-brd-primary--focus g-rounded-10">
              <input class="form-control g-font-size-default g-brd-none g-py-14" type="email" placeholder="Enter your email">

              <div class="input-group-btn g-ml-minus-10">
                <button class="btn u-btn-primary text-uppercase g-font-weight-700 g-font-size-12 g-rounded-10" type="button">Submit</button>
              </div>
            </div>
          </form>
        </div>

        <div class="container text-center g-overflow-hidden">
          <img class="img-fluid" src="assets/img-temp/mockups/mockup4.png" alt="Image description"
               data-animation="slideInUp">
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="FAQ" class="g-py-90">
        <div class="container">
          <div class="row">
            <div class="col-md-5 text-center g-overflow-hidden g-mb-50 g-mb-0--md">
              <img class="img-fluid" src="assets/img-temp/mockups/mockup2.png" alt="Image description"
                   data-animation="slideInLeft">
            </div>

            <div class="col-md-7 d-flex text-center text-md-left">
              <div class="align-self-center">
                <div class="text-uppercase g-mb-20">
                  <h4 class="g-font-weight-700 g-font-size-11 g-mb-15">
                    <span class="g-color-primary"></span>What We Offer</h4>
                  <h2 class="g-line-height-1_3 g-font-size-36 mb-0"><strong>Pharmaceutical Companies</strong></h2>
                </div>

                <p class="g-mb-65">
                  Afya Pepe offers pharmaceutical companies real-time information on five
                  key areas at the core of sales and operations:
                 </p>

                <div class="media d-block d-md-flex text-center text-md-left g-mb-30">
                  <!-- <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                    <span class="u-icon-v2 u-icon-size--lg g-font-size-26 g-color-primary g-rounded-50x"><i class="fa fa-flask"></i></span>
                  </div> -->

                  <div class="media-body align-self-center">
                    <h4 class="h6 text-uppercase g-font-weight-700 g-color-black g-mb-15">Monitoring of Sales and inventory:</h4>
                    <p class="g-font-size-default mb-0">
                       Monitor company sales by region,
                       drug, prescribing doctor, and facility; track sales rates (run rates),
                        stock levels, prescription fill rates; conduct inventory and competitor
                         analysis.
                    </p>
                  </div>
                </div>
                <div class="media d-block d-md-flex text-center text-md-left g-mb-30">
                  <!-- <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                    <span class="u-icon-v2 u-icon-size--lg g-font-size-26 g-color-primary g-rounded-50x"><i class="fa fa-flask"></i></span>
                  </div> -->

                  <div class="media-body align-self-center">
                    <h4 class="h6 text-uppercase g-font-weight-700 g-color-black g-mb-15">Monitoring of Medical representative:</h4>
                    <p class="g-font-size-default mb-0">
                   Monitor sales by representative;
                  assess representatives’ relative performance;improvework planning and
                   reporting against KPIs
                    </p>
                  </div>
                </div>
                <div class="media d-block d-md-flex text-center text-md-left g-mb-30">
                  <!-- <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                    <span class="u-icon-v2 u-icon-size--lg g-font-size-26 g-color-primary g-rounded-50x"><i class="fa fa-flask"></i></span>
                  </div> -->

                  <div class="media-body align-self-center">
                    <h4 class="h6 text-uppercase g-font-weight-700 g-color-black g-mb-15">Monitoring of Sales substitution:</h4>
                    <p class="g-font-size-default mb-0">
                    monitor cases of
                    substitution away from company/drug by reason.
                      </p>
                  </div>
                </div>
                <div class="media d-block d-md-flex text-center text-md-left g-mb-30">
                  <!-- <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                    <span class="u-icon-v2 u-icon-size--lg g-font-size-26 g-color-primary g-rounded-50x"><i class="fa fa-flask"></i></span>
                  </div> -->

                  <div class="media-body align-self-center">
                    <h4 class="h6 text-uppercase g-font-weight-700 g-color-black g-mb-15">Monitoring of Counterfeit and parallel trade:</h4>
                    <p class="g-font-size-default mb-0">
                       monitor counterfeit drugs by drug,
                      region, pharmacy/facility; monitor parallel trade by drug, region,
                      and pharmacy/facility
                     </p>
                  </div>
                </div>

                <div class="media d-block d-md-flex text-center text-md-left">
                  <!-- <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                    <span class="u-icon-v2 u-icon-size--lg g-font-size-26 g-color-primary g-rounded-50x"><i class="fa fa-magic"></i></span>
                  </div> -->

                  <div class="media-body align-self-center">
                    <h4 class="h6 text-uppercase g-font-weight-700 g-color-black g-mb-15">Monitoring of Price adherence/intelligence:</h4>
                    <p class="g-font-size-default mb-0">
                     monitor price adherence
                     by pharmacy and agents; access price index for company’s drugs and
                      competitors
                     </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Section Content -->
      <section id="contact" class="g-bg-primary g-pt-90 g-pb-30 g-pb-90--lg">
        <div class="container">
          <div class="row">
            <div class="col-lg-5 g-mb-20 g-mb-0--lg">
              <div class="text-uppercase g-mb-20">
                <h4 class="g-font-weight-700 g-font-size-11 g-color-white g-mb-15">11. Contact us</h4>
                <h2 class="g-font-size-36 g-color-white mb-0">Answers to <strong>your questions</strong></h2>
              </div>

              <p class="g-color-white mb-0">Integer ut sollicitudin justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
            </div>

            <div class="col-lg-7 g-pt-30--lg">
              <form>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group g-mb-30">
                      <input id="inputGroup1_1" class="form-control g-font-size-default g-color-white g-placeholder-inherit g-bg-transparent g-bg-transparent--focus g-brd-white g-rounded-10 g-px-20 g-py-10" type="text" placeholder="Name">
                    </div>

                    <div class="form-group g-mb-30">
                      <input id="inputGroup1_2" class="form-control g-font-size-default g-color-white g-placeholder-inherit g-bg-transparent g-bg-transparent--focus g-brd-white g-rounded-10 g-px-20 g-py-10" type="email" placeholder="Email *">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group g-mb-30">
                      <textarea id="inputGroup1_3" class="form-control g-resize-none g-font-size-default g-color-white g-placeholder-inherit g-bg-transparent g-bg-transparent--focus g-brd-white g-rounded-10 g-px-20 g-py-10" rows="5" placeholder="Message"></textarea>
                    </div>

                    <div class="text-center text-md-right">
                      <button class="btn u-btn-white btn-lg text-uppercase g-font-weight-700 g-font-size-12 g-color-black g-rounded-10 mb-0" type="submit" role="button">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- End Section Content -->

      <!-- Footer -->
      <footer>
        <ul class="list-inline d-table w-100 mb-0">
          <li class="list-inline-item d-table-cell g-width-1x">
            <a class="btn btn-lg u-btn-indigo btn-block rounded-0 g-py-20" href="#"><i class="fa fa-facebook"></i></a>
          </li>
          <li class="list-inline-item d-table-cell g-width-1x">
            <a class="btn btn-lg u-btn-pink btn-block rounded-0 g-py-20" href="#"><i class="fa fa-pinterest"></i></a>
          </li>
          <li class="list-inline-item d-table-cell g-width-1x">
            <a class="btn btn-lg u-btn-purple btn-block rounded-0 g-py-20" href="#"><i class="fa fa-dribbble"></i></a>
          </li>
          <li class="list-inline-item d-table-cell g-width-1x">
            <a class="btn btn-lg u-btn-teal btn-block rounded-0 g-py-20" href="#"><i class="fa fa-instagram"></i></a>
          </li>
          <li class="list-inline-item d-table-cell g-width-1x">
            <a class="btn btn-lg u-btn-blue btn-block rounded-0 g-py-20" href="#"><i class="fa fa-twitter"></i></a>
          </li>
        </ul>
      </footer>
      <!-- End Footer -->
    </main>

    <!-- JS Global Compulsory -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/jquery.easing/js/jquery.easing.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/tether.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
  <!-- JS Implementing Plugins -->
    <script src="{{ asset('') }}" type="text/javascript"></script>
    <script src="{{ asset('') }}" type="text/javascript"></script>
    <script src="{{ asset('') }}" type="text/javascript"></script>
    <script src="{{ asset('') }}" type="text/javascript"></script>
    <script src="{{ asset('') }}" type="text/javascript"></script>
    <script src="{{ asset('') }}" type="text/javascript"></script>
    <script src="{{ asset('') }}" type="text/javascript"></script>
    <script src="{{ asset('') }}" type="text/javascript"></script>
    <script src="vendor/smoothScroll.js"></script>
    <script src="vendor/appear.js"></script>
    <script src="vendor/dzsparallaxer/dzsparallaxer.js"></script>
    <script src="vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
    <script src="vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
    <script src="vendor/fancybox/jquery.fancybox.js"></script>
    <script src="vendor/cubeportfolio-full/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
    <script src="vendor/slick-carousel/slick/slick.js"></script>

    <!-- JS Unify -->
    <script src="{{ asset('assets/js/hs.core.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/components/hs.header.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/hs.hamburgers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/components/hs.scroll-nav.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/components/hs.onscroll-animation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/components/hs.tabs.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/components/hs.cubeportfolio.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/components/hs.popup.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/components/hs.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/custom.js') }}" type="text/javascript"></script>


    <!-- JS Plugins Init. -->
    <script>
      $(document).on('ready', function () {
        // Initialization of HSScrollNav
        $.HSCore.components.HSScrollNav.init($('#js-scroll-nav'), {
          duration: 700,
          easing: 'easeOutExpo'
        });

        // Initialization of Hamburgers
        $.HSCore.helpers.HSHamburgers.init('.hamburger');

        // Initialization of HSHeader
        $.HSCore.components.HSHeader.init($('#js-header'));

        // Initialization of tabs
        $.HSCore.components.HSTabs.init('[role="tablist"]');

        // initialization of animation
        $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

        // initialiation of cube portfolio
        $.HSCore.components.HSCubeportfolio.init('.cbp');

        // Popup (Fancybox)
        $.HSCore.components.HSPopup.init('.js-fancybox-media', {
          helpers: {
            media: {},
            overlay: {
              css: {
                'background': 'rgba(255, 255, 255, .8)'
              }
            }
          }
        });

        // Parallax
        dzsas_init('#as0', {
          settings_mode: 'onlyoneitem',
          design_arrowsize: '0',
          settings_swipe: 'on',
          settings_swipeOnDesktopsToo: 'on',
          settings_slideshow: 'on',
          settings_slideshowTime: '300',
          settings_autoHeight: 'off',
          settings_transition: 'fade',
          settings_centeritems: false
        });

        // initialiation of carousel
        $.HSCore.components.HSCarousel.init('.js-carousel');

        $('#carouselCus1').slick('setOption', 'responsive', [{
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        }, {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }, {
          breakpoint: 670,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }, {
          breakpoint: 500,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }], true);
      });

      $(window).on('resize', function () {
        setTimeout(function () {
          $.HSCore.components.HSTabs.init('[role="tablist"]');
        }, 200);
      });
    </script>
  </body>
</html>
