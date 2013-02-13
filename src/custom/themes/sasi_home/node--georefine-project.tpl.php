<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if (! $status): ?>
    <div class="node-status messages warning">
      Warning: This page is currently unpublished and is not visible to general visitors. To publish the page, click the 'edit' tab and look for 'publishing options' near the bottom of the page.
    </div>
  <?php endif; ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      print render($content);
    ?>
    <div class="georefine">
      <?php if (isset($georefine_project_url)): ?>
      <button id="fullscreenButton" style="display:none;">Fullscreen</button>
      <iframe id="clientFrame" style="width: 100%; height: 800px;" webkitAllowFullScreen mozAllowFullScreen allowFullScreen>
      </iframe>
      <?php endif; ?>
    </div>
  </div>


  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <div class="links"><?php print render($content['links']); ?></div>
    <?php endif; ?>

    <?php print render($content['comments']); ?>
  </div>

</div>

<script>
var hash = window.location.hash;
var $clientFrame = jQuery('#clientFrame');
var projectUrl = "<?php print $georefine_project_url ?>#";
projectUrl += '/shareLinkUrlTemplate=' +  encodeURIComponent(window.location.origin + window.location.pathname + '#/stateKey={{STATE_KEY}}/') + '/';
var stateKeyMatch;
if (stateKeyMatch = new RegExp('/stateKey=(.*)/').exec(hash)){
  projectUrl += stateKeyMatch[0];
}
$clientFrame.attr('src', projectUrl);
</script>

<script>
/*
 jquery.fullscreen 1.1.4
 https://github.com/kayahr/jquery-fullscreen-plugin
 Copyright (C) 2012 Klaus Reimer <k@ailis.de>
 Licensed under the MIT license
 (See http://www.opensource.org/licenses/mit-license)
*/
function d(b){var c,a;if(!this.length)return this;c=this[0];c.ownerDocument?a=c.ownerDocument:(a=c,c=a.documentElement);if(null==b){if(!a.cancelFullScreen&&!a.webkitCancelFullScreen&&!a.mozCancelFullScreen)return null;b=!!a.fullScreen||!!a.webkitIsFullScreen||!!a.mozFullScreen;return!b?b:a.fullScreenElement||a.webkitCurrentFullScreenElement||a.mozFullScreenElement||b}b?(b=c.requestFullScreen||c.webkitRequestFullScreen||c.mozRequestFullScreen)&&(Element.ALLOW_KEYBOARD_INPUT?b.call(c,Element.ALLOW_KEYBOARD_INPUT):
b.call(c)):(b=a.cancelFullScreen||a.webkitCancelFullScreen||a.mozCancelFullScreen)&&b.call(a);return this}jQuery.fn.fullScreen=d;jQuery.fn.toggleFullScreen=function(){return d.call(this,!d.call(this))};var e,f,g;e=document;e.webkitCancelFullScreen?(f="webkitfullscreenchange",g="webkitfullscreenerror"):e.mozCancelFullScreen?(f="mozfullscreenchange",g="mozfullscreenerror"):(f="fullscreenchange",g="fullscreenerror");jQuery(document).bind(f,function(){jQuery(document).trigger(new jQuery.Event("fullscreenchange"))});
jQuery(document).bind(g,function(){jQuery(document).trigger(new jQuery.Event("fullscreenerror"))});


var browser = jQuery.browser;
var $fsButton = jQuery('#fullscreenButton');
if (browser.webkit || browser.chrome || browser.mozilla){
  $fsButton.css('display', 'block');
  $fsButton.on('click', function(){
    jQuery('#clientFrame').fullScreen(true);
  });
}
</script>
