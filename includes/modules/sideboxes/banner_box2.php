<?php
/**
 * banner_box2 sidebox - second box used to display "square" banners in sideboxes
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: banner_box2.php ajeh  Modified in v1.6.0 $
 */

// if no active banner in the specified banner group then the box will not show
if (SHOW_BANNERS_GROUP_SET8 != '') {
  $banner_box[] = TEXT_BANNER_BOX2;
  $banner_box_group= SHOW_BANNERS_GROUP_SET8;

  $banner = zen_banner_exists('dynamic', $banner_box_group);
  require($template->get_template_dir('tpl_banner_box2.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_banner_box2.php');

  if ($banner !== false) {
    $title =  BOX_HEADING_BANNER_BOX2;
    $title_link = false;
    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
  }
}
