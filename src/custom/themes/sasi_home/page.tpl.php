
  <div id="header" class="clearfix">
    <div id="logo-floater">
        <div id="branding">
          <strong>
            <a href="<?php print $front_page ?>">
              <img src="<?php print $logo ?>" alt="<?php print $site_name ?>" title="<?php print $site_name ?>" id="logo" />
            </a>
          </strong>
          <div class="ssb_logo">
            <a href="http://www.nefsc.noaa.gov/read/socialsci/">
              <img class="ssb_icon" src="<?php print $ssb_icon?>"/>
            </a>
          </div>
        </div>
    </div>

  </div>

  <div id="page">

    <table id="container" class="clearfix">
      <?php print $breadcrumb; ?>
      <tbody>
      <tr>
      <?php if ($page['sidebar_first']): ?>
        <td id="sidebar-first" class="sidebar">
          <?php print render($page['sidebar_first']); ?>
        </td>
      <?php endif; ?>

        <td id="main-content-container">
          <a id="main-content"></a>
          <?php print $messages; ?>
          <?php if ($tabs): ?><div id="tabs-wrapper" class="clearfix"><?php endif; ?>
          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
            <h1<?php print $tabs ? ' class="with-tabs"' : '' ?>><?php print $title ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>
          <?php print render($primary_local_tasks); ?>
          <?php if ($secondary_local_tasks): ?>
            <div class="tabs-secondary clearfix"><ul class="tabs secondary"><?php print render($secondary_local_tasks); ?></ul></div>
          </div>
          <?php endif; ?>
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

     <!-- login div -->
    <div id="sasi-login" class="sasi-login">
      <?php if ($logged_in): ?>
        <a href="<?php print $base_path . 'user/logout';?>">Logout</a>
      <?php endif; ?>
      <?php if (! $logged_in):?>
        <a href="<?php print $base_path . 'user/login';?>">Login</a>
      <?php endif; ?>
    </div>

  </div>
