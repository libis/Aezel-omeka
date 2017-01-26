<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <section class="kijker">
                <div class="col-sm-8">
                    <div class="carousel-wrap">
                        <div data-ride="carousel" class="carousel slide" id="myCarousel">
                          <!-- Indicators -->
                          <ol class="carousel-indicators">
                            <li class="" data-slide-to="0" data-target="#myCarousel"></li>
                            <li data-slide-to="1" data-target="#myCarousel" class="active"></li>
                          </ol>
                          <div role="listbox" class="carousel-inner">
                              <div class="carousel-item">
                                <img alt="First slide" src="<?php echo img('bg6.png');?>" class="first-slide">
                                <div class="carousel-caption">
                                  <H3><span>In de kijker</span></h3>
                                  <h1>Titel volgend verhaal</h1>
                                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                  <p class="caption-auteur">Door: <strong>Tester</strong></p>
                                </div>
                            </div>
                            <div class="carousel-item active">
                              <img alt="Third slide" src="<?php echo img('bg5.jpg');?>" class="third-slide">
                                <div class="carousel-caption">
                                   <H3><span>In de kijker</span></h3>
                                  <h1>Titel verhaal</h1>
                                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                  <p class="caption-auteur">Door: <strong>Tester2</strong></p>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div id="right" class="col-sm-4">
                    <div class="well"></div>
                </div>
           </section>
       </div>
    </div>
</div>

<section class='section-icons'>   <!-- Content -->
    <div class="container content-wrapper bs-docs-section ">
        <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
        <h3  class="ontdek"><span>Onze projecten</span></h3>
        <div class="row icons">
            <div class="col-sm-3 icon-block">
                <div class="well wie">
                    <h2><span class="icon-title"><img class="logo" src="<?php echo img("logos/Tree_logo.png");?>"><span>Wie</span></span></h2>
                    <h1>Genealogische Databank</h1>
                    <p class="lees-meer">
                        <a role="button" href="<?php echo url('wie');?>">Lees Meer</a>
                    </p>
                </div>
            </div>
            <div class="col-sm-3 icon-block">
                <div class="well wat">
                    <h2><span class="icon-title"><img class="logo" src="<?php echo img("logos/book_logo.png");?>"><span>Wat</span></span></h2>
                    <h1>Erfgoed websites</h1>
                    <p class="lees-meer">
                        <a role="button" href="<?php echo url('wat');?>">Lees Meer</a>
                    </p>
                </div>
            </div>
            <div class="col-sm-3 icon-block">
                <div class="well waar">
                    <h2><span class="icon-title"><img class="logo" src="<?php echo img("logos/earth_logo.png");?>"><span>Waar</span></span></h2>
                    <h1>Geografisch kaartenbestand</h1>
                    <p class="lees-meer">
                        <a role="button" href="<?php echo url('waar');?>">Lees Meer</a>
                    </p>
                </div>
            </div>
            <div class="col-sm-3 icon-block">
                <div class="well wanneer">
                    <h2><span class="icon-title"><img class="logo" src="<?php echo img("logos/clock_logo.png");?>"><span>Wanneer</span></span></h2>
                    <h1>Staatskundige geschiedenis</h1>
                    <p class="lees-meer">
                        <a role="button" href="<?php echo url('wanneer');?>">Lees Meer</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container content-wrapper bs-docs-section ">
    <div class="row">
        <div class="col-sm-5">
            <section class="intro">
            <H3><span>Over ons</span></h3>
            <h1>bewoners en bewoningsgeschiedenis</h1>
            <!--<img src="<?php echo img("roermond.jpg");?>">
            <p class="caption">Markt Roermond 19xx</p>-->

            <p>Het <b>Aezel Projek</b>, ofwel “Archief voor Erfgoed van Zuid-Nederlandse Eigendommen en Leefgemeenschappen”, heeft tot doel de versnipperde erfgoed-informatie in Zuid Nederland te digitaliseren, te bundelen en voor het brede publiek beschikbaar te stellen via het internet.</p>
            <p class="lees-meer"><a  href="<?php echo url('over'); ?>" role="button">Lees meer</a></p>
            </section>
        </div>

        <div class="col-sm-7">
            <section class='nieuws'>
                <h3><span>Nieuws</span></h3>

                    <?php
                      echo libis_get_news();
                    ?>
                    <p><a href="">Meer nieuws</a></p>
            </section>
        </div>
    </div>
</div>
<script>
    jQuery('.carousel').carousel();
    var caption = jQuery('div.carousel-item:nth-child(1) .carousel-caption');
    jQuery('#right .well').html(caption.html());
    caption.css('display','none');
    jQuery(".carousel").on('slide.bs.carousel', function(evt) {
       var caption = jQuery('div.carousel-item:nth-child(' + (jQuery(evt.relatedTarget).index()+1) + ') .carousel-caption');
       jQuery('#right .well').html(caption.html());
       caption.css('display','none');
    });
</script>

<?php echo foot(); ?>
