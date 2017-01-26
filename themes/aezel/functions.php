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
    if (!$links) :
        $links = simple_pages_get_links_for_children_pages($page->parent_id);
    endif;

    $html="<ul class='simple-nav'>";
    foreach ($links as $link) :
        $html .= "<li><a href='".$link['uri']."'>".$link['label']."</a></li>";
    endforeach;
    $html .="</ul>";

    return $html;
}

function get_color()
{
    //colors: page id -> different css (production)
    $colors = array(
      "7" => array("kleur" => "groen", "logo" => "Tree_logo"),
      "8" => array("kleur" => "style.min", "logo" => "book_logo"),//default
      "9" => array("kleur" => "blauw", "logo" => "earth_logo"),
      "10" => array("kleur" => "oranje", "logo" => "clock_logo")
    );

    //get current page
    $current_page = get_current_record('simple_pages_page', false);

    if (!$current_page) :
        return $colors['8'];
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

    return $colors['8'];
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
