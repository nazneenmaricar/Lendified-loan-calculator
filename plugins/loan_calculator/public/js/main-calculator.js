//Initializing slider

jQuery(document).ready(function($) {


  for(key in wp_ranges) {
    wp_ranges[key] = parseInt(wp_ranges[key]);
  }

 for(key in wp_rates) {
    wp_rates[key] = parseInt(wp_rates[key]);
  }

  //Initializing slider
  $("#slider-amount").slider({
    range: "min",
    value: wp_ranges.loanAmountDefault,
    min: wp_ranges.loanAmountMin,
    max: wp_ranges.loanAmountMax,
    step: wp_ranges.loanAmountStep,
    slide: function(event, ui) {
      $("#amount").val(formatCurrency(ui.value));
      displayBiWeeklyPayment(recalculate());
    },
    stop:  function() {
      animateBars();
      displayChartCosts(recalculate());
    }
  });
  $("#amount").val(formatCurrency($("#slider-amount").slider("value")));

  $("#slider-term").slider({
    range: "min",
    value: wp_ranges.loanTermDefault,
    min: wp_ranges.loanTermMin,
    max: wp_ranges.loanTermMax,
    step: wp_ranges.loanTermStep,
    slide: function(event, ui) {
      $("#term").val(ui.value + " months");
      displayBiWeeklyPayment(recalculate());
    },
    stop: function() {
      animateBars();
      displayChartCosts(recalculate());
    }
  });
  $("#term").val($("#slider-term").slider("value") + " months");

  //Chart animations

  function animateBarsUp() {
    $('.outer-bar-1').delay(100).animate({'height':'40%'},800);
    $('.outer-bar-2').delay(200).animate({'height': '70%'},800);
    $('.outer-bar-3').delay(300).animate({'height': '100%'},800);
    $('.hidden').delay(500).animate({'opacity': '1'},800);
    $('.lendified-price').delay(100).fadeIn(800);
    $('.comp-1-price').delay(200).fadeIn(800);
    $('.comp-2-price').delay(300).fadeIn(800);
  }

  function animateBars(paymentInformation) {
    $('.lendified-price').fadeOut(200).delay(100).fadeIn(800);
    $('.comp-1-price').fadeOut(200).delay(200).fadeIn(800);
    $('.comp-2-price').fadeOut(200).delay(300).fadeIn(800);
    $('.hidden').animate({'opacity': '0'},0).delay(500).animate({'opacity': '1'},800);
    $('.outer-bar-1').animate({'height': '0%'},200).delay(100).animate({'height': '40%'},800);
    $('.outer-bar-2').animate({'height': '0%'},200).delay(200).animate({'height': '70%'},800);
    $('.outer-bar-3').animate({'height': '0%'},200).delay(300).animate({'height': '100%'},800);
  }

  //Pop up
    // $( function() {
    //   $( document ).tooltip();
    // } );
    $('.fa').tooltip().click(function(e) {
                        $(this).tooltip('toggle');
                    });

  //Loan class constructor
  var Loan = function Loan(amount, term) {
    this.amount = amount;
    this.term = term;
  }
  //LoanCalculator object with method to calculate payment
  var LoanCalculator = {
    calculatePayments: function (loan, interest) {
      var discountFactor = this._getDiscountFactor(interest, loan.term)
      //can't divide by 0
      if (discountFactor != 0) {
        var result = loan.amount / discountFactor;
        return result;
      } else {
        return NaN
      }
    },
    calculateInterestCost: function (loan, interest) {
      var biweeklyPayment = this.calculatePayments(loan, interest);
      var interestCost = biweeklyPayment * 26 *(loan.term/12) - loan.amount;
      return interestCost;
    },
    // private function
    _getDiscountFactor: function (interest, term) {
      var i = interest/(26*100);
      var n = (26*term)/12;
      var numerator = Math.pow((1 + i), n) - 1;
      var demoninator = i * Math.pow((1 + i), n);
      var discountFactor = numerator/demoninator;
      return discountFactor;
    }
  }

  // client application - new instance of loan and calculations with diffrent interests
  function recalculate() {
    var amountValue = jQuery("#slider-amount").slider("value");
    var termValue = jQuery("#slider-term").slider("value");
    var paymentInformation = getPaymentInformation(amountValue, termValue);
    //paymentInformation.inspect();
    return paymentInformation;
  }

  //wp_rates object stores interest rates entered through admin
  function getPaymentInformation(amountValue, termValue) {
    var paymentInformation = {};
    var loan = new Loan(amountValue, termValue);
    paymentInformation.minimumPaymentAmount = LoanCalculator.calculatePayments(loan, wp_rates.interestMin);
    paymentInformation.maximumPaymentAmount = LoanCalculator.calculatePayments(loan, wp_rates.interestMax);
    //interest cost calculations
    paymentInformation.barOneInterestCost = LoanCalculator.calculateInterestCost(loan, wp_rates.barOneInterest);
    paymentInformation.barTwoInterestCost = LoanCalculator.calculateInterestCost(loan, wp_rates.barTwoInterest);
    paymentInformation.barThreeInterestCost = LoanCalculator.calculateInterestCost(loan, wp_rates.barThreeInterest);
    paymentInformation.interestSavings = paymentInformation.barThreeInterestCost - paymentInformation.barOneInterestCost;

    paymentInformation.inspect = function() {
      console.log(this);
    }
    return paymentInformation;
  }

  function displayPaymentAndCost(paymentInformation) {
    displayBiWeeklyPayment(paymentInformation);
    displayChartCosts(paymentInformation);
  }

  function displayBiWeeklyPayment(paymentInformation) {
    jQuery("#minimum-payment").html(formatCurrency(paymentInformation.minimumPaymentAmount));
    jQuery("#maximum-payment").html(formatCurrency(paymentInformation.maximumPaymentAmount));
  }

  function displayChartCosts(paymentInformation) {
    jQuery("#amount-saved").html(formatCurrency(paymentInformation.interestSavings));
    jQuery("#bar-one-cost").html(formatCurrency(paymentInformation.barOneInterestCost));
    jQuery("#bar-two-cost").html(formatCurrency(paymentInformation.barTwoInterestCost));
    jQuery("#bar-three-cost").html(formatCurrency(paymentInformation.barThreeInterestCost));
  }

  function formatCurrency(amount) {
    var symbol = "$";
    var formattedAmount = Math.round(amount).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    return symbol + formattedAmount;
  }

//replace interest_savings placeholder with calsulated value

function replaceIterestSavingPlaceholder() {
  $('#chart_heading').each(function() {
    var text = $(this).text();
    $(this).html(text.replace('[%interest_saving%]', '<span id="amount-saved" class="text-green-media"></span>'));
  $('#chart_heading').show();
  });
}

//On page load
  replaceIterestSavingPlaceholder();
  displayPaymentAndCost(recalculate());
  animateBarsUp();

});
