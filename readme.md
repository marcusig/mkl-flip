# A countdown plugin (and more), built using the great [pqina/flip](https://github.com/pqina/flip)

This is very basic at the moment. 

## Usage:

### Countdown:

Use the following shortcode:

`[mkl_flip type="countdown" date="2021-04-15"]`


### Counter:

You can also use the following shortcode in order to display any number:

`[mkl_flip type="simple" value="21409248"]`

You can then access / update this number using JS. 

**For example:** 

Add the shortcode `[mkl_flip type="simple" value="21409248" id="my-dynamic-number"]`

Get the Tick instance using jQuery:

```JS
jQuery(function($) {
	// Get the counter Element
	var counter = $( '#my-dynamic-number' );
	// Check if the counter exists and has the `tick` instance saved up
	if ( counter && counter.data( 'tick' ) ) {
		// Update the value of the counter
		counter.data( 'tick' ).value = 123456;
	}
});
```