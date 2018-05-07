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
                           
                        </div>

            </div>
            <div class="mbr-table-cell">

              <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                <div class="hamburger-icon"></div>
              </button>

                      <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                        ~~foreach from=$pages item=p~
                        ~~if $p.alias=='catalog'~ 
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
                        <li class="nav-item" >
                          <a class="nav-link link" href="tel:+74956652357" nowrap style="color:#F1C050!important;"> 8 (495) 665-23-57</a>
                        </li>
                        <li class="nav-item" >
                          <a class="nav-link link" href="mailto:info@art-rif.ru" nowrap style="color:#F1C050!important;"> info@art-rif.ru</a> 
                        </li>
                      </ul>

              <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                <div class="close-icon"></div>
              </button>

            </div>
          </div>

        </div>
      </nav>

    </section>

~~*debug*~

    <section class="mbr-section article mbr-parallax-background mbr-after-navbar" id="msg-box8-h" data-rv-view="520" style="background-image: url(~~$categories[$p_index].head_img~); padding-top: 160px; padding-bottom: 40px;">

        <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(34, 34, 34);">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-xs-center" style='color:white;'>
                    <h3 class="mbr-section-title display-2">~~$pages[$p_index].name~</h3>
                   
                </div>
            </div>
        </div>

    </section>


      ~~$pages[$p_index].content~


    <section class="mbr-section form1" id="form1-l" data-rv-view="529" style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 120px;">
        
        <div class="mbr-section mbr-section__container mbr-section__container--middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-xs-center">
                        <h3 class="mbr-section-title display-2">Напишите нам</h3>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-section mbr-section-nopadding">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">


                        <div data-form-alert="true">
                            <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">Спасибо</div>
                        </div>


                        <form action="/" method="post" data-form-title="Напишите нам">

                            <input type="hidden" value="true" name="send_msg" data-form-email="true">

                            <div class="row row-sm-offset">

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="form1-l-name">Имя<span class="form-asterisk">*</span></label>
                                        <input type="text" class="form-control" name="name" required="" data-form-field="Name" id="form1-l-name">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="form1-l-email">Email</label>
                                        <input type="email" class="form-control" name="email"data-form-field="Email" id="form1-l-email">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="form1-l-phone">Телефон<span class="form-asterisk">*</span></label>
                                        <input type="tel" class="form-control" name="phone" required=""  data-form-field="Phone" id="form1-l-phone">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="form1-l-message">Ваш вопрос</label>
                                <textarea class="form-control" name="message" rows="7" data-form-field="Message" id="form1-l-message"></textarea>
                            </div>

                            <div><button type="submit" class="btn btn-primary">Отправить</button></div>

                        </form>
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
              <div class="mbr-gallery-item mbr-gallery-item__mobirise3 mbr-gallery-item--p1" data-video-url="false" data-tags="Animated" style='margin-top:40px;'>

                <div href="#lb-gallery3-6" >

                  ~~*<img src="~~$cat.img~" alt="">

                  <span class="icon-focus"></span>*~
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