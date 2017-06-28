<?php

add_action('admin_init', 'loan_calculator_settings');

function loan_calculator_settings() {

	// Settings for loan amount
	register_setting( 'loan-calculator-settings-group', 'loan_amount_min');
	register_setting( 'loan-calculator-settings-group', 'loan_amount_max');
	register_setting( 'loan-calculator-settings-group', 'loan_amount_step');
	register_setting( 'loan-calculator-settings-group', 'loan_amount_default');

	// Settings for term length
	register_setting( 'loan-calculator-settings-group', 'loan_term_min');
	register_setting( 'loan-calculator-settings-group', 'loan_term_max');
	register_setting( 'loan-calculator-settings-group', 'loan_term_step');
	register_setting( 'loan-calculator-settings-group', 'loan_term_default');


	// Settings for interest rates
	register_setting( 'loan-calculator-settings-group', 'bwp_interest_min');
	register_setting( 'loan-calculator-settings-group', 'bwp_interest_max');
	register_setting( 'loan-calculator-settings-group', 'lendified_interest');
	register_setting( 'loan-calculator-settings-group', 'bar_1_interest');
	register_setting( 'loan-calculator-settings-group', 'bar_2_interest');
	register_setting( 'loan-calculator-settings-group', 'bar_3_interest');
	register_setting( 'loan-calculator-settings-group', 'bar_1_label');
	register_setting( 'loan-calculator-settings-group', 'bar_2_label');
	register_setting( 'loan-calculator-settings-group', 'bar_3_label');

	// Settings for pop-ups
	register_setting( 'loan-calculator-settings-group', 'payment_popup');
	register_setting( 'loan-calculator-settings-group', 'chart_popup');

	// Settings for labels
	register_setting( 'loan-calculator-settings-group', 'amount_label');
	register_setting( 'loan-calculator-settings-group', 'term_label');
	register_setting( 'loan-calculator-settings-group', 'payment_label');
	register_setting( 'loan-calculator-settings-group', 'button_label');
	register_setting( 'loan-calculator-settings-group', 'chart_heading');
	register_setting( 'loan-calculator-settings-group', 'chart_label');

	// Misc
	register_setting( 'loan-calculator-settings-group', 'button_link');


	// Loan amount settings section
	add_settings_section(
		'loan-amount-options',
		'Loan Amount Range',
		'loan_amount_content',
		'loan_amounts'
	);

	// Loan length settings section
	add_settings_section(
		'loan-term-options',
		'Loan Term Range',
		'loan_terms_content',
		'loan_terms'
	);

	// Interest Rates Section
	add_settings_section(
		'interest-rates',
		'Interest Rates',
		'interest_content',
		'interest_rates'
	);

	// Pop-up settings
	add_settings_section(
		'pop-up-content',
		'Pop-Up Content',
		'pop_up_content',
		'pop_ups'
	);

	add_settings_section(
		'labels',
		'Labels',
		'labels',
		'labels'
	);

	add_settings_section(
		'links',
		'Links',
		'links',
		'links'
	);

}

//Functions for html admin input models
function create_number_field ($id, $label) {
	$val = esc_attr( get_option($id) );
	echo "<div class='flex flex-align-center flex-space-between'>";
	echo "<label class='sub-label' for='".$id."'>".$label."</label>";
	echo "<input type='number' step='any' name='".$id."' value='".$val."'/>";
	echo "</div>";
}
function create_text_field ($id, $label) {
	$val = esc_attr( get_option($id) );
	echo "<div class='flex flex-align-center flex-space-between'>";
	echo "<label class='sub-label' for='".$id."'>".$label."</label>";
	echo "<input type='text' name='".$id."' value='".$val."'>";
	echo "</div>";
}

function create_text_number_field ($option_label, $text_label, $number_label, $text_id, $number_id) {
	$text_val = esc_attr( get_option($text_id) );
	$number_val = esc_attr( get_option($number_id) );
	echo "<div class='flex flex-align-center flex-space-between'>";
	echo "<p class='padding-right-lrg'>".$option_label."</p>";
	echo "<div class='flex flex-align-center'>";
	echo "<label class='sub-label' for='".$text_id."'>".$text_label."</label>";
	echo "<input type='text' name='".$text_id."' value='".$text_val."' class='margin-right-sm'/>";
	echo "<label class='sub-label' for='".$number_id."'>".$number_label."</label>";
	echo "<input type='number' step='any' name='".$number_id."' value='".$number_val."'/>".' '."%";
	echo "</div>";
	echo "</div>";
}

function create_text_area ($id, $label) {
	echo "<div class='flex flex-space-between'>";
	echo "<label class='sub-label' for='".$id."'>".$label."</label>";
	$text_val = esc_attr( get_option($id) );
	echo "<textarea name='".$id."' rows='4' cols='50'>".$text_val."</textarea>";
	echo "</div>";
}

