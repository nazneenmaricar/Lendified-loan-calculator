<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php 
        	settings_fields('loan-calculator-settings-group'); 
        	echo "<div class='settings-group'>";
        	do_settings_sections('loan_amount_options');
        	echo "</div>";
        	do_settings_sections('loan_length_options');
        	submit_button('Save Settings');
        ?>
    </form>
</div>