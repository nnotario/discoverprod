<?php
/*
 * Renders extra field for Community tags
 *
 * Variables:
 *
 * $node - node object of Drupal
 * $results - contains info about each tag
 *      key is tid of term
 *      value is array of title and value for this tag
 */
?>

<?php if(!empty($results)): ?>
<div class="<?php print $classes; ?>">
    <div class="title">
        <h3 class="title">
            <?php print t('Ideal for...'); ?>
        </h3>
    </div>
    <div class="axis-results">
    <?php $counter = 0;
      foreach($results as $key => $res){ ?>
      <?php if($counter>2 && $counter%3==0): ?>
      <div class="hidden">
      <?php endif; ?>
      <div class="axis-item">
          <div class="axis-item-title">
             <?php print $results[$key]['title']; ?>
          </div>
          <div class="axis-item-value">
              <div class="meter">
                  <span style="width:<?php print $results[$key]['value']; ?>%"></span>
                  <span class="poll-icon"></span>
              </div>
          </div>
      </div>
      <?php if($counter>2 && ($counter%3==2 || $counter==count($results)-1)): ?>
      </div> <!-- end hidden -->
      <?php endif; ?>
    <?php
      $counter++;
      } ?>
    </div>

    <span class="comment-link">
        <span class="comment-link-title">
          <?php print t('Did you go?'); ?>
        </span>
        <?php if ($node->comment == COMMENT_NODE_OPEN && user_access('post comments',$user)) {
            print l(t('Opinion'),"comment/reply/$node->nid",array(
                'attributes' => array(
                  'class' => 'comment-vote',
                  'title' => t('Add a new comment.')
                ),
                'fragment' => 'comment-form',
            ));
        } ?>
    </span>
</div>
<?php endif; ?>
