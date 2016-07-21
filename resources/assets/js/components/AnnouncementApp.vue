<template>
    <div class="row">
			<div class="col-md-6">
				<announcement-list-form
				 	v-for="item in items"
					:item="item"
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
        components: {
					AnnouncementListForm
				},
				props: [
					'annrecords'
				],


        ready() {
					this.fetchAllRecords();
        // this.freshPageLand();

        },
        data: function() {
          return {
            items: [],
						objs: {}
        	}
        },
        methods : {
					fetchAllRecords: function() {
						this.$http.get('/api/announcement/listall')

							.then((response) =>{
									//response.status;
									console.log('response.status=' + response.status);
									console.log('response.ok=' + response.ok);
									console.log('response.statusText=' + response.statusText);
									console.log('response.data=' + response.data);
									// data = response.data;

									this.items = response.data.data;
									console.log('this.record= ' + this.record);

									this.checkOverData();
								}, (response) => {
									//error callback
									console.log("ERRORS");

									//  this.formErrors =  response.data.error.message;

								}).bind(this);
							},
							checkOverData: function() {
								console.log('this.items='+ this.items)
							}
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
