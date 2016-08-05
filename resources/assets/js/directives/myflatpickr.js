require ('flatpickr');

module.exports = {
    twoWay: true,
  priority: 1000,
    params: ['options'],
    bind: function() {
        $(this.el).flatpickr();
        console.log(this.params);

    },
    update: function() {

    }
}
