<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->

    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>


    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,200' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora:400,400italic,700' rel='stylesheet' type='text/css'>    

    
    <!-- Stylesheets -->
    <?php
    queue_css_file(array('iconfonts','style'));
    queue_css_url('//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic');
    echo head_css();

    echo theme_header_background();
    ?>
      
    <!-- JavaScripts -->
    <?php 
    queue_js_file('bootstrap.min');
    echo head_js(); 
    ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
    
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
       
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

             <?php echo link_to_home_page(theme_logo().option('site_title'),array('class'=>'navbar-brand')); ?>
            </div>
           
        
        <!-- Collect the nav links, forms, and other content for toggling -->
          
            <div id="navbar" class="navbar-collapse collapse no-padding-left">
               <?php //echo public_nav_main(array('role' => 'navigation'))->setUlClass('nav navbar-nav');; ?>  
                <?php echo public_nav_main_bootstrap(); ?>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></i>
                    </button>
                </form>   
            </div><!-- /.navbar-collapse -->   
      </div><!-- /.container-fluid -->
    </nav>