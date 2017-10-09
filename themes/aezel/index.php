<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <section class="kijker">
                <div class="col-sm-8">
                    <div class="carousel-wrap">
                        <div data-ride="carousel" class="carousel slide" id="myCarousel">
                          <!-- Indicators -->
                          <!--<ol class="carousel-indicators">
                            <li class="" data-slide-to="0" data-target="#myCarousel"></li>
                            <li data-slide-to="1" data-target="#myCarousel" class="active"></li>
                          </ol>-->
                          <div role="listbox" class="carousel-inner">
                              <?php echo libis_get_featured_exhibits();?>
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
        <h3  class="ontdek"><span>Aezel websites</span></h3>
        <div class="row icons">
          <a target="_blank" role="button" href="http://www.aezel.eu/genealogie">
            <div class="col-sm-3 icon-block">
                <div class="well wie">
                    <h2><span class="icon-title"><img class="logo" src="<?php echo img("logos/Tree_logo.png");?>"><span>Wie</span></span></h2>
                    <h1>Aezel Genealogisch</h1>
                    <p class="lees-meer">
                      <span>Naar site</span>
                    </p>
                </div>
            </div>
          </a>
          <a target="_blank" role="button" href="http://www.aezel.eu/erfgoed">
            <div class="col-sm-3 icon-block">
                <div class="well wat">
                    <h2><span class="icon-title"><img class="logo" src="<?php echo img("logos/book_logo.png");?>"><span>Wat</span></span></h2>
                    <h1>Aezel<br> Erfgoed</h1>
                    <p class="lees-meer">
                        <span>Naar site</span>
                    </p>
                </div>
            </div>
          </a>
          <a target="_blank" role="button" href="http://www.aezel.eu/geo/thema/eigenaars/eigenaars.php">
            <div class="col-sm-3 icon-block">
                <div class="well waar">
                    <h2><span class="icon-title"><img class="logo" src="<?php echo img("logos/earth_logo.png");?>"><span>Waar</span></span></h2>
                    <h1>Aezel Geografisch</h1>
                    <p class="lees-meer">
                        <span>Naar site</span>
                    </p>
                </div>
            </div>
          </a>
          <a target="_blank" role="button" href="http://www.aezel.eu/aezel/solr-search?q=&facet=itemtype:%22Kaart+historie%22">
            <div class="col-sm-3 icon-block">
                <div class="well wanneer">
                    <h2><span class="icon-title"><img class="logo" src="<?php echo img("logos/clock_logo.png");?>"><span>Wanneer</span></span></h2>
                    <h1>Aezel Historisch</h1>
                    <p class="lees-meer">
                        <span>Naar site</span>
                    </p>
                </div>
            </div>
          </a>
        </div>
    </div>
</section>
<div class="container content-wrapper bs-docs-section ">
    <div class="row">
        <div class="col-sm-5">
            <section class="intro">
            <H3><span>Over ons</span></h3>

              <?php if ($homepageText = get_theme_option('Homepage Text')): ?>
                  <p><?php echo $homepageText; ?></p>
              <?php endif; ?>

            <p class="lees-meer"><a  href="<?php echo url('over'); ?>" role="button">Lees meer</a></p>
            </section>
        </div>

        <div class="col-sm-7">
            <section class='nieuws'>
                <h3><span>Nieuws</span></h3>
                  <?php
                    echo libis_get_news();
                  ?>
                  <p class="meer-nieuws"><a href='<?php echo url('/solr-search?q=&facet=itemtype:"Nieuws"');?>'>Meer nieuws</a></p>
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
