var AllPages = function($) {

	// ---
	// add a datepicker when there are date input fields
	// ---
	if ($('.datetimepicker').length) {
		require('moment');
		require ('moment-timezone');
		require ('./lib/bootstrap-datetimepicker.min.js');
		// DATETIME-picker
		$('.datetimepicker').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});
	}

}(jQuery);
