module.exports = {
	twoWay: true,
  priority: 1000,

  params: ['options','ajaxurl','resultvalue'],
	bind: function() {
		this.handler = function() {
				var svalues = $(this.el).select2('val');
			console.log('this.handler= '+ svalues)
			// var svalues3 = $(this).select2('val')
			this.set(this.el.value = svalues)
			// console.log('this.svalues3= '+ svalues3)
			// this.set(svalues3)
		}.bind(this)
		$(this.el).on('select2:close', this.handler)
		var self = this
		$(this.el)
			.select2({
				ajax: {
					url: this.params.ajaxurl,
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term//, // search term
							// page: params.page
						};
					},
					processResults: function (data) {
							return {
								results: $.map(data, function (item) {
									return {
										text: item.name || item.category,
										id:   item.name || item.id
									}
								})
							}
						}
					}
				})
					.on('change', function (ev) {
						var mydom = this;
						// console.log($(mydom).);
						var selectedValues = $(this).select2('val');
						console.log('selectedvalues= ' + selectedValues)
						// console.log($(ev));
						// self.params.items = selectedValues;
						// self.params.resultvalue = selectedValues;
						// console.log("this.el=" + $(this).text())
			 	//	self.set(this.value)
			})
  },
	update: function(value) {
		$(this.el).val(value).trigger('change');
		// $(this.el)
		// 	.on("select2:close", function(e) {
		// 		var svalues = $(this).select2('val');
		// 		console.log('svalues='+ svalues);
		//
		// 	}).bind(this);
  },
  unbind: function() {
		$(this.el).off('select2:close', this.handler)
		$(this.el).off().select2('destroy')
  }
}
