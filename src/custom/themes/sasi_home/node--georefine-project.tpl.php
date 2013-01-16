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
      <iframe src="<?php print $georefine_project_url ?>" style="width: 100%; height: 800px;">
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