// Loan Amount HTML function
function loan_amount_content() {
	echo "<p class='bold'>Enter your loan amount range here.</p>";

	create_number_field('loan_amount_min', 'Min');
	create_number_field('loan_amount_max', 'Max');
	create_number_field('loan_amount_step', 'Step');
	create_number_field('loan_amount_default', 'Default');

	// $loan_amount_min = esc_attr( get_option('loan_amount_min') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label for='loan_amount_min'>Min</label>";
	// echo "<input type='number' name='loan_amount_min' value='".$loan_amount_min."'/>";
	// echo "</div>";

	// $loan_amount_max = esc_attr( get_option('loan_amount_max') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label for='loan_amount_max'>Max</label>";
	// echo "<input type='number' name='loan_amount_max' value='".$loan_amount_max."'/>";
	// echo "</div>";

	// $loan_amount_step = esc_attr( get_option('loan_amount_step') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label for='loan_amount_step'>Step</label>";
	// echo "<input type='number' name='loan_amount_step' value='".$loan_amount_step."'/>";
	// echo "</div>";

	// $loan_amount_default = esc_attr( get_option('loan_amount_default') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label for='loan_amount_default'>Default</label>";
	// echo "<input type='number' name='loan_amount_default' value='".$loan_amount_default."'/>";
	// echo "</div>";

}

// Loan term HTML function
function loan_terms_content() {

	echo "<p class='bold'>Enter your loan term range here.</p>";

  	create_number_field('loan_term_min', 'Min');
	create_number_field('loan_term_max', 'Max');
	create_number_field('loan_term_step', 'Step');
	create_number_field('loan_term_default', 'Default');

	// $loan_term_min = esc_attr( get_option('loan_term_min') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label for='loan_term_min'>Min</label>";
	// echo "<input type='number' class='term-input' name='loan_term_min' value='".$loan_term_min."'/>";
	// echo "</div>";


	// $loan_term_max = esc_attr( get_option('loan_term_max') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label for='loan_term_max'>Max</label>";
	// echo "<input type='number' class='term-input'  name='loan_term_max' value='".$loan_term_max."'/>";
	// echo "</div>";

	// $loan_term_step = esc_attr( get_option('loan_term_step') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label for='loan_term_step'>Step</label>";
	// echo "<input type='number' class='term-input' name='loan_term_step' value='".$loan_term_step."'/>";
	// echo "</div>";

	// $loan_term_default = esc_attr( get_option('loan_term_default') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label for='loan_term_default'>Default</label>";
	// echo "<input type='number' class='term-input'  name='loan_term_default' value='".$loan_term_default."'/>";
	// echo "</div>";
}

// Loan interest HTML function
function interest_content() {

	echo "<p class='bold'>Bi-Weekly Payment Calculation</p>";

	$interest_rate_min = esc_attr( get_option('bwp_interest_min') );
	echo "<div class='flex flex-align-center'>";
	echo "<label for='bwp_interest_min'>Min</label>";
	echo "<input type='number' step='any' name='bwp_interest_min' value='".$interest_rate_min."'/>";
	echo "</div>";

	$interest_rate_max = esc_attr( get_option('bwp_interest_max') );
	echo "<div class='flex flex-align-center'>";
	echo "<label for='bwp_interest_max'>Max</label>";
	echo "<input type='number' step='any' name='bwp_interest_max' value='".$interest_rate_max."'/>";
	echo "</div>";

	echo "<p class='bold'>Chart Calculation</p>";

	create_text_number_field('Bar 1:', 'Label', 'Interest', 'bar_1_label', 'bar_1_interest');
	create_text_number_field('Bar 2:', 'Label', 'Interest', 'bar_2_label', 'bar_2_interest');
	create_text_number_field('Bar 3:', 'Label', 'Interest', 'bar_3_label', 'bar_3_interest');

	// $bar_1_label = esc_attr( get_option('bar_1_label') );
	// $bar_1_interest = esc_attr( get_option('bar_1_interest') );

	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<p class='padding-right-lrg'>Bar 1:</p>";
	// echo "<div class='flex flex-align-center'>";
	// echo "<label class='sub-label' for='bar_1_label'>Label</label>";
	// echo "<input type='text' name='bar_1_label' value='".$bar_1_label."' class='margin-right-sm'/>";
	// echo "<label class='sub-label' for='bar_1_interest'>Interest</label>";
	// echo "<input type='number' step='any' name='bar_1_interest' value='".$bar_1_interest."'/> %";
	// echo "</div>";
	// echo "</div>";

	// $bar_2_label = esc_attr( get_option('bar_2_label') );
	// $bar_2_interest = esc_attr( get_option('bar_2_interest') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<p class='padding-right-lrg'>Bar 2:</p>";
	// echo "<div class='flex flex-align-center'>";
	// echo "<label class='sub-label' for='bar_2_label'>Label</label>";
	// echo "<input type='text' name='bar_2_label' value='".$bar_2_label."' class='margin-right-sm'/>";
	// echo "<label class='sub-label' for='bar_2_interest'>Interest</label>";
	// echo "<input type='number' step='any' name='bar_2_interest' value='".$bar_2_interest."'/>  %";
	// echo "</div>";
	// echo "</div>";

	// $bar_3_label = esc_attr( get_option('bar_3_label') );
	// $bar_3_interest = esc_attr( get_option('bar_3_interest') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<p class='padding-right-lrg'>Bar 3:</p>";
	// echo "<div class='flex flex-align-center'>";
	// echo "<label class='sub-label' for='bar_3_label'>Label</label>";
	// echo "<input type='text' name='bar_3_label' value='".$bar_3_label."' class='margin-right-sm'/>";
	// echo "<label class='sub-label' for='bar_3_interest'>Interest</label>";
	// echo "<input type='number' step='any' name='bar_3_interest' value='".$bar_3_interest."'/> %";
	// echo "</div>";
	// echo "</div>";
}

