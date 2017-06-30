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
	register_setting( 'loan-calculator-settings-group', 'term_popup');
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
		'Loan Amount Slider',
		'loan_amount_content',
		'loan_amounts'
	);

	// Loan length settings section
	add_settings_section(
		'loan-term-options',
		'Loan Term Slider',
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
function create_month_field ($id, $label) {
	$val = esc_attr( get_option($id) );
	echo "
		<div class='flex flex-align-center flex-space-between flex-col-tablet flex-align-start-tablet'>
			<label class='sub-label required-label' for='".$id."'>".$label."</label>
			<div class='flex flex-5 flex-align-center'>
				<input class='flex-initial' type='number' step='any' name='".$id."' value='".$val."' required/>
				<p class='month'>months</p>
			</div>
		</div>
	";
}

function create_money_field ($id, $label) {
	$val = esc_attr( get_option($id) );
	echo "
		<div class='flex flex-align-center flex-space-between flex-col-tablet flex-align-start-tablet'>
			<label class='sub-label required-label' for='".$id."'>".$label."</label>
			<div class='flex flex-align-center'>
				<p class='money-symbol'>$</p>
				<input type='number' step='any' name='".$id."' value='".$val."' required/>
			</div>
		</div>
	";
}

function create_percent_field ($id, $label) {
	$val = esc_attr( get_option($id) );
	echo "
		<div class='flex flex-align-center flex-space-between'>
			<label class='sub-label required-label' for='".$id."'>".$label."</label>
			<input class='flex-4' type='number' step='any' name='".$id."' value='".$val."' required/>
			<p class='percent-symbol'>%</p>
		</div>
	";
}

function create_text_field ($id, $label) {
	$val = esc_attr( get_option($id) );
	echo "
		<div class='flex flex-align-center flex-col-mobile flex-align-start-mobile flex-space-between'>
			<label class='sub-label' for='".$id."'>".$label."</label>
			<input type='text' name='".$id."' value='".$val."'>
		</div>
	";
}

function create_text_number_field ($option_label, $text_label, $number_label, $text_id, $number_id) {
	$text_val = esc_attr( get_option($text_id) );
	$number_val = esc_attr( get_option($number_id) );
	echo "
		<div class='flex flex-align-center flex-space-between flex-col-tablet flex-align-start-tablet'>
			<p class='padding-right-lrg flex-1'>".$option_label."</p>
			<div class='flex-10 flex flex-align-center flex-col-tablet flex-align-start-tablet'>
				<label class='sub-label' for='".$text_id."'>".$text_label."</label>
				<input type='text' name='".$text_id."' value='".$text_val."' class='margin-right-xs'/>
				<div class='flex flex-align-center flex-col-tablet flex-align-start-tablet'>
					<label class='sub-label required-label' for='".$number_id."'>".$number_label."</label>
					<div class='flex'>
						<input type='number' class='percent-symbol' step='any' name='".$number_id."' value='".$number_val."' required/>
						<p class='percent-symbol'>%</p>
					</div>
				</div>
			</div>
		</div>
	";
}

function create_text_area ($id, $label) {
	$text_val = esc_attr( get_option($id) );
	echo "
		<div class='flex flex-space-between flex-col-mobile flex-align-start-mobile'>
			<label class='sub-label' for='".$id."'>".$label."</label>
			<textarea name='".$id."' rows='4' cols='50'>".$text_val."</textarea>
		</div>
	";
}

function create_double_text_field ($text_1_label, $text_1_id, $text_2_label, $text_2_id) {
	$text_1_val = esc_attr( get_option($text_1_id) );
	$text_2_val = esc_attr( get_option($text_2_id) );
	echo "
		<div class='flex flex-align-center flex-space-between'>
			<div>
				<label for='".$text_1_id."'>".$text_1_label."</label>
				<input type='number' step='any' name='".$text_1_id."' value='".$text_1_val."' required/>
			</div>
			<div>
				<label for='".$text_2_id."'>".$text_2_label."</label>
				<input type='number' step='any' name='".$text_2_id."' value='".$text_2_val."' required/>
			</div>
		</div>
	";
}

// Loan Amount HTML function
function loan_amount_content() {
	echo "<p class='bold'>Enter your loan amount range here.</p>";

	create_money_field('loan_amount_min', 'Min');
	create_money_field('loan_amount_max', 'Max');
	create_money_field('loan_amount_step', 'Step');
	create_money_field('loan_amount_default', 'Default');
}

// Loan term HTML function
function loan_terms_content() {
	echo "<p class='bold'>Enter your loan term range here.</p>";
  	create_month_field('loan_term_min', 'Min');
	create_month_field('loan_term_max', 'Max');
	create_month_field('loan_term_step', 'Step');
	create_month_field('loan_term_default', 'Default');
}

// Loan interest HTML function
function interest_content() {
	echo "<p class='bold'>Bi-Weekly Payment Calculation</p>";
	create_percent_field('bwp_interest_min','Min Interest');
	create_percent_field('bwp_interest_max','Max Interest');

	echo "<p class='bold'>Chart Calculations</p>";

	create_text_number_field('Bar 1:', 'Label', 'Interest', 'bar_1_label', 'bar_1_interest');
	create_text_number_field('Bar 2:', 'Label', 'Interest', 'bar_2_label', 'bar_2_interest');
	create_text_number_field('Bar 3:', 'Label', 'Interest', 'bar_3_label', 'bar_3_interest');
}

// Pop-up HTML function
function pop_up_content() {
	create_text_area ('term_popup', 'Loan Term Pop-Up');
	create_text_area ('payment_popup', 'Payment Pop-Up');
	create_text_area ('chart_popup', 'Chart Pop-Up');
}

// Label HTML function
function labels() {
	echo "<p class='bold'>Enter your labels here.</p>";
	create_text_field('amount_label', 'Loan Amount');
	create_text_field('term_label', 'Term Length');
	create_text_field('payment_label', 'Bi-Weekly Pop-Up');
	create_text_field('button_label', 'Button');
	$text_val = esc_attr( get_option('chart_heading') );
	echo "
		<div class='flex flex-space-between flex-col-mobile'>
			<div class='flex flex-col flex-row-mobile flex-2 sub-label padding-none-mobile flex-wrap-mobile'>
				<label class='flex-initial width-50-mobile padding-none-mobile' for='chart_heading'>Chart Heading</label>
				<p class='instructions width-50-mobile padding-none-mobile'>Click insert to add savings amount at curser position.</p>
				<input class='flex-initial' type='button' id='amount_placeholder' value='Insert' />
			</div>
			<div class='flex-5'>
				<textarea id='txt' class='flex-initial' name='chart_heading' rows='4' cols='50'>".$text_val."</textarea>
			</div>
		</div>
	";
	create_text_field('chart_label', 'Chart Label');
}

function links() {
	create_text_field('button_link', 'Button Link');
}

?>
