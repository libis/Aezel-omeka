<?php
function public_nav_main_bootstrap()
{
    $partial = array('common/menu-partial.phtml', 'default');
    $nav = public_nav_main();  // this looks like $this->navigation()->menu() from Zend
    $nav->setPartial($partial);
    return $nav->render();
}

function simple_nav()
{
    $page = get_current_record('SimplePagesPage');

    $links = simple_pages_get_links_for_children_pages();
    if (!$links && $page->parent_id != "0") :
        $links = simple_pages_get_links_for_children_pages($page->parent_id);
    endif;

    if($page->title == 'Vrijwilligers' && !current_user()):
      $html="<ul class='simple-nav'>";
      $html .= "<li><a href='".url('/solr-search?q=&facet=itemtype:"Vrijwilligers"')."'>Onze Collectie</a></li>";
      $html .= "<li><a href='".url('/guest-user/user/login')."'>Inloggen</a></li>";
      $html .= "<li><a href='".url('/guest-user/user/register')."'>Registreren</a></li></ul>";
      return $html;
    endif;

    $html ="";

    switch ($page->id) {
        case "8":
            $linkx = url('/solr-search?q=&facet=itemtype:"Erfgoed+website"');
            break;
        case "9":
            $linkx = url('/solr-search?q=&facet=itemtype:"Kaart"');
            break;
        case "7":
            $linkx = url('/solr-search?q=&facet=itemtype:"Stamboom"');
            break;
        case "10":
            $linkx = url('/solr-search?q=&facet=itemtype:"Kaart+historie"');
            break;
        case "1":
            $linkx = url('/solr-search?q=&facet=itemtype:"Doel"');
            break;
        case "6":
            $linkx = url('/solr-search?q=&facet=itemtype:"Projecten"');
            break;
        case "12":
            $linkx = url('/solr-search?q=&facet=itemtype:"Aezel"');
            break;
        case "13":
            $linkx = url('/solr-search?q=&facet=itemtype:"Hoe"');
            break;
        case "11":
            $linkx = url('/solr-search?q=&facet=itemtype:"Samenwerking"');
            break;
        case "25":
            $linkx = url('/solr-search?q=&facet=itemtype:"Info"');
            break;
        default:
            $linkx = false;
            $namex = false;
    }

    if($linkx):
        $html .= "<li><a href='".$linkx."'>Onze Collectie</a></li>";
    endif;

    if($page->id == 1){
        $html .= "<li><a href='".url('/solr-search?q=&facet=itemtype:"Nieuws"')."'>Nieuws</a></li>";
    }

    foreach ($links as $link) :
        $html .= "<li><a href='".$link['uri']."'>".$link['label']."</a></li>";
    endforeach;

    if($html):
      $html="<ul class='simple-nav'>".$html."</ul>";
    endif;

    return $html;
}

function get_color()
{
    //colors: page id -> different css (production)
    $colors = array(
      "0" => array("kleur" => "style.min", "logo" => "book_logo_a"),
      "7" => array("kleur" => "groen", "logo" => "Tree_logo"),
      "8" => array("kleur" => "rood", "logo" => "book_logo"),//default
      "9" => array("kleur" => "blauw", "logo" => "earth_logo"),
      "10" => array("kleur" => "oranje", "logo" => "clock_logo"),
      "54" => array("kleur" => "bruin", "logo" => "donkey_logo")
    );

    if (strpos(current_url(), '/users/') !== false ||
        strpos(current_url(), '/guest-user/') !== false
      ) {
      return $colors['54'];
    }

    //get current page
    $current_page = get_current_record('simple_pages_page', false);
    $current_item = get_current_record('item', false);

    if (!$current_page) :
        $color_facet="";$type="";
        if(isset($_GET['facet'])):
          $possible_facets= array('Stamboom', 'Kaart', 'Kaart historie', 'Erfgoed website');
          $current_facets = $_GET['facet'];

          foreach ($possible_facets as $possible_facet) {
              if (strpos($current_facets,$possible_facet) !== FALSE) {
                  $type = $possible_facet;
              }
          }
        endif;

        if($current_item):
            $type = metadata('item', 'Item Type Name');
        endif;

        switch ($type) {
            case 'Stamboom':
                return $colors['7'];
                break;
            case 'Kaart':
                return $colors['9'];
                break;
            case 'Kaart historie':
                return $colors['10'];
                break;
            case 'Erfgoed website':
                return $colors['8'];
                break;
            default:
                return $colors['0'];
        }

        return $colors['0'];
    endif;

    if (array_key_exists($current_page->id, $colors)) :
        return $colors[$current_page->id];
    endif;

    //determine ancestor
    $pageAncestors = get_db()->getTable('SimplePagesPage')->findAncestorPages($current_page->id);
    foreach ($pageAncestors as $page) :
        if (array_key_exists($page->id, $colors)) :
            return $colors[$page->id];
        endif;
    endforeach;

    return $colors['0'];
}

function libis_get_news($tag = "")
{
    $items = get_records('Item', array('type'=>'Nieuws','sort_field' => 'added', 'sort_dir' => 'd'), 3);
    if (!$items) : ?>
        <p>Er is geen recent nieuws.</p>
    <?php endif; ?>
    <?php foreach ($items as $item) :?>
      <div class="row nieuws-item">
        <?php if (metadata($item, 'has files')) : ?>
          <div class="col-sm-4 col-xs-12 icon-block">
            <div class="element-text"><?php echo files_for_item(array('imageSize' => 'thumbnail'), array(), $item); ?></div>
          </div>
          <div class="col-sm-8 icon-block">
        <?php else:?>
          <div class="col-sm-12 icon-block">
        <?php endif; ?>
          <h5><?php echo metadata($item, array('Dublin Core', 'Date')); ?></h5>
          <h4><?php echo metadata($item, array('Dublin Core', 'Title')); ?></h4>
          <p><?php echo metadata($item, array('Dublin Core', 'Description'), array('snippet'=>250)); ?></p>
          <p class="lees-meer"><?php echo link_to_item('Lees meer', array(), 'show', $item); ?></p>
        </div>
    </div>
    <?php endforeach;
}

function libis_get_featured_exhibits()
{
  $exhibits = get_records('Exhibit', array('sort_field' => 'added', 'sort_dir' => 'd'), 3);

  $i = 0;
  foreach($exhibits as $exhibit):?>
  <?php $file = $exhibit->getFile();?>
    <?php if ($file): ?>
      <div class="carousel-item <?php if($i == 0){ echo "active";} ?>">
        <img class="<?php if($i == 0){ echo "first-slide";} ?>" src="<?php echo $file->getWebPath(); ?>">
        <div class="carousel-caption">
          <H3><span>In de kijker</span></h3>
          <h1><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h1>
          <p><?php echo snippet_by_word_count(metadata($exhibit, 'description', array('no_escape' => true))); ?></p>
          <?php if($exhibit->credits):?>
            <p class="caption-auteur">Door: <strong><?php echo $exhibit->credits;?></strong></p>
          <?php endif;?>
        </div>
      </div>
      <?php $i++; ?>
    <?php endif; ?>
  <?php endforeach;
}
