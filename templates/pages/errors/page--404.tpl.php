<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see http://drupal.org/node/1728148
 */
?>

<div id="page" class="page-error">

  <header class="header" id="header" role="banner">

    <div class="fixed-width-container">
      <?php if ($logo): ?>
        <div  class="header--logo" id="logo">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header--logo-image" /></a>
        </div>
      <?php endif; ?>

      <?php if ($site_name): ?>
        <h1 class="header--site-name" id="site-name">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" class="header--site-link" rel="home"><span><?php print $site_name; ?></span></a>
        </h1>
      <?php endif; ?>

      <?php print render($page['header']); ?>

      <?php print render($page['top_search']); ?>

      <div id="navigation">

        <?php if ($main_menu): ?>
          <nav id="main-menu" role="navigation">
            <?php
            // This code snippet is hard to modify. We recommend turning off the
            // "Main menu" on your sub-theme's settings form, deleting this PHP
            // code block, and, instead, using the "Menu block" module.
            // @see http://drupal.org/project/menu_block
            print theme('links__system_main_menu', array(
              'links' => $main_menu,
              'attributes' => array(
                'class' => array('links', 'inline', 'clearfix'),
              ),
              'heading' => array(
                'text' => t('Main menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
              ),
            )); ?>
          </nav>
        <?php endif; ?>

      </div>

    </div>

  </header>

  <div id="main">

    <section id="content" class="column" role="main">
      <div class="content-header">
        <?php print render($page['highlighted']); ?>
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php print render($title_suffix); ?>
        <?php print $messages; ?>
        <?php print render($tabs); ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
      </div>
      <div class="content">
        <div class="error-text">
          <div class="error-text-inner">
            <div class="error-title-oops">OOPS!</div>
            <div class="error-title"><?php print t('NO ENCONTRAMOS LA PÁGINA QUE BUSCAS'); ?></div>
            <div class="error-title-small"><?php print t('¿Tal vez estabas buscando...?'); ?></div>
            <div><a href="/es"><?php print t('Los mejores planes y restaurantes de Canarias'); ?></a></div>
            <div><a href="/es"><?php print t('Lugares increíbles donde perderte'); ?></a></div>
            <div class="delimiter"><a href="/es"><?php print t('Pertenecer al club exclusivo de Discover para disfrutar de las mejores ofertas'); ?></a></div>
          </div>
        </div>
        <div class="error-searcher">
          <div class="error-searcher-inner">
            <span class="searcher-text"><?php print t('O puedes buscar lo que quieras'); ?></span>
            <?php print render($search_box_block); ?>
            <div class="contact-link"><?php print t('Si sigues con problemas'); ?>, <a href="content/contacto"><?php print t('contact with us'); ?></a></div>
          </div>
        </div>

      </div>
      <?php print $feed_icons; ?>
    </section>

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <aside class="sidebars">
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside>
    <?php endif; ?>

  </div>

  <?php print render($page['footer_social']); ?>
  <?php print render($page['footer']); ?>
  <?php print render($page['footer_second']); ?>
  <?php print render($page['footer_third']); ?>
  <?php print render($page['footer_menu']); ?>
  <?php print render($page['footer_banners']); ?>

</div>

<?php print render($page['bottom']); ?>
