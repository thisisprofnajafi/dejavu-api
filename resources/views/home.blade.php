@extends('layouts.layout')

@section('content')
    <div id="wrapper">
        @include('layouts.app-header')
        <main id="main" class="modular-page">
            <div class="section section--hero is-wave intro bg--white">

                <div class="section-wrapper hero">
                    <div class="hero-wrapper">
                        <div class="container">
                            <svg class="hidden-svg" width="0" height="0" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <clipPath clipPathUnits="objectBoundingBox" id="heroCurve" class="clippath-shape">
                                    <path class="path"
                                          d="M0 60C0 31.7 0 17.6 8.8 8.8 17.6 0 31.8 0 60 0h1560c28.3 0 42.4 0 51.2 8.8 8.8 8.8 8.8 23 8.8 51.2v880c0 28.3 0 42.4-8.8 51.2-8.8 8.8-23 8.8-51.2 8.8H60c-28.3 0-42.4 0-51.2-8.8C0 982.4 0 968.2 0 940V60Z"
                                          transform="scale(0.0005952380952380953,0.001)"/>
                                </clipPath>
                            </svg>
                            <div class="hero-video-wrap">
                                <video playsinline autoplay muted loop poster="{{asset('profassets/jaguar.webp')}}">
                                    <source src="{{asset('profassets/jaguar.mp4')}}" type="video/mp4">
                                </video>
                                <canvas data-bg=#ffffff id="wave--hero" resize="true"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="section section--services is-wave current-wtype3 bg--white">

                <div class="section-wrapper services">
                    <div class="container">
                        <div class="heading--center heading-base">
                            <i class="ws-circle-shape"><i class="dot"></i></i>
                            <div class="services__typography typography">
                                <img width="106" height="51"
                                     src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20106%2051'%3E%3C/svg%3E"
                                     class="attachment-full size-full" alt="" decoding="async"
                                     data-lazy-src="https://websima.com/wp-content/uploads/2024/08/fa-websima.svg"/>
                                <noscript><img
                                        width="106" height="51"
                                        src="https://websima.com/wp-content/uploads/2024/08/fa-websima.svg"
                                        class="attachment-full size-full" alt="" decoding="async"/></noscript>
                            </div>
                            <h2 class="services__title fs-24 fw-600 title">چگونه به کسب‌وکار شما کمک می‌کنیم؟</h2>
                            <p class="services__subtitle  subtitle__text subtitle">وب‌سایت شما، ویترین دیجیتال برندتان
                                است. در دنیای
                                آنلاین امروز، داشتن یک سایت ساده کافی نیست؛ باید وب‌سایتی داشته باشید که چشم‌نواز، سریع،
                                و هوشمندانه
                                طراحی شده باشد.
                                <br/>
                            </p>
                            <p class="services__subtitle  subtitle__text subtitle">
                                در رایا پردازان ما فراتر از طراحی صفحات وب حرکت می‌کنیم — ما تجربه‌ای دیجیتال می‌سازیم
                                که مشتریانتان را
                                جذب و درگیر می‌کند. چه به دنبال یک سایت شرکتی رسمی باشید، چه یک فروشگاه آنلاین پیشرفته
                                یا حتی یک صفحه
                                شخصی خاص، تیم ما با تلفیق خلاقیت، تکنولوژی روز و اصول سئو، وب‌سایتی می‌سازد که دقیقاً با
                                نیاز و هدف شما
                                هم‌راستاست. وقتشه متفاوت دیده بشید؛ بیایید با هم تصویر دیجیتال برندتان را حرفه‌ای‌تر،
                                پویاتر و ماندگارتر
                                بسازیم

                                <br/>
                            </p>
                        </div>
                        <svg class="hidden-svg" width="0" height="0" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <clipPath clipPathUnits="objectBoundingBox" id="serviceCardCurve" class="clippath-shape">
                                <path class="path"
                                      d="M14.645 381.355C3.065 369.776.64 352.615.135 322.634a15.999 15.999 0 0 1 4.822-9.51l8.085-7.711A15.998 15.998 0 0 0 18 293.835v-176.67c0-4.375-1.792-8.559-4.958-11.578l-8.085-7.711A16 16 0 0 1 .013 86.95C.137 48.377 1.42 27.87 14.645 14.645 29.288 0 52.858 0 100 0h196c47.14 0 70.711 0 85.355 14.645 13.226 13.226 14.507 33.732 14.632 72.305a15.998 15.998 0 0 1-4.945 10.926l-8.085 7.711A15.998 15.998 0 0 0 378 117.165v176.67c0 4.375 1.791 8.559 4.957 11.578l8.085 7.711a16.001 16.001 0 0 1 4.824 9.51c-.508 29.981-2.931 47.142-14.511 58.721C366.711 396 343.14 396 296 396H100c-47.14 0-70.71 0-85.356-14.645Z"
                                      transform="scale(0.002525418341775543,0.0025252525252525255)"/>
                            </clipPath>
                        </svg>
                        <div class="service-cats">
                            <div class="service-cat-card play-on-hover">
                                <div class="service-cat-top">
                                    <a class="service-cat__img" href="https://websima.com/website-design/">
                                        <video class="video" muted
                                               loop preload="none">
                                            <source src="https://websima.com/wp-content/uploads/2025/02/webdisign-1.mp4"
                                                    type="video/mp4">
                                        </video>
                                        <img width="1080" height="1080"
                                             src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201080%201080'%3E%3C/svg%3E"
                                             class="poster-img" alt="" decoding="async" fetchpriority="high"
                                             data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007628-1.webp"/>
                                        <noscript><img
                                                width="1080" height="1080"
                                                src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007628-1.webp"
                                                class="poster-img"
                                                alt="" decoding="async" fetchpriority="high"/></noscript>
                                    </a>
                                    <div class="service-cat__shadow"></div>
                                </div>
                                <div class="service-cat-bottom">
                                    <h3 class="service-cat__title">
                                        <a href="https://websima.com/website-design/"> طراحی وب‌سایت </a></h3>
                                    <p class="service-cat__entitle">
                                        <a href="https://websima.com/website-design/"> Web Design & Development </a></p>
                                    <p class="service-cat__desc">وب‌سایت حرفه‌ای، امن و توسعه‌پذیر، اولین قدم برای
                                        موفقیت پایدار در دنیای
                                        دیجیتال است. ما در رایاپردازان با طراحی سایت‌های مدرن، سریع و کاربرپسند،
                                        تجربه‌ای منحصر‌به‌فرد و
                                        جلوه‌ای محترمانه از قدرت برند شما، برای مشتریان و بازدیدکنندگان شما خلق
                                        می‌کنیم. </p>
                                </div>
                            </div>
                            <div class="service-cat-card play-on-hover">
                                <div class="service-cat-top">
                                    <a class="service-cat__img" href="https://websima.com/seo-digital-marketing/">
                                        <video class="video"
                                               muted loop preload="none">
                                            <source
                                                src="https://websima.com/wp-content/uploads/2025/02/digitalmarketing-1.mp4"
                                                type="video/mp4">
                                        </video>
                                        <img width="1080" height="1080"
                                             src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201080%201080'%3E%3C/svg%3E"
                                             class="poster-img" alt="" decoding="async"
                                             data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007663.webp"/>
                                        <noscript><img
                                                width="1080" height="1080"
                                                src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007663.webp"
                                                class="poster-img"
                                                alt="" decoding="async"/></noscript>
                                    </a>
                                    <div class="service-cat__shadow"></div>
                                </div>
                                <div class="service-cat-bottom">
                                    <h3 class="service-cat__title">
                                        <a href="https://websima.com/seo-digital-marketing/"> سئو و بازاریابی
                                            دیجیتال </a></h3>
                                    <p class="service-cat__entitle">
                                        <a href="https://websima.com/seo-digital-marketing/"> SEO & Digital
                                            Marketing </a></p>
                                    <p class="service-cat__desc">خدمات بازاریابی دیجیتال رایاپردازان، شامل سئو ماهانه،
                                        مشاوره سئو، تدوین
                                        تقویم محتوایی هدفمند و توسعه برندینگ آنلاین است، به شما کمک می‌کنیم در فضای
                                        آنلاین بیش‌ از پیش
                                        اعتماد مشتریان را جلب کنید و فرصت‌های فروش و بازاریابی خود را توسعه دهید. </p>
                                </div>
                            </div>
                            <div class="service-cat-card play-on-hover">
                                <div class="service-cat-top">
                                    <a class="service-cat__img" href="https://websima.com/digital-strategy/">
                                        <video class="video" muted
                                               loop preload="none">
                                            <source
                                                src="https://websima.com/wp-content/uploads/2025/02/digital-strategy-1.mp4"
                                                type="video/mp4">
                                        </video>
                                        <img width="1080" height="1080"
                                             src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201080%201080'%3E%3C/svg%3E"
                                             class="poster-img" alt="" decoding="async"
                                             data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007612-2.webp"/>
                                        <noscript><img
                                                width="1080" height="1080"
                                                src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007612-2.webp"
                                                class="poster-img"
                                                alt="" decoding="async"/></noscript>
                                    </a>
                                    <div class="service-cat__shadow"></div>
                                </div>
                                <div class="service-cat-bottom">
                                    <h3 class="service-cat__title">
                                        <a href="https://websima.com/digital-strategy/"> تدوین استراتژی دیجیتال </a>
                                    </h3>
                                    <p class="service-cat__entitle">
                                        <a href="https://websima.com/digital-strategy/"> Strategic Planning </a></p>
                                    <p class="service-cat__desc">استراتژی دیجیتال به شما کمک می‌کند تا با شناخت دقیق
                                        بازار و مخاطبان هدف،
                                        مسیر رشد خود را مشخص کنید. ما در رایاپردازان با تدوین استراتژی جامع، از تحلیل
                                        رقبا تا تعیین اهداف
                                        بازاریابی، نقشه راهی شفاف برای موفقیت دیجیتال شما ترسیم می‌کنیم. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <canvas id="wave_canvas_dc2adcbc" class="wbswave wave--services" resize="true" data-wave="type3"
                  data-style="type5" data-bg="#050033"></canvas> -->
            </section>
            <!-- <section class="section section--portfolio is-wave current-wtype2 is-wave-prev bg--primary">

              <div class="section-wrapper portfolio">

                <div class="portfolio--tabs">
                  <video class="portfolio__bg-video" playsinline autoplay loop muted preload="none" poster="">
                    <source src="https://websima.com/wp-content/themes/websima/assets/video/bg.mp4" type="video/mp4">
                  </video>
                  <div class="mode--dark">
                    <div class="container">
                      <div class="portfolio--head heading--center heading-base">
                        <div class="portfolio__typography typography">
                          <img width="356" height="119"
                            src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20356%20119'%3E%3C/svg%3E"
                            class="attachment-full size-full" alt="نتایج" decoding="async"
                            data-lazy-src="https://websima.com/wp-content/uploads/2024/08/title-portfolio.svg" /><noscript><img
                              width="356" height="119"
                              src="https://websima.com/wp-content/uploads/2024/08/title-portfolio.svg"
                              class="attachment-full size-full" alt="نتایج" decoding="async" /></noscript> </div>
                        <h2 class="portfolio__title fs-24 fw-600 title">نمونه‌کارهای طراحی سایت رایاپردازان</h2>
                        <p class="portfolio__subtitle  subtitle__text subtitle">برای ما نتیجه مهم است! و همه نتایج برای ما
                          افتخارآفرینند، همه تجربه‌ها، همه موفقیت‌ها </p>
                      </div>
                      <div class="portfolio-tabs-wrapper section--tabs-wrapper">
                        <div class="item portfolio-tabs__btn">
                          <a href="https://websima.com/portfolios/" class="btn btn--primary-500" target="_self">
                            <div class="btn__text" data-text="همه نمونه کارها">
                              همه نمونه کارها </div>
                          </a>
                        </div>

                        <div class="section--tabs portfolio-tab item">
                          <span data-tab="tab-0" class="tab active" role="button" tabindex="0"> نمونه‌کارهای فروشگاه اینترنتی
                          </span>
                          <span data-tab="tab-1" class="tab " role="button" tabindex="0"> نمونه‌کارهای سایت شرکتی </span>
                        </div>

                        <p class="portfolio--en-title item">Success Stories</p>
                      </div>
                    </div>
                    <svg class="hidden-svg" width="0" height="0" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <clipPath clipPathUnits="objectBoundingBox" id="portfolioCardCurve" class="clippath-shape">
                        <path class="path"
                          d="M0 60C0 31.716 0 17.574 8.787 8.787 17.574 0 31.716 0 60 0h135c28.284 0 42.426 0 51.213 8.787C255 17.574 255 31.716 255 60v335c0 28.284 0 42.426-8.787 51.213C237.426 455 223.284 455 195 455H60c-28.284 0-42.426 0-51.213-8.787C0 437.426 0 423.284 0 395V60Z"
                          transform="scale(0.00392156862745098,0.002197802197802198)" />
                      </clipPath>
                    </svg>
                    <div class="swiper sw--portfolios">
                      <div class="swiper-wrapper">
                        <div class="swiper-slide">
                          <div class="swiper sw--portfolio">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#002864">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/tehranspeaker/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/Homepage-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/11/Homepage-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="300" height="70"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%2070'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/Layer_1-300x70.webp" /><noscript><img
                                            width="300" height="70"
                                            src="https://websima.com/wp-content/uploads/2024/11/Layer_1-300x70.webp"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#5f0096">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/sehramiz/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/khane-shokolat-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/12/khane-shokolat-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="97" height="81"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2097%2081'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/Vector.png" /><noscript><img
                                            width="97" height="81"
                                            src="https://websima.com/wp-content/uploads/2024/12/Vector.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#80b230">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/narmak/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/Narmak-Homepage-desktop-.-webp-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/12/Narmak-Homepage-desktop-.-webp-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="271" height="110"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20271%20110'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/Vector-7.png" /><noscript><img
                                            width="271" height="110"
                                            src="https://websima.com/wp-content/uploads/2024/12/Vector-7.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#0a2252">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/bolejsofa/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/bolej-mobl-Homepage-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/12/bolej-mobl-Homepage-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Group-1000006830.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/Group-1000006830.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#e0775b">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/gplus/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Gplus-Home-Page-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2025/02/Gplus-Home-Page-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Group-1000007062.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/Group-1000007062.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#009879">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/bonmano/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/bonmano-HomePage-v1-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2025/02/bonmano-HomePage-v1-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Group-1502-1.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/Group-1502-1.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#043424">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/greengoldgallery/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/Homepage-Final-edit-2-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/11/Homepage-Final-edit-2-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/logo-green-1.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/logo-green-1.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#06677e">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/ariyana-ghalam/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Ariana-Homepage-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2025/02/Ariana-Homepage-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Group.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/Group.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#663f58">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/laleh-mehregan/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Laleh-Homepage-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2025/02/Laleh-Homepage-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/laleh-logo3.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/laleh-logo3.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#ad2727">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/hatron/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Homepage-Desktop-V.-Type-B-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2025/02/Homepage-Desktop-V.-Type-B-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-173-1.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/Frame-173-1.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#415b56">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/herahomedecor/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Home-Page-Final-_-Desktop-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2025/04/Home-Page-Final-_-Desktop-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/04/hera.svg" /><noscript><img
                                            width="1" height="1" src="https://websima.com/wp-content/uploads/2025/04/hera.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="swiper-pagination sw-pagination__hero"></div>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="swiper sw--portfolio">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#ba91e2">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/kachiran/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/kachiran-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/11/kachiran-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="300" height="80"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%2080'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/Group-1000006988-300x80.png" /><noscript><img
                                            width="300" height="80"
                                            src="https://websima.com/wp-content/uploads/2024/11/Group-1000006988-300x80.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#6524a5">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/homecubes/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/homecubes-1-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/11/homecubes-1-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="300" height="68"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%2068'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/Group-1000006990-300x68.webp" /><noscript><img
                                            width="300" height="68"
                                            src="https://websima.com/wp-content/uploads/2024/11/Group-1000006990-300x68.webp"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#c91414">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/kabir-motor/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/Homepage-V.1-Desktop-1-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/11/Homepage-V.1-Desktop-1-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="300" height="261"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20261'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/Group-1000006831-300x261.png" /><noscript><img
                                            width="300" height="261"
                                            src="https://websima.com/wp-content/uploads/2024/11/Group-1000006831-300x261.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#0800a8">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/raymanpack/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/Homepage-Final-Ver-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/11/Homepage-Final-Ver-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="300" height="64"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%2064'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/Group-50-300x64.png" /><noscript><img
                                            width="300" height="64"
                                            src="https://websima.com/wp-content/uploads/2024/12/Group-50-300x64.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#cf7651">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/bolej-cabinet/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/Bolej-desktop-02-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/12/Bolej-desktop-02-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="300" height="182"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20182'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/Group-1000006986-300x182.png" /><noscript><img
                                            width="300" height="182"
                                            src="https://websima.com/wp-content/uploads/2024/11/Group-1000006986-300x182.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle active"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle active"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last active">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first active">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#021172">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/qlean/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/qlean-Homepage-Merge-webp-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/12/qlean-Homepage-Merge-webp-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="264" height="91"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20264%2091'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/Vector-8.png" /><noscript><img
                                            width="264" height="91"
                                            src="https://websima.com/wp-content/uploads/2024/12/Vector-8.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#c8a86f">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/gamut/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/11/home-page-Desktop-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/11/home-page-Desktop-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="300" height="85"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%2085'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/gamot-300x85.png" /><noscript><img
                                            width="300" height="85"
                                            src="https://websima.com/wp-content/uploads/2024/12/gamot-300x85.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#008087">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/yazdsteel/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/yazd-Homepage-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/12/yazd-Homepage-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="300" height="79"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%2079'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/Group-1000006993-300x79.png" /><noscript><img
                                            width="300" height="79"
                                            src="https://websima.com/wp-content/uploads/2024/12/Group-1000006993-300x79.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#006241">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/tak-makaron/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/1920w-light-1-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2024/12/1920w-light-1-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="80" height="98"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2080%2098'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2024/12/Group-3-1.png" /><noscript><img
                                            width="80" height="98"
                                            src="https://websima.com/wp-content/uploads/2024/12/Group-3-1.png"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#170770">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/panco/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/panco-3-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2025/02/panco-3-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Group-1000007023.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/Group-1000007023.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#ee7203">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/danaenergy/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Dana-Home-Page-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2025/02/Dana-Home-Page-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/danaenergy.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/danaenergy.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="swiper-slide">
                                <div class="portfolio-card card-js" style="--c :#ffbe00">
                                  <div class="portfolio-card-wrap" data-swiper-parallax-scale="1"
                                    data-swiper-parallax-x="-100%">
                                    <div class="portfolio-card-special">
                                      <i class="ic-star portfolio-special__star"></i>
                                      <span class="portfolio-special__text">SPECIAL</span>
                                    </div>
                                    <a href="https://websima.com/portfolio/smsir/" class="portfolio-card-link">
                                      <div class="portfolio-card__img">
                                        <img width="300" height="600"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20300%20600'%3E%3C/svg%3E"
                                          class="attachment-portfolio-card size-portfolio-card" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/SMS.ir-Homepage-300x600.webp" /><noscript><img
                                            width="300" height="600"
                                            src="https://websima.com/wp-content/uploads/2025/02/SMS.ir-Homepage-300x600.webp"
                                            class="attachment-portfolio-card size-portfolio-card" alt=""
                                            decoding="async" /></noscript> </div>
                                      <div class="logo portfolio-card__logo">
                                        <img width="1" height="1"
                                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201%201'%3E%3C/svg%3E"
                                          class="attachment-medium size-medium wp-post-image" alt="" decoding="async"
                                          data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Company-sms.ir_-1.svg" /><noscript><img
                                            width="1" height="1"
                                            src="https://websima.com/wp-content/uploads/2025/02/Company-sms.ir_-1.svg"
                                            class="attachment-medium size-medium wp-post-image" alt=""
                                            decoding="async" /></noscript> </div>
                                    </a>
                                    <div class="portfolio-services">
                                      <div class="services portfolio-card__services">
                                        <i class="ic-triangle"></i>
                                        <i class="ic-square active"></i>
                                        <i class="ic-circle"></i>
                                      </div>
                                      <div class="portfolio-help__services">
                                        <span class="help last">
                                          <b> Strategy </b>
                                        </span>
                                        <span class="help middle active">
                                          <b> Web Design </b>
                                        </span>

                                        <span class="help first">
                                          <b> SEO & Marketing </b>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="swiper-pagination sw-pagination__hero"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="portfolio--logos">
                  <div class="logos-wrapper">
                    <div class="container">
                      <div class="customers-logo">
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                        <div class="logo-item-wrap">
                          <div class="logo-item"></div>
                        </div>
                      </div>

                      <script type="rocketlazyloadscript">
                        const allImageUrls = ["https:\/\/websima.com\/wp-content\/uploads\/2025\/06\/hermeslogo.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/06\/mylogo.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/04\/hera.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/04\/Logo.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/04\/image-2.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/03\/iso9001lg.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/03\/Mask-group.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/03\/zarrin-logo.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/03\/pakrokh-logo.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/Dr-Alikhani-logo.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/Frame-173-1.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/laleh-logo3.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/fullt.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/Group.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/008bd2ff.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/logo-green-1.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/Company-sms.ir_-1.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/Group-1502-1.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/danaenergy.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/Group-1000007023.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/Group-1000007062.svg","https:\/\/websima.com\/wp-content\/uploads\/2025\/02\/Group-1000006830.svg","https:\/\/websima.com\/wp-content\/uploads\/2024\/12\/Group-1000006992.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/12\/Group-3-1.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/12\/Group-1000006993.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/12\/gamot.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/12\/Vector-8.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/12\/Vector-7.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/12\/Vector.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/11\/Group-1000006986.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/12\/Group-50.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/11\/Group-1000006831.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/11\/Group-1000006990.webp","https:\/\/websima.com\/wp-content\/uploads\/2024\/11\/Group-1000006988.png","https:\/\/websima.com\/wp-content\/uploads\/2024\/11\/Layer_1.webp"];
          </script>

                    </div>
                  </div>
                  <div class="container">
                    <div class="customer-counter-wrapper">
                      <div class="customer-counter-top">
                        <div class="customer-counter-text text">
                          <div class="number counter-wrapper"> <i>+</i><b class="customer__number" data-num="700">700</b>
                          </div>
                          <span class="counter__subtitle" data-ensplitting>Happy Customer</span>
                        </div>
                        <div class="title counter__titleimg">
                          <img width="381" height="88"
                            src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20381%2088'%3E%3C/svg%3E"
                            class="attachment-full size-full" alt="" decoding="async"
                            data-lazy-src="https://websima.com/wp-content/uploads/2024/08/title-customer.svg" /><noscript><img
                              width="381" height="88" src="https://websima.com/wp-content/uploads/2024/08/title-customer.svg"
                              class="attachment-full size-full" alt="" decoding="async" /></noscript> </div>
                      </div>
                      <div class="logo counter__logo">
                        <img alt="websima logo" width="55" height="55"
                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2055%2055'%3E%3C/svg%3E"
                          data-lazy-src="https://websima.com/wp-content/themes/websima/assets/img/logos/logo-dark-br.svg"><noscript><img
                            alt="websima logo" width="55" height="55"
                            src="https://websima.com/wp-content/themes/websima/assets/img/logos/logo-dark-br.svg"></noscript>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <canvas id="wave_canvas_e87011cc" class="wbswave wave--portfolio" resize="true" data-wave="type2"
                data-style="type2" data-bg="#ffffff"></canvas>
            </section> -->
            <section class="section section--ceo is-wave current-wtype1 is-wave-prev bg--white">

                <div class="section-wrapper ceo">
                    <div class="container">
                        <div class="ceo-wrapper">
                            <div class="ceo--text">

                                <div class="ceo__typography typography">
                                    <noscript><img width="1000" height="315"
                                                   src="https://websima.com/wp-content/uploads/2024/08/title-ceo.svg"
                                                   class="attachment-full size-full" alt="" decoding="async"/>
                                    </noscript>
                                </div>
                                <div class="ceo--titles">
                                    <h2 data-ensplitting class="ceo--title__en">SOMAYEH JAHANGIRI</h2>
                                    <p data-ensplitting class="ceo--subtitle__en sub">CEO at Rayapardazasn business
                                        studio</p>
                                </div>
                                <div class="ceo__desc">
                                    <div class="editor-content">
                                        <div class="dad65929">
                                            <div class="f9bf7997 d7dc56a8 c05b5566">
                                                <div class="ds-markdown ds-markdown--block">
                                                    <p>همه مسئولیت‌ها را به ما محول کنید، تا با تکیه بر دانش روز و
                                                        تجربه‌های ارزشمند، گام‌های موثر
                                                        و پایداری در مسیر تحول و توسعه دیجیتال کسب‌وکار شما برداریم.
                                                        رایاپردازان با ارائه راهکارهای
                                                        نوین در طراحی وب‌سایت و استراتژی‌های هدفمند و بهینه‌، همراهی
                                                        مطمئن برای رشد و تعالی برند
                                                        شماست. باور داریم که هر پروژه، فرصتی برای خلق ارزشی ماندگار و
                                                        اثری بی‌نظیر در دنیای دیجیتال
                                                        است. ما همه چیز را به نفع شما متحول می‌کنیم!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ceo--img">
                                <img width="1259" height="1888"
                                     src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201259%201888'%3E%3C/svg%3E"
                                     class="attachment-full size-full" alt="" decoding="async"
                                     data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Group-1000006435.webp"/>
                                <noscript><img
                                        width="1259" height="1888"
                                        src="https://websima.com/wp-content/uploads/2025/02/Group-1000006435.webp"
                                        class="attachment-full size-full" alt="" decoding="async"/></noscript>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- <div class="section section--team is-wave current-wtype1 is-wave-prev bg--primary">
              <div class="section-wrapper team">
                <div class="container">
                  <div class="team-wrapper">
                    <div class="team--imgs">
                      <div class="img-team-wrap teams-sm" id="img0">
                        <div class="img__team">
                          <div class="swiper sw--teams">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="846" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20846%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp" /><noscript><img
                                      width="846" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="831" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20831%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp" /><noscript><img
                                      width="831" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-md" id="img1">
                        <div class="img__team">
                          <div class="swiper sw--teams-md">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="280" height="344"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20280%20344'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp" /><noscript><img
                                      width="280" height="344"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-sm" id="img2">
                        <div class="img__team">
                          <div class="swiper sw--teams">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="846" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20846%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp" /><noscript><img
                                      width="846" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="831" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20831%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp" /><noscript><img
                                      width="831" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-sm" id="img3">
                        <div class="img__team">
                          <div class="swiper sw--teams">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="831" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20831%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp" /><noscript><img
                                      width="831" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="846" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20846%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp" /><noscript><img
                                      width="846" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-md" id="img4">
                        <div class="img__team">
                          <div class="swiper sw--teams-md">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="280" height="344"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20280%20344'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp" /><noscript><img
                                      width="280" height="344"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-sm" id="img5">
                        <div class="img__team">
                          <div class="swiper sw--teams">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="831" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20831%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp" /><noscript><img
                                      width="831" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="846" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20846%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp" /><noscript><img
                                      width="846" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-md" id="img6">
                        <div class="img__team">
                          <div class="swiper sw--teams-md">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="280" height="344"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20280%20344'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp" /><noscript><img
                                      width="280" height="344"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-sm" id="img7">
                        <div class="img__team">
                          <div class="swiper sw--teams">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="831" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20831%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp" /><noscript><img
                                      width="831" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="846" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20846%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp" /><noscript><img
                                      width="846" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-sm" id="img8">
                        <div class="img__team">
                          <div class="swiper sw--teams">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="831" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20831%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp" /><noscript><img
                                      width="831" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="846" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20846%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp" /><noscript><img
                                      width="846" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-md" id="img9">
                        <div class="img__team">
                          <div class="swiper sw--teams-md">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="280" height="344"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20280%20344'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp" /><noscript><img
                                      width="280" height="344"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-lg" id="img10">
                        <div class="img__team">
                          <div class="swiper sw--teams-lg">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007589.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007589.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007591.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007591.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007593.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007593.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007551.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007551.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007570.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007570.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007543.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007543.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007610.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007610.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-sm" id="img11">
                        <div class="img__team">
                          <div class="swiper sw--teams">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="831" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20831%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp" /><noscript><img
                                      width="831" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="846" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20846%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp" /><noscript><img
                                      width="846" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-sm" id="img12">
                        <div class="img__team">
                          <div class="swiper sw--teams">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="846" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20846%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp" /><noscript><img
                                      width="846" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="831" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20831%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp" /><noscript><img
                                      width="831" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-sm" id="img13">
                        <div class="img__team">
                          <div class="swiper sw--teams">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007568.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007565.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007564.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007563.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007557.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007554.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007553.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007540.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007607.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007609.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007620.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007618.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007559.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="846" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20846%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp" /><noscript><img
                                      width="846" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007548.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007544.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007583.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007581.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007579.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="831" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20831%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp" /><noscript><img
                                      width="831" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007578.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007574.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="img-team-wrap teams-md" id="img14">
                        <div class="img__team">
                          <div class="swiper sw--teams-md">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007582.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/05/Frame-1000007619.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007541.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007588.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="280" height="344"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20280%20344'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp" /><noscript><img
                                      width="280" height="344"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007566.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007571.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007545.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007556.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/02/Frame-1000007580.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                              <div class="swiper-slide">
                                <div class="img">
                                  <img width="840" height="1032"
                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20840%201032'%3E%3C/svg%3E"
                                    class="attachment-full size-full" alt="" decoding="async"
                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp" /><noscript><img
                                      width="840" height="1032"
                                      src="https://websima.com/wp-content/uploads/2025/04/Frame-1000007608.webp"
                                      class="attachment-full size-full" alt="" decoding="async" /></noscript></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="team--content">
                      <div class="team-imgtitle">
                        <img width="391" height="176"
                          src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20391%20176'%3E%3C/svg%3E"
                          class="attachment-full size-full" alt="" decoding="async"
                          data-lazy-src="https://websima.com/wp-content/uploads/2024/08/Frame-12oop.svg" /><noscript><img
                            width="391" height="176" src="https://websima.com/wp-content/uploads/2024/08/Frame-12oop.svg"
                            class="attachment-full size-full" alt="" decoding="async" /></noscript> </div>
                      <div class="editor-content team__editor">
                        <p class="p1" dir="rtl">ما در رایاپردازان یک تیم همدل و متحد هستیم که هدفمان خلق بهترین‌ها برای شماست،
                          فراتر از یک همکاری ساده؛خلق ارزشی پایدار و پویا! در رایاپردازان به دور از هرگونه تعصب در کنار هم
                          بهترین راهکارها را برای رشد و موفقیت دیجیتال شما خلق می‌کنیم<span class="s1">. </span>هدف رسیدن به
                          نتیجه است؛ اما نتیجه‌ای مطلوب که از همکاری مستمر، احترام متقابل و اشتراک گذاری دانش و تجربه‌ها به
                          دست آمده باشد<span class="s1">.</span></p>
                      </div>
                      <div class="reveal__frame4">
                        <a href="https://jobinja.ir/companies/websima/jobs" class="teams-btn">
                          <span class="teams-btn--badge">
                            <b class="num">1</b>
                            <div class="icon">
                              <i class="ic-user-heart"></i>
                            </div>
                          </span>
                          <div class="teams-btn--title">
                            <span class="en">Let’s Grow Together</span> <span class="fa">فرصت‌های همکاری</span> <span
                              class="subtitle">مقصد نهایی برای حرفه‌ای‌های بلندپرواز</span> </div>
                        </a>
                      </div>
                      <div class="reveal__frame5">
                        <div class="btns--box btns__team">
                          <a href="https://websima.com/team/" class="btn btn--primary-500" target="_self">
                            <div class="btn__text" data-text="معرفی تیم">
                              معرفی تیم </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <canvas id="wave_canvas_dd3c0a5a" class="wbswave wave--team" resize="true" data-wave="type1" data-style="type3"
                data-bg="#ffffff"></canvas>
            </div> -->
            <section data-wpr-lazyrender="1" class="section section--leap is-wave-prev bg--white last">

                <div class="section-wrapper leap pb-md">
                    <div class="container">
                        <div class="leap-wrapper">
                            <div class="leap--head heading--center heading-base">
                                <div class="leap-imgtitle">
                                    <img width="169" height="97"
                                         src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20169%2097'%3E%3C/svg%3E"
                                         class="attachment-full size-full" alt="" decoding="async"
                                         data-lazy-src="https://websima.com/wp-content/uploads/2024/08/Group-175400.svg"/>
                                    <noscript><img
                                            width="169" height="97"
                                            src="https://websima.com/wp-content/uploads/2024/08/Group-175400.svg"
                                            class="attachment-full size-full" alt="" decoding="async"/></noscript>
                                </div>
                                <p data-ensplitting class="en-title">Your Guide in the Digital World<br/>
                                    Powered by <b>RAYAPARDAZAN</b></p>
                                <p class="leap__subtitle  subtitle__text subtitle">ما در جهش، همیشه یک قدم جلوتر حرکت
                                    می‌کنیم تا مسیر
                                    رشد و تحول دیجیتال شما را هموارتر کنیم! اینجا جایی است که می‌توانید بینش عمیق‌تری
                                    درباره روندهای
                                    نوظهور، استراتژی‌های موفق و نوآوری‌های پیشرو به دست آورید.</p>
                            </div>
                            <div class="leap--categories">
                                <a href="https://websima.com/blog/" class="leap-cat">
                                    <i class="mask-leap__icon mask-ic-article"></i>
                                    <div class="leap-cat__entitle-wrap">
                                        <p class="leap-cat__entitle" data-title="Articles">Articles</p>
                                    </div>
                                    <p class="leap-cat__title">مقالات: دروازه‌ای به دانایی</p>
                                </a>
                                <a href="https://websima.com/blog/" class="leap-cat">
                                    <i class="mask-leap__icon mask-ic-broadcast"></i>
                                    <div class="leap-cat__entitle-wrap">
                                        <p class="leap-cat__entitle" data-title="BroadCasts">BroadCasts</p>
                                    </div>
                                    <p class="leap-cat__title">برادکست: کشف، یادگیری و الهام</p>
                                </a>
                                <a href="https://websima.com/blog/" class="leap-cat">
                                    <i class="mask-leap__icon mask-ic-article"></i>
                                    <div class="leap-cat__entitle-wrap">
                                        <p class="leap-cat__entitle" data-title="Whitepapers">Whitepapers</p>
                                    </div>
                                    <p class="leap-cat__title">دانش‌نامه: راهنمای حرفه‌ای‌ها</p>
                                </a>
                                <a href="https://websima.com/blog/" class="leap-cat">
                                    <i class="mask-leap__icon mask-ic-event"></i>
                                    <div class="leap-cat__entitle-wrap">
                                        <p class="leap-cat__entitle" data-title="Events">Events</p>
                                    </div>
                                    <p class="leap-cat__title">رویدادها: تجربه‌های زنده، دانش بی‌پایان</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script id="wave-colors">
                const waveColor1 = 'rgba(25,0,255,0.1)';
                const waveColor2 = 'rgba(205,108,88,0.4)';
                const waveColor3 = 'rgba(25,0,255,0.2)';
            </script>

        </main>
        <div id="ws-storys">
            <div class="story-container">
                <svg class="hidden-svg" width="0" height="0">
                    <clipPath id="story-container-bg" clipPathUnits="objectBoundingBox">
                        <path
                            d="M1,0.074 v0.854 c0,0.018,0,0.031,-0.002,0.041 c-0.002,0.01,-0.007,0.017,-0.016,0.022 c-0.009,0.005,-0.021,0.008,-0.039,0.009 c-0.018,0.001,-0.041,0.001,-0.072,0.001 h-0.74 c-0.031,0,-0.054,0,-0.072,-0.001 c-0.018,-0.001,-0.03,-0.004,-0.039,-0.009 c-0.009,-0.005,-0.014,-0.012,-0.016,-0.022 c-0.002,-0.01,-0.002,-0.023,-0.002,-0.041 v-0.854 c0,-0.018,0,-0.031,0.002,-0.041 c0.002,-0.01,0.007,-0.017,0.016,-0.022 c0.009,-0.005,0.021,-0.008,0.039,-0.009 c0.018,-0.001,0.041,-0.001,0.072,-0.001 h0.74 c0.031,0,0.054,0,0.072,0.001 c0.018,0.001,0.03,0.004,0.039,0.009 c0.009,0.005,0.014,0.012,0.016,0.022 c0.002,0.01,0.002,0.023,0.002,0.041">
                        </path>
                    </clipPath>
                </svg>
                <div class="story-wrapper">
                    <div class="story-progress">
                        <div class="story-progress__time time-display">0:00</div>
                        <div class="story-progress__bar progress-bar">
                            <div class="progress story-progress__fill"></div>
                        </div>
                        <button aria-label="close story" class="ws-storys-close close"><i class="ic-close"></i></button>
                    </div>
                    <div class="stroy-loading-overlay">
                        <div class="stroy-lds-ripple">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <video id="storyVideo" autoplay playsinline></video>
                    <div class="story-tools">
                        <button aria-label="Replay video" class="replay story-tools__replay"><i class="ic-replay"></i>
                        </button>
                        <a href="" class="btn extra-button story-tools__extra-button">
                            <div class="btn__text" data-text="">
                            </div>
                        </a>
                        <div class="controls story-tools__controls"></div>
                        <div class="end-controls story-tools-end">
                            <button class="btn btn--primary-400 request btn--ws-request story__request"
                                    aria-label="Request for advice">
                                <svg class="story__request-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                                    <path d="M4 5H3a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                    <path
                                        d="M17.385 4.585a2.1 2.1 0 0 0-2.97-2.97L6 10v3h3l8.385-8.415ZM13 3l3 3"></path>
                                </svg>
                                <span class="text btn__text" data-text=""></span>
                            </button>
                            <a href="" class="help story__help" rel="nofollow" target="_blank">
                                <div class="phone story__help-phone">
                                    <span class="phone-text" data-text="" dir="auto"></span>
                                    <svg class="story__phone-icon" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 2h4l2 5-2.5 1.5a11 11 0 0 0 5 5L13 11l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 1 4a2 2 0 0 1 2-2Z">
                                        </path>
                                        <path class="story__phone-icon-line  first" stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2" d="M13 5a2 2 0 0 1 2 2"></path>
                                        <path class="story__phone-icon-line second" stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2" d="M13 1a6 6 0 0 1 6 6"></path>
                                    </svg>
                                </div>
                                <span class="text story__phone-text"></span>
                            </a>
                        </div>
                    </div>
                    <button aria-label="first story" class="home-button"><i class="ic-home"></i></button>
                </div>
                <div class="story-wbs-badge">
                    <svg class="story-wbs-badge__icon" xmlns="http://www.w3.org/2000/svg" width="155" height="36"
                         fill="none"
                         viewBox="0 0 155 36">
                        <path fill="#fff"
                              d="M29.135 0a16 16 0 0 0-13.857 8.002l-1.152 1.996A16 16 0 0 1 .268 18a16 16 0 0 1 13.858 8.002l1.152 1.996A16 16 0 0 0 29.135 36h96.73a16 16 0 0 0 13.858-8.002l1.152-1.996A15.998 15.998 0 0 1 154.732 18c-5.717 0-11-3.05-13.857-8.002l-1.152-1.996A16.001 16.001 0 0 0 125.865 0h-96.73Z"/>
                    </svg>
                </div>
            </div>
        </div>

        <footer id="footer">
            <canvas id="footer-wave" resize></canvas>
            <div class="footer-wrapper">
                <div class="container">
                    <div class="footer__img">
                        <img width="316" height="160"
                             src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20316%20160'%3E%3C/svg%3E"
                             class="attachment-full size-full" alt="websima" decoding="async"
                             data-lazy-src="https://websima.com/wp-content/uploads/2024/08/Group-1677.svg"/>
                        <noscript><img width="316"
                                       height="160" src="https://websima.com/wp-content/uploads/2024/08/Group-1677.svg"
                                       class="attachment-full size-full" alt="websima" decoding="async"/></noscript>
                    </div>
                    <div class="footer--details">
                        <div class="footer-about">
                            <div class="editor-content footer__desc">
                                <p class="p1" dir="rtl">رایاپردازان، به عنوان یکی از ارزشمند‌ترین و معتبرترین برندها در
                                    فضای دیجیتال
                                    ایران، راهکارهای نوآورانه‌ای برای رشد و شکوفایی کسب‌وکارهای آنلاین خلق می‌کند<span
                                        class="s1">.
                  </span>ما با ترکیب استراتژی‌های دقیق و طراحی‌های بی‌نقص و بهینه‌، شما را در مسیر رسیدن به موفقیت‌های
                                    دیجیتال هدایت می‌کنیم<span class="s1">. </span>در دنیای رقابتی امروز، رایاپردازان
                                    انتخاب اول
                                    کسب‌وکارهایی است که می‌خواهند بهترین باشند<span class="s1">. </span>نتیجه مهم است!
                                </p>
                            </div>

                        </div>
                        <div class="footer-menu">
                            <p class="title">خدمات رایاپردازان</p>
                            <div class="menu-footer-menu-1-container">
                                <ul id="menu-footer-menu-1" class="footer__menu">
                                    <li id="menu-item-25105"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25105">
                                        <a
                                            href="https://websima.com/website-design/">طراحی وب‌سایت</a></li>
                                    <li id="menu-item-25104"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25104">
                                        <a
                                            href="https://websima.com/seo-digital-marketing/">سئو و بازاریابی
                                            دیجیتال</a></li>
                                    <li id="menu-item-25103"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25103">
                                        <a
                                            href="https://websima.com/digital-strategy/">استراتژی دیجیتال</a></li>
                                    <li id="menu-item-25135"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25135">
                                        <a
                                            href="https://websima.com/portfolios/">نمونه‌کار طراحی سایت</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-menu">
                            <p class="title">دسترسی آسان</p>
                            <div class="menu-footer-menu-2-container">
                                <ul id="menu-footer-menu-2" class="footer__menu">
                                    <li id="menu-item-25136"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25136">
                                        <a
                                            href="https://websima.com/blog/">جهش</a></li>
                                    <li id="menu-item-25106"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25106">
                                        <a
                                            href="https://websima.com/contact-us/">تماس با ما</a></li>
                                    <li id="menu-item-25107"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25107">
                                        <a
                                            href="https://websima.com/about-us/">درباره ما</a></li>
                                    <li id="menu-item-25108"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25108">
                                        <a
                                            href="https://websima.com/team/">معرفی تیم</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="footer-namads">
                            <div class="footer__named">
                                <div class="footer-named__img"><img width="31" height="29"
                                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2031%2029'%3E%3C/svg%3E"
                                                                    class="attachment-full size-full" alt=""
                                                                    decoding="async"
                                                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/01/336037ff.svg"/>
                                    <noscript><img
                                            width="31" height="29"
                                            src="https://websima.com/wp-content/uploads/2025/01/336037ff.svg"
                                            class="attachment-full size-full" alt="" decoding="async"/></noscript>
                                </div>
                                <p class="footer-named__title">دارای مجوز رسمی از نظام صنفی رایانه‌ای</p>
                            </div>
                            <div class="footer__named">
                                <div class="footer-named__img"><img width="37" height="38"
                                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2037%2038'%3E%3C/svg%3E"
                                                                    class="attachment-full size-full" alt=""
                                                                    decoding="async"
                                                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/01/Group-1000007035.svg"/>
                                    <noscript><img
                                            width="37" height="38"
                                            src="https://websima.com/wp-content/uploads/2025/01/Group-1000007035.svg"
                                            class="attachment-full size-full" alt="" decoding="async"/></noscript>
                                </div>
                                <p class="footer-named__title">عضو طلایی انجمن صنفی کسب‌وکارهای اینترنتی</p>
                            </div>
                            <div class="footer__named">
                                <div class="footer-named__img"><img width="37" height="27"
                                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2037%2027'%3E%3C/svg%3E"
                                                                    class="attachment-full size-full" alt=""
                                                                    decoding="async"
                                                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/01/Group-1000007036.svg"/>
                                    <noscript><img
                                            width="37" height="27"
                                            src="https://websima.com/wp-content/uploads/2025/01/Group-1000007036.svg"
                                            class="attachment-full size-full" alt="" decoding="async"/></noscript>
                                </div>
                                <p class="footer-named__title">دارای نماد اعتماد الکترونیکی</p>
                            </div>
                            <div class="footer__named">
                                <div class="footer-named__img"><img width="31" height="29"
                                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2031%2029'%3E%3C/svg%3E"
                                                                    class="attachment-full size-full" alt="شرکت خلاق"
                                                                    decoding="async"
                                                                    data-lazy-src="https://websima.com/wp-content/uploads/2025/02/khalagh.svg"/>
                                    <noscript><img
                                            width="31" height="29"
                                            src="https://websima.com/wp-content/uploads/2025/02/khalagh.svg"
                                            class="attachment-full size-full" alt="شرکت خلاق" decoding="async"/>
                                    </noscript>
                                </div>
                                <p class="footer-named__title">شرکت خلاق، معاونت دانش بنیان ریاست جمهوری</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="websima-logos">

                </div>
                <div class="container relative">
                    <div class="editor-content copyright-text"> © کلیه حقوق مادی و معنوی این اثر برای رایاپردازان محفوظ
                        است
                        و هرگونه کپی‌برداری پیگرد قانونی دارد.
                    </div>
                </div>
            </div>
            <canvas id="footer--bottom-wave" resize>
            </canvas>
        </footer>
        <div id="iland">
            <div class="iland-wrapper">
                <!-- <div class="iland-icta">
                  <div class="iland-icta__title">به راهنمایی نیاز دارید؟<i class="iland-icta__icon-title"></i></div>
                  <div class="iland-icta-circle">
                    <div class="icta-wave-wrapper">
                      <canvas id="iland-icta-wave" resize></canvas>
                    </div>
                    <div class="iland-icta__img">
                      <img width="750" height="592" src="https://websima.com/wp-content/uploads/2025/04/cover.jpg"
                        class="attachment-full size-full" alt="" decoding="async" /><video class="iland-icta__video" autoplay
                        playsinline loop muted>
                        <source src="https://websima.com/wp-content/uploads/2025/04/badgh1.mp4" type="video/mp4"></video> </div>
                  </div>
                </div> -->
                <div class="iland-cta">
                    <!-- <button aria-label="Request for advice" class="btn btn--primary-400 btn--ws-request iland__request">
                      <svg class="iland__request-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                        <path class="first" d="M4 5H3a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                        <path class="second" d="M17.385 4.585a2.1 2.1 0 0 0-2.97-2.97L6 10v3h3l8.385-8.415ZM13 3l3 3" />
                      </svg>
                      <div class="btn__text" data-text="ثبت درخواست مشاوره">
                        ثبت درخواست مشاوره
                      </div>
                      <i class="iland__request-curve">
                        <i class="iland__request-curve-line"></i>
                      </i>
                    </button> -->
                    <a class="btn btn--primary-500 iland__phone" target="_blank" rel="nofollow" href="tel:02178358"
                       dir="auto">
                        <svg class="iland__phone-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 2h4l2 5-2.5 1.5a11 11 0 0 0 5 5L13 11l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 1 4a2 2 0 0 1 2-2Z"/>
                            <path class="iland__phone-icon-line  first" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M13 5a2 2 0 0 1 2 2"/>
                            <path class="iland__phone-icon-line second" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M13 1a6 6 0 0 1 6 6"/>
                        </svg>
                        <div class="btn__text" data-text="021 78358">
                            021 78358
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div id="overlay"></div>
    </div>

    @include('layouts.app-navbar')
@endsection
