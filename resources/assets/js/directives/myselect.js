module.exports = {
	twoWay: true,
  priority: 1000,

  params: ['options'],

  update: function(value) {
		$(this.el).val(value).trigger('change')

  },
  bind: function() {
		var self = this
		$(this.el)
			.select2({
				data: this.params.options
			})
			.on('change', function () {
				self.set(this.value)
			})
  },
  unbind: function() {
		$(this.el).off().select2('destroy')
  }
}
