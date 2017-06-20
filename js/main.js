$( function() {
    $( "#slider-amount" ).slider({
      range: 'min',
      value:74000,
      min: 5000,
      max: 150000,
      step: 1000,
      slide: function( event, ui ) {
        //$( "#amount" ).val( "$" + ui.value );
        $("#amount").val("$" + ui.value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

      }
    });
   //$( "#amount" ).val( "$" + $( "#slider-amount" ).slider( "value" ) );
          $("#amount").val("$" + $("#slider-amount").slider("value").toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));


    $( "#slider-length" ).slider({
      range: 'min',
      value:13,
      min: 3,
      max: 24,
      step: 1,
      slide: function( event, ui ) {
        $( "#length" ).val( ui.value + " Months" );
      }
    });
    $( "#length" ).val($( "#slider-length" ).slider( "value" ) + " Months");
  } );