// Pop-up HTML function
function pop_up_content() {
	create_text_area ('payment_popup', 'Payment Pop-Up');
	create_text_area ('chart_popup', 'Chart Pop-Up');

	// echo "<p>Payment Pop-Up Content</p>";
	// $pop_up_1_content = esc_attr( get_option('payment_popup') );
	// echo "<textarea name='payment_popup' rows='4' cols='50'>".$pop_up_1_content."</textarea>";

	// echo "<p>Chart Pop-Up Content</p>";
	// $pop_up_2_content = esc_attr( get_option('pop_up_2') );
	// echo "<textarea name='payment' rows='4' cols='50'>".$pop_up_2_content."</textarea>";
}

// Label HTML function
function labels() {

	echo "<p class='bold'>Enter your labels here.</p>";

	create_text_field('amount_label', 'Loan Amount');
	create_text_field('term_label', 'Term Length');
	create_text_field('payment_label', 'Bi-Weekly Pop-Up');
	create_text_field('button_label', 'Button');
	// create_text_area('chart_heading', 'Chart Heading');

	$text_val = esc_attr( get_option('chart_heading') );
	echo "<div class='flex flex-space-between'>";
	echo "<label class='sub-label' for='chart_heading'>Chart Heading</label>";
	echo "<textarea name='chart_heading' rows='4'>".$text_val."</textarea>";
	echo "</div>";

	// $chart_heading = esc_attr( get_option('chart_heading') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label class='sub-label' for='chart_heading'>Chart Heading</label>";
	// echo "<input type='button' id='amount_placeholder' value='Insert' />";
	// echo "<input type='text' name='chart_heading' value='".$chart_heading."'>";
	// echo "</div>";

	create_text_field('chart_label', 'Chart Label');

	// $amount_label = esc_attr( get_option('amount_label') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label class='sub-label' for='amount_label'>Loan Amount</label>";
	// echo "<input type='text' name='amount_label' value='".$amount_label."'>";
	// echo "</div>";

	// $term_label = esc_attr( get_option('term_label') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label class='sub-label' for='term_label'>Term Length</label>";
	// echo "<input type='text' name='term_label' value='".$term_label."'>";
	// echo "</div>";

	// $payment_label = esc_attr( get_option('payment_label') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label class='sub-label' for='payment_label'>Bi-Weekly Pop-Up</label>";
	// echo "<input type='text' name='payment_label' value='".$payment_label."'>";
	// echo "</div>";

	// $button_label = esc_attr( get_option('button_label') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label class='sub-label' for='button_label'>Button</label>";
	// echo "<input type='text' name='button_label' value='".$button_label."'>";
	// echo "</div>";

	// $chart_heading = esc_attr( get_option('chart_heading') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label class='sub-label' for='chart_heading'>Chart Heading</label>";
	// echo "<input type='text' name='chart_heading' value='".$chart_heading."'>";
	// echo "</div>";

	// $chart_label = esc_attr( get_option('chart_label') );
	// echo "<div class='flex flex-align-center flex-space-between'>";
	// echo "<label class='sub-label' for='chart_label'>Chart Label</label>";
	// echo "<input type='text' name='chart_label' value='".$chart_label."'>";
	// echo "</div>";
}

function links() {
	create_text_field('button_link', 'Button Link');
}

?>
