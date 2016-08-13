<template>
    <div class="row">
        <div class="col-md-4">
            <div v-if="singleStype" class="form-group">
              <label class="sr-only" for="story-type">Type</label>
                  <select id="story-type" v-model="storytype" class="form-control">
                      <option v-for="stype in s_types" v-bind:value="stype.shortname">
                          {{stype.name}}
                      </option>
                  </select>
            </div>
            <h3>Unapproved</h3>

            <div id="items-unapproved">
                <story-pod
                    pid="items-unapproved"
                    v-for="item in items_unapproved | orderBy 'start_date' 1 | filterBy storytype in 'story_type'"
                    @item-change="moveToApproved"

                    :item="item"
                    :index="$index"
                    :is="items-unapproved">
                </story-pod>
        </div>
    </div><!-- /.col-md-4 -->
    <div class="col-md-4">
        <h3>Approved</h3>
        <div id="items-approved">
            <story-pod
                pid="items-approved"
                v-for="item in items_approved | orderBy 'start_date' 1 "
                @item-change="moveToApproved"

                :item="item"
                :index="$index"
                :is="items-approved">
            </story-pod>
        </div>
    </div><!-- /.col-md-4 -->
    <div class="col-md-4">
        <h3>Live <small>Approved and StartDate is past</small></h3>
        <div id="items-live">
            <story-pod
                pid="items-live"
                v-for="item in items_live | orderBy 'start_date' 1"
                @item-change="moveToApproved"

                :item="item"
                :index="$index"
                :is="items-live">
            </story-pod>
        </div>
    </div><!-- /.col-md-4 -->
</div><!-- ./row -->
</template>
<style scoped>


#items-unapproved .box {
    margin-bottom: 4px;
}
#items-approved .box {
    margin-bottom: 4px;

}
#items-live .box {
    margin-bottom: 4px;

}
</style>
<script>

