
  <div id="header" class="clearfix">
        <div id="logo-floater">
        <?php if ($logo || $site_name): ?>
          <?php if ($title): ?>
            <div id="branding"><strong><a href="<?php print $front_page ?>">
            <?php if ($logo): ?>
              <img src="<?php print $logo ?>" alt="<?php print $site_name ?>" title="<?php print $site_name ?>" id="logo" />
            <?php endif; ?>
            </a></strong></div>
          <?php else: /* Use h1 when the content title is empty */ ?>
            <h1 id="branding"><a href="<?php print $front_page ?>">
            <?php if ($logo): ?>
              <img src="<?php print $logo ?>" alt="<?php print $site_name ?>" title="<?php print $site_name ?>" id="logo" />
            <?php endif; ?>
            </a></h1>
        <?php endif; ?>
        <?php endif; ?>
    </div>

  </div>

  <div id="page">

    <?php if ($secondary_local_tasks): ?>
      <div class="tabs-secondary clearfix"><ul class="tabs secondary"><?php print render($secondary_local_tasks); ?></ul></div>
    <?php endif; ?>

    <table id="container" class="clearfix">
      <tbody>
      <tr>
      <?php if ($page['sidebar_first']): ?>
        <td id="sidebar-first" class="sidebar">
          <?php print render($page['sidebar_first']); ?>
        </td>
      <?php endif; ?>

        <td id="main-content-container">
          <?php print $breadcrumb; ?>
          <a id="main-content"></a>
          <?php print $messages; ?>
          <?php if ($tabs): ?><div id="tabs-wrapper" class="clearfix"><?php endif; ?>
          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
            <h1<?php print $tabs ? ' class="with-tabs"' : '' ?>><?php print $title ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>
          <?php if ($tabs): ?><?php print render($tabs); ?></div><?php endif; ?>
          <?php print render($tabs2); ?>
          <?php print render($page['help']); ?>
          <div class="clearfix">
            <?php print render($page['content']); ?>
          </div>
        </td>
      </tr>
      </tbody>
    </table>

    <div id="footer">
      <?php print $feed_icons; ?>
    </div>

  </div>
