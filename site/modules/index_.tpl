<!DOCTYPE html>
<html>
  <head>
    
      ~~include file="tpl/head.tpl"~

  </head>
  <body>
    <section id="ext_menu-0" data-rv-view="0">

      <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

          <div class="mbr-table">
            <div class="mbr-table-cell">

              <div class="navbar-brand">
                <a href="/" class="navbar-logo"><img src="/img/logo.svg" alt=""></a>
                <a class="navbar-caption" href="/">рекламно-
                <br>
                производственная
                <br>
                компания
                <br>
                </a>
              </div>

            </div>
            <div class="mbr-table-cell">

              <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                <div class="hamburger-icon"></div>
              </button>

              <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                ~~foreach from=$pages item=p~
                ~~if $p.alias=='portfolio'~
                <li class="nav-item dropdown" >
                  <a href="/~~$p.alias~/" nowrap class="nav-link link dropdown-toggle" data-toggle="dropdown-submenu" aria-expanded="false" >~~$p.name~</a>
                  <div class="dropdown-menu">
                    ~~foreach from=$categories item=cat~
                    <a class="dropdown-item" href="/~~$cat.alias~/">~~$cat.name~</a>
                    ~~/foreach~
                  </div>
                </li>
                ~~else~
                <li class="nav-item" >
                  <a class="nav-link link" href="/~~$p.alias~/" nowrap>~~$p.name~</a>
                </li>
                ~~/if~
                ~~/foreach~

              </ul>

              <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                <div class="close-icon"></div>
              </button>

            </div>
          </div>

        </div>
      </nav>

    </section>





    <section class="mbr-section mbr-after-navbar" id="msg-box5-1" data-rv-view="2" style="background-color: rgb(249, 115, 82); padding-top: 120px; padding-bottom: 40px;">

      <div class="container">
        <div class="row">
          <div class="mbr-table-md-up">

            <div class="mbr-table-cell col-md-5 text-xs-center text-md-right content-size">
              <h4 class="mbr-section-title display-2">
              <div style="font-size: 26px;">
                РЕКЛАМНЫЕ КОНСТРУКЦИИ
              </div></h4>
              <div class="lead">

                <p>
                  профессиональный, комплексный подход к созданию качественных рекламных конструкций
                </p>

              </div>

              <div>
                <a class="btn btn-black" href="/">Заказать обратный звонок</a>
              </div>
            </div>

            <div class="mbr-table-cell mbr-left-padding-md-up mbr-valign-top col-md-7 image-size" style="width: 64%;">
              <div class="mbr-figure"><img src="/assets/images/buk-900x300.jpg">
              </div>
            </div>

          </div>
        </div>
      </div>

    </section>

    <section class="mbr-gallery mbr-section mbr-section-nopadding mbr-slider-carousel" data-filter="false" id="gallery3-6" data-rv-view="5" style="background-color: rgb(0, 0, 0); padding-top: 1.5rem; padding-bottom: 1.5rem;">
      <!-- Filter -->

      <!-- Gallery -->
      <div class="mbr-gallery-row container">
        <div class=" mbr-gallery-layout-default">
          <div>
            <div>

              ~~foreach from=$categories item=cat~
              <div class="mbr-gallery-item mbr-gallery-item__mobirise3 mbr-gallery-item--p1" data-video-url="false" data-tags="Animated" >

                <div href="#lb-gallery3-6" data-slide-to="0" data-toggle="modal">

                  <img src="~~$cat.img~" alt="">

                  <span class="icon-focus"></span>
                  <span class="mbr-gallery-title" ><a href="/~~$cat.alias~/">~~$cat.name~</a></span>
                </div>
              </div>
              ~~/foreach~

            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <!-- Lightbox -->
      <div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery3-6">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <ol class="carousel-indicators">
                <li data-app-prevent-settings="" data-target="#lb-gallery3-6" data-slide-to="0"></li>
                <li data-app-prevent-settings="" data-target="#lb-gallery3-6" data-slide-to="1"></li>
                <li data-app-prevent-settings="" data-target="#lb-gallery3-6" data-slide-to="2"></li>
                <li data-app-prevent-settings="" data-target="#lb-gallery3-6" data-slide-to="3"></li>
                <li data-app-prevent-settings="" data-target="#lb-gallery3-6" data-slide-to="4"></li>
                <li data-app-prevent-settings="" data-target="#lb-gallery3-6" class=" active" data-slide-to="5"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item">
                  <img src="/assets/images/vives-250x200.jpg" alt="">
                </div>
                <div class="arousel-item">
                  <img src="/assets/images/ob-250x200.jpg" alt="">
                </div>
                <div class="carousel-item">
                  <img src="/assets/images/kor-250x200.jpg" alt="">
                </div>
                <div class="carousel-item">
                  <img src="/assets/images/table-250x200.jpg" alt="">
                </div>
                <div class="carousel-item">
                  <img src="/assets/images/infst-250x200.jpg" alt="">
                </div>
                <div class="carousel-item active">
                  <img src="/assets/images/log-250x200.jpg" alt="">
                </div>
              </div>
              <a class="left carousel-control" role="button" data-slide="prev" href="#lb-gallery3-6"> <span class="icon-prev" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
              <a class="right carousel-control" role="button" data-slide="next" href="#lb-gallery3-6"> <span class="icon-next" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>

              <a class="close" href="#" role="button" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close</span> </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-4" data-rv-view="32" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 90px;">

        ~~include file="tpl/footer.tpl"~

    </section>

    ~~include file="tpl/assets.tpl"~

    <input name="animation" type="hidden">
  </body>
</html>