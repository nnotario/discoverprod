<?php
/**
 * @file
 * Zen theme's implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   - view-mode-[mode]: The view mode, e.g. 'full', 'teaser'...
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $pubdate: Formatted date and time for when the node was published wrapped
 *   in a HTML5 time element.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content. Currently broken; see http://drupal.org/node/823380
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess_node()
 * @see template_process()
 */
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($unpublished): ?>
        <p class="unpublished"><?php print t('Unpublished'); ?></p>
      <?php endif; ?>
    </header>
  <?php endif; ?>

  <?php // dsm($content); ?>

  <div class="flexslider-area">
    <?php print render($content['field_image_collection']); ?>
    <?php print render($content['extrafield_addthis']); ?>
    <div class="badges">
      <?php print render($content['field_recommendation_discover']); ?>
      <?php print render($content['extrafield_voting_general']); ?>
    </div>
    <div class="flag-links">
      <?php print flag_create_link('i_want_to_go', $node->nid); ?>
      <?php print flag_create_link('i_have_been_there', $node->nid); ?>
      <?php print flag_create_link('bookmarks', $node->nid); ?>
    </div>
  </div>

  <?php if (isset($content['extrafield_community_tags']) || isset($content['field_coordinates']) || isset($content['field_text_address'])): ?>
    <div class="voting-and-map">
      <?php print render($content['extrafield_community_tags']); ?>
      <?php print render($content['field_coordinates']); ?>
      <?php print render($content['field_text_address']); ?>
    </div>
  <?php endif; ?>

  <div class="column-content">
    <div class="column-price-author">
      <?php print render($content['field_average_price']); ?>
      <?php print render($content['field_average_offer']); ?>
      <div class="submitted">
        <div class="submitted-label"><?php print t('Publication by'); ?></div>
        <?php print $user_picture; ?>
        <?php print $name; ?>
      </div>
    </div>
    <div class="column-node-body">
      <h2 class="node-subtitle"><?php print render($content['field_subtitle']); ?></h2>
      <?php print render($content['body']); ?>

      <?php if (isset($content['field_schedule']) || isset($content['field_timetable_text'])): ?>
        <div class="time-schedule">
          <?php print render($content['field_schedule']); ?>
          <?php print render($content['field_timetable_text']); ?>
        </div>
      <?php endif; ?>

      <div class="column-additional-info">
        <?php if (isset($content['field_cuisine_types'])): ?>
          <div class="column-additional-first"><?php print render($content['field_cuisine_types']); ?></div>
        <?php endif; ?>

        <?php if (isset($content['field_services'])): ?>
          <div class="column-additional-middle"><?php print render($content['field_services']); ?></div>
        <?php endif; ?>

        <?php if (isset($content['extrafield_wrong_info'])): ?>
          <div class="column-wrong-info"><?php print render($content['extrafield_wrong_info']); ?></div>
        <?php endif; ?>
      </div>
    </div>

  </div>

  <div class="column-node-right">
    <?php print render($region['node_right']); ?>
  </div>

  <div class="node-bottom">
    <?php
      // We hide the comments and links now so that we can render them later.
      // hide($content['comments']);
      // hide($content['links']);
      // print render($content);
    ?>
  </div>

</article><!-- /.node -->