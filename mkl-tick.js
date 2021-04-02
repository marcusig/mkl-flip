function mkl_tick_countdown(tick) {

	// uncomment to set labels to different language
	/*
	var locale = {
		YEAR_PLURAL: 'Jaren',
		YEAR_SINGULAR: 'Jaar',
		MONTH_PLURAL: 'Maanden',
		MONTH_SINGULAR: 'Maand',
		WEEK_PLURAL: 'Weken',
		WEEK_SINGULAR: 'Week',
		DAY_PLURAL: 'Dagen',
		DAY_SINGULAR: 'Dag',
		HOUR_PLURAL: 'Uren',
		HOUR_SINGULAR: 'Uur',
		MINUTE_PLURAL: 'Minuten',
		MINUTE_SINGULAR: 'Minuut',
		SECOND_PLURAL: 'Seconden',
		SECOND_SINGULAR: 'Seconde',
		MILLISECOND_PLURAL: 'Milliseconden',
		MILLISECOND_SINGULAR: 'Milliseconde'
	};

	for (var key in locale) {
		if (!locale.hasOwnProperty(key)) { continue; }
		tick.setConstant(key, locale[key]);
	}
	*/

	// format of due date is ISO8601
	// https://en.wikipedia.org/wiki/ISO_8601

	// '2018-01-31T12:00:00'        to count down to the 31st of January 2018 at 12 o'clock
	// '2019'                       to count down to 2019
	// '2018-01-15T10:00:00+01:00'  to count down to the 15th of January 2018 at 10 o'clock in timezone GMT+1
console.log(tick._element.dataset.date);
	// create the countdown counter
	var counter = Tick.count.down(tick._element.dataset.date);

	counter.onupdate = function(value) {
	  tick.value = value;
	};

	counter.onended = function() {
		// redirect, uncomment the next line
		// window.location = 'my-location.html'

		// hide counter, uncomment the next line
		// tick.root.style.display = 'none';

		// show message, uncomment the next line
		// document.querySelector('.tick-onended-message').style.display = '';
	};
}

function mkl_simple_tick_setup( tick ) {
	jQuery( tick._element ).data( 'tick', tick );
	setTimeout( function() {
		tick.value = jQuery( tick._element ).data( 'setValue' );
	}, 1000 );
}