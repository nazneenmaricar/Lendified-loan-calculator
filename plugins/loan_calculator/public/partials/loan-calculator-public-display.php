<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://redacademy.com/
 * @since      1.0.0
 *
 * @package    Loan_Calculator
 * @subpackage Loan_Calculator/public/partials
 */
?>
<?php


$option = get_option('bwp_interest_min');

if (!isset($option) || empty($option)) {
  if(is_user_logged_in()) {
    ?>
<div class="calculator-warning">
  <p>The plugin is not configured. Please visit the <a href="<?php echo admin_url().'?page=loan_calculator'; ?>">admin</a> section.</p>
</div>
<?php
  }

} else {?>


  <!-- This file should primarily consist of HTML with a little bit of PHP. -->

  <!-- HTML FOR THE PLUGIN -->
  <div class="cal-plugin flex-media dir-row-media just-cont-btw-media">
    <section class="payment flex-media dir-col-media just-cont-cent just-cont-btw-media">

      <div>
        <label for="amount"><?php echo get_option('amount_label'); ?></label>
        <input type="text" id="amount" readonly>
        <div id="slider-amount"></div>
      </div>

      <div>
        <label for="term"><?php echo get_option('term_label'); ?>
          <span role="tooltip" class="fa fa-question-circle-o" aria-hidden="true" title="<?php echo get_option('term_popup'); ?>"></span> </label>
        <input type="text" id="term" class="no-border" readonly>
        <div id="slider-term"></div>
      </div>

      <div>
        <label for="total-loan-amount"><?php echo get_option('payment_label'); ?>   <span role="tooltip" class="fa fa-question-circle-o" aria-hidden="true" title="<?php echo get_option('payment_popup'); ?>"></span> </label>

        <p> <span id="minimum-payment"></span> -  <span id="maximum-payment"></span> </p>
        <a href="<?php echo get_option('button_link'); ?>" class="button button-display"><?php echo get_option('button_label'); ?></a>
      </div>
    </section>

    <section class="bar-graph flex-media dir-col-media just-cont-btw-media">
        <h3 class="text-green text-black-media" id="chart_heading"><?php echo get_option('chart_heading'); ?></h3>

      <div class="outer-graph">
        <div class="inner-graph">

          <div class="outer-bar-1 flex dir-col">
            <div class="bar-1-title">
              <?php
                if (strtolower(get_option('bar_1_label')) == 'lendified') {
                  echo "<img class='hidden title-p' src='".plugin_dir_url('')."loan_calculator/public/assets/lendified-logo.png'>";
                } else {
                    echo "<p class='hidden title-p'>".get_option('bar_1_label')."</p>";
                }
              ?>
            </div>
            <div class="bar-1-column">
              <p class="column-p lendified-price" id="bar-one-cost"></p>
            </div>
            </div>

            <div class="outer-bar-2 flex dir-col">
              <div class="bar-2-title">
                <p class="hidden title-p"><?php echo get_option('bar_2_label'); ?></p>
              </div>
              <div class="bar-2-column">
                <p class="column-p comp-1-price" id="bar-two-cost"></p>
              </div>
            </div>

            <div class="outer-bar-3 flex dir-col">
              <div class="bar-3-title">
                <p class="hidden title-p"><?php echo get_option('bar_3_label'); ?></p>
              </div>
              <div class="bar-3-column">
                <p class="column-p comp-2-price" id="bar-three-cost"></p>
              </div>
           </div>

        </div>
      </div>

      <h6><?php echo get_option('chart_label'); ?> <span role="tooltip" class="fa fa-question-circle-o" aria-hidden="true" title="<?php echo get_option('chart_popup'); ?>"></span> </h6>

      <a href="<?php echo get_option('button_link'); ?>" class="button button-display-bottom"><?php echo get_option('button_label'); ?></a>

    </section>

  </div>

<?php
};?>