import moment from 'moment'
import StoryPod from './StoryPod.vue'
// import EventViewContent from './EventViewContent.vue'
export default  {
    components: {
        StoryPod
    },
    props: [
        'allrecords','stypes'
    ],
    created(){
        // this.currentDate = moment().format();
    },

    ready() {
        // this.resource = this.$resource('/api/announcement/:id');
        this.fetchAllRecords();
        // this.fetchUnapprovedRecords();

    },
    data: function() {
        return {
            singleStype: false,
            // storytypes: [
            //     { type: 'news'},
            //     { type: 'student'},
            //     { type: 'emutoday'},
            //     { type: 'article'},
            //     { type: 'external'}
            // ],
             storytype:'',
            changestorytype:'',
            currentDate: moment(),
            allitems: [],
            items: [],
            xitems: [],
            items_unapproved: [],
            items_approved: [],
            items_live: []
        }
    },
    computed: {
        s_types:function(){
           // var data = localStorage[key];
              try {
                  this.singleStype = false;
                  return JSON.parse(this.stypes);
              } catch(e) {
                  this.singleStype = true;
                  // this.record.story_type = this.stypes;
                  return this.stypes;
              }
        },
        itemsApproved:function() {
            return  this.filterItemsApproved(this.allitems);
        },
        itemsUnapproved:function() {
            return  this.filterItemsUnapproved(this.allitems);
        },
        itemsLive:function() {
            return  this.filterItemsLive(this.allitems);
        }
    },

    methods : {
        // checkIndexWithValue: function (chitem){
        // 	return
        // },
        // customFilterFunc: function (val) {
        //         console.log('val' + val.type)
        //         return val.group === 'news'
        //
        // },
        filterTheList:function() {
            let self = this;
            this.items_unapproved = this.items_unapproved.filter(function (item) {
                return item.story_type ==  self.storytype;
            })
        },

        moveToApproved: function(changeditem){

            // this.xitems.pop(changeditem);
            console.log('moveToApproved'+ changeditem.priority);
            changeditem.is_approved = 1;
            changeditem.priority = changeditem.priority;
            this.updateRecord(changeditem)
        },
        moveToUnApproved: function(changeditem){

            // this.xitems.pop(changeditem);
            console.log('moveToUnApproved'+ changeditem)
            changeditem.is_approved = 0;

            this.updateRecord(changeditem)
        },
        filterItemsApproved: function(items) {
            return items.filter(function(item) {
                return moment(item.start_date).isAfter(moment()) && item.is_approved === 1
            });
        },
        filterItemsUnapproved: function(items) {
            return items.filter(function(item) {
                return item.is_approved === 0
            });
        },
        filterItemsLive: function(items) {
            return items.filter(function(item) {
                return moment(item.start_date).isSameOrBefore(moment()) && item.is_approved === 1;  // true

                // return moment(item.start_date).isAfter(moment())
                // return item.live === 1
            });
        },
        movedItemIndex: function(mid){
            return this.xitems.findIndex(item => item.id == mid)
        },
        updateRecord: function(item){
            var currentRecordId =  item.id;
            item.start_date =  moment(item.start_date, "MM-DD-YYYY").format("YYYY-MM-DD")

            var currentRecord = item;
            this.$http.patch('/api/story/' + item.id , item , {
                method: 'PATCH'
            } )
            .then((response) => {
                console.log('good?'+ response)



                //var movedIndex = this.movedItemIndex(movedid);
                            // this.xitems.pop(movedRecord);
                        // if (movedRecord.approved == 1) {
                        //         this.xitems.splice(movedIndex, 1);
                        //      this.items.push(movedRecord);
                        //  } else {
                        //      this.items.splice(movedIndex, 1);
                        //     this.xitems.push(movedRecord);
                        //  }

                //console.log('movedIndex==='+ movedIndex)
            }, (response) => {
                console.log('bad?'+ response)
            });
    },
        // updateRecord: function(item){
        //     var movedid =  item.id;
        //     var movedRecord = item;
        //     this.$http.patch('/api/announcement/updateItem/' + item.id , item , {
        //         method: 'PATCH'
        //
        //     } )
        //     .then((response) => {
        //         console.log('good?'+ response)
        //         var movedIndex = this.movedItemIndex(movedid);
        //         // this.xitems.pop(movedRecord);
        //         if (movedRecord.approved == 1) {
        //             this.xitems.splice(movedIndex, 1);
        //             this.items.push(movedRecord);
        //         } else {
        //             this.items.splice(movedIndex, 1);
        //             this.xitems.push(movedRecord);
        //         }
        //
        //         console.log('movedIndex==='+ movedIndex)
        //     }, (response) => {
        //         console.log('bad?'+ response)
        //     });
        // },
        // getRequestType: function () {
        //     var method = this.el.querySelector('input[name="_method"]');
        //
        //     return (method ? method.value : this.el.method).toLowerCase();
        // },
        // fetchUnapprovedRecords: function(){
        //     this.$http.get('/api/announcement/unapprovedItems')
        //
        //     .then((response) =>{
        //         console.log('response.status=' + response.status);
        //         console.log('response.ok=' + response.ok);
        //         console.log('response.statusText=' + response.statusText);
        //         console.log('response.data=' + response.data);
        //
        //         this.$set('xitems', response.data.data)
        //
        //         this.fetchApprovedRecords();
        //     }, (response) => {
        //         //error callback
        //         console.log("ERRORS");
        //
        //         //  this.formErrors =  response.data.error.message;
        //
        //     }).bind(this);
        // },
        // fetchApprovedRecords: function() {
        //     this.$http.get('/api/announcement/approvedItems')
        //
        //     .then((response) =>{
        //         //response.status;
        //         console.log('response.status=' + response.status);
        //         console.log('response.ok=' + response.ok);
        //         console.log('response.statusText=' + response.statusText);
        //         console.log('response.data=' + response.data);
        //         // data = response.data;
        //         //
        //         this.$set('items', response.data.data)
        //
        //         // this.allitems = response.data.data;
        //         // console.log('this.record= ' + this.record);
        //
        //         this.checkOverDataFilter();
        //     }, (response) => {
        //         //error callback
        //         console.log("ERRORS");
        //
        //         //  this.formErrors =  response.data.error.message;
        //
        //     }).bind(this);
        // },
        fetchAllRecords: function() {
            this.$http.get('/api/story/appLoad')

            .then((response) =>{
                //response.status;
                // console.log('response.status=' + response.status);
                // console.log('response.ok=' + response.ok);
                // console.log('response.statusText=' + response.statusText);
                // console.log('response.data=' + response.data);
                // data = response.data;
                //
                this.$set('allitems', response.data.data)

            //    this.allitems = response.data.data;
                // console.log('this.record= ' + this.record);

                this.checkOverDataFilter();
            }, (response) => {
                //error callback
                console.log("ERRORS");

                //  this.formErrors =  response.data.error.message;

            }).bind(this);
        },
        checkOverData: function() {
            console.log('this.items='+ this.allitems)
            // for (var i=0; i < this.allitems.length; i++ ) {
            //     if( this.allitems[i].approved == 1) {
            //         this.items.push(this.allitems.splice(i,1));
            //     } else {
            //         this.xitems.push(this.allitems.splice(i,1));
            //     }
            // }

        },

        checkOverDataFilter: function() {
            let self = this;
            console.log('items=' + this.allitems)

            this.allitems.forEach(function(item) {
            if (item.is_approved === 1) {
                if (moment(item.start_date).isSameOrBefore(moment())) {
                    self.items_live.push(item)
                } else {
                    self.items_approved.push(item)
                }
            } else {
                self.items_unapproved.push(item)
            }
        });
        console.log('items_unapproved'+ this.items_unapproved.length )

        console.log('items_approved'+ this.items_approved.length )
        // function separate_evens_from_odds(value) {
        // 	if ( value % 2 ) {
        // 		odd_numbers.push(value);
        // 	}
        // 	else {
        // 		even_numbers.push(value);
        // 	}
        // }

        // var array_of_numbers = [5, 7, 1, 9, 8, 5];
        //
        // array_of_numbers.forEach(separate_evens_from_odds);
        //
        // console.log(even_numbers); //[8]
        // console.log(odd_numbers); //[5, 7, 1, 9, 5]
            // var unapprovedItems = this.allitems.filter(function(item) {
            // 	return item.approved === 0
            // });
            //
            // this.xitems = unapprovedItems;
            //
            //
            // var approvedItems = this.allitems.filter(function(item) {
            // 	return item.approved === 1
            // });
            //
            // this.items = approvedItems.sort(function(a,b){
            // 	return parseFloat(b.priority) - parseFloat(a.priority);
            // });

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
