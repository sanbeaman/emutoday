module.exports = {
	twoWay: true,
  priority: 1000,

  params: ['options'],

  update: function(value) {
		$(this.el).val(value).trigger('change')

  },
  bind: function() {
		var self = this
		$('#dateinput')
			.datetimepicker({
					format:'Y/m/d H:i'
			})
  },
  unbind: function() {
		// $(this.el).off().select2('destroy')
  }
}
