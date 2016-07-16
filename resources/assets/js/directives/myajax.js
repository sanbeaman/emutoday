module.exports = {
	twoWay: true,
  priority: 1000,
	params: ['complete'],
	bind: function() {
		console.log(this.params);
		alert('bound');

	},
	update: function() {
		alert('update');
	}
}
