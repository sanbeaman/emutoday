<template>
    <div class="row">
			<div class="col-md-6">
				<announcement-list-form
				 	v-for="item in items"
					:item='item'
					:index="$index">
				</announcement-list-form>
			</div><!-- /.col-md-6 -->
			<div class="col-md-6">

			</div><!-- /.col-md-6 -->
</div><!-- ./row -->
</template>
<script>
    import AnnouncementListForm from './AnnouncementListForm.vue'
    // import EventViewContent from './EventViewContent.vue'
      export default  {
        components: {AnnouncementListForm},
				props: [ 'recordsin'],


        ready() {


					this.items = this.recordsin;
					console.log('AnnouncementApp' + this.items);
        // this.freshPageLand();

        },
        data: function() {
          return {
            items: [],
        	}
        },
        methods : {

        },
        // the `events` option simply calls `$on` for you
        // when the instance is created
        events: {
          // 'child-msg': function (msg) {
          //   // `this` in event callbacks are automatically bound
          //   // to the instance that registered it
          //   this.messages.push(msg)
          // }
        }
    }
</script>
