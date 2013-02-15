<?php
function sasi_home_preprocess_page(&$vars) {
  $vars['ssb_icon'] = url(drupal_get_path('theme', 'sasi_home') . '/ssb_icon.png');
}
