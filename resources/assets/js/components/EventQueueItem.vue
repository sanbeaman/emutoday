<template>

    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box-date-top">{{item.start_date | titleDateLong}}</div>
                </div><!-- /.col-sm-6 -->
                <div class="col-sm-6">
                    <form class="form-inline pull-right">
                      <div class="form-group">
                        <label class="sr-only" for="priority-number">Priority</label>
                            <select id="priority-{{item.id}}" v-model="item.priority" class="form-control" number>
                                <option v-for="option in options" v-bind:value="option.value">
                                    {{option.text}}
                                </option>
                            </select>
                      </div>
                      <div class="form-group">
                              <label>approved:</label>
                          </div><!-- /.form-group -->
                         <div class="form-group">
                              <vui-flip-switch id="switch-{{item.id}}"
                                  v-on:click="doThis"
                                  :value="isApproved" >
                              </vui-flip-switch>
                          </div>
                      </form>
                </div><!-- /.col-sm-6 -->
            </div><!-- /.row -->

            <div class="row">
              <a v-on:click.prevent="toggleBody" href="#">
                <div class="col-sm-12">
                    <h6 class="box-title">{{item.title}}</h6>
                </div><!-- /.col-md-12 -->
              </a>
            </div><!-- /.row -->
        </div>  <!-- /.box-header -->

        <div v-if="showBody" class="box-body">

            <p>From: {{item.start_time}} to {{item.end_time}}</p>
            <p>{{item.description}}</p>
            <div class="item-info">
                Dates: {{item.start_date}} - {{item.end_date}}
            </div>

        <template v-if="canHaveImage">
            <img v-if="hasEventImage" :src="imageUrl" />
            <a v-on:click="togglePanel" class="btn bg-olive btn-sm" href="#">{{hasEventImage ? 'Change Image' : 'Promote Event'}}</a>
            <div v-show="showPanel" class="panel">
                <form id="form-mediafile-upload{{item.id}}" @submit.prevent="uploadMediaFile" class="m-t" role="form" action="/api/event/addMediaFile/{{item.id}}"  enctype="multipart/form-data">
                    <input class="hidden" type="input" value="{{item.id}}" v-model="formInputs.event_id">
                    <div class="form-group">
                        <label for="event-image">Event Image</label><br>
                        <input v-el:eventimg type="file" name="eventimg" id="eventimg">
                    </div>
                    <button id="btn-mediafile-upload" type="submit" class="btn btn-primary block m-b">Submit</button>
                </form>
            </div><!-- /.panel mediaform -->
        </template>

        </div><!-- /.box-body -->


        <div class="box-footer list-footer">
            <div class="row">
                <div class="col-sm-7">
                    <h5>Live {{timefromNow}}</h5>
                </div><!-- /.col-md-7 -->
                <div class="col-sm-5">
                    <div class="btn-group pull-right">
                            <button v-on:click.prevent="editItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-pencil"></i></button>
                            <!-- <button v-on:click.prevent="previewItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-eye"></i></button> -->
                    </div><!-- /.btn-toolbar -->

                </div><!-- /.col-md-7 -->
            </div><!-- /.row -->
        </div><!-- /.box-footer -->
</div><!-- /.box- -->

</template>
<style scoped>
.box {
    color: #1B1B1B;
    margin-bottom: 10px;
}
.box-body {
    background-color: #fff;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    margin:0;
}

.box-header {
    padding: 3px;
}
.box-footer {
    padding: 3px;
}
h5.box-footer {
    padding: 3px;
}
button.footer-btn {
    border-color: #1B1B1B;

}
h6.box-title {
    font-size: 16px;
    color: #1B1B1B;
}
    .box-date-top {

    }
    .box-date-bot {

    }
    .box-date {

    }
        select.form-control {
            height:22px;
            border: 1px solid #999999;
        }

        h6 {
            margin-top: 0;
            margin-bottom: 0;
        }
        h5 {
            margin-top: 0;
            margin-bottom: 0;
        }

        .form-group {
            /*border: 1px solid red;*/
        }
        .form-group label{
            margin-bottom: 0;
        }
        /*.box.box-solid.box-default {
            border: 1px solid #999999;
        }
        .box-body {
            padding: 3px 6px;
        }*/
</style>
<script>
import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'

module.exports  = {
    components: {VuiFlipSwitch},
    props: ['item','pid'],
    data: function() {
        return {
            is_approved: 0,
            options: [
                { text: '0', value: 0 },
                { text: '1', value: 1 },
                { text: '2', value: 2 },
                { text: '3', value: 3 },
                { text: '4', value: 4 },
                { text: '5', value: 5 },
                { text: '6', value: 6 },
                { text: '7', value: 7 },
                { text: '8', value: 8 },
                { text: '9', value: 9 },
                { text: '10', value: 10 },
                { text: '99', value: 99 }
            ],
            formInputs: {
                event_id: '',
                attachment: ''

            },
            showBody: false,
            showPanel: false,
            currentDate: {},
            record: {
            }
        }
    },
    created: function () {
        // this.is_approved = this.item.approved;
        // this.currentDate = moment();
        // console.log('this.currentDate=' + this.currentDate)
    },
    ready: function() {
        this.is_approved = this.item.is_approved;
            // this.formInputs.event_id = this.item.id;
        //ready function
    },
    computed: {
        hasEventImage:function() {
            if(this.item.eventimage){
                return true;
            } else {
                return false;
            }

        },
        canHaveImage:function() {
            if(this.item.is_approved){
                return true;
            } else {
                return false;
            }

        },
        imageUrl:function() {
            var pth = "/imagecache/smallthumb/";
            var fname = this.item.eventimage;
            console.log(pth + fname)
            return pth + fname;
        },
        timefromNow:function() {
            return moment(this.item.start_date).fromNow()
        },
        isApproved: function() {
            return this.item.is_approved;
        },
        itemEditPath: function(){
            return '/admin/event/'+ this.item.id + '/edit'
        },
        itemPreviewPath: function(){
            return '/preview/event/'+ this.item.id
        },



    },
    methods:{
        // We will call this event each time the file upload input changes. This will push the data to our data property above so we can use the data on form submission.
            // onFileChange(event) {
            //     console.log("event.target.file" + event.target.file)
            //     this.formInputs.attachment = event.target.file;
            // },
            // Handle the form submission here
            editItem: function(ev) {


                window.location.href = this.itemEditPath;
            },

           uploadMediaFile(event) {
               event.preventDefault();
               event.stopPropagation();

               var files = this.$els.eventimg.files;
               var data = new FormData();
               data.append('event_id', this.formInputs.event_id);

               // Since we have multiple files, we will loop through them and add them to an array in our form object.
            //    for(var key in this.formInputs.attachment) {
                data.append('eventimg', files[0]);
            //    }
                // var formid = '#form-mediafile-upload'+this.item.id;
                // var action =  $(formid).action;
            var action = '/api/event/addMediaFile/'+ this.formInputs.event_id;
               this.$http.post(action, data , {
                    method: 'PUT'
               } )
               .then((response) => {
                   console.log('good?'+ response)

               }, (response) => {
                   console.log('bad?'+ response)
               });
            //    var action = $('#form-submit-ticket').action;
               // POST the data to our Laravel controller
            //    this.$http.post(action, form, function(response) {
            //        console.log('Success:', response)
            //    })
           },
           AddMediaFileToEvent: function(item, args){
               console.log(args)
               var currentRecordId =  item.id;
               var currentRecord = args;

               this.$http.patch('/api/event/updateItem/' + item.id , currentRecord , {
                   method: 'PATCH'
               } )
               .then((response) => {
                   console.log('good?'+ response)
                   var movedIndex = this.movedItemIndex(movedid);
                       // this.xitems.pop(movedRecord);
                   // if (movedRecord.approved == 1) {
                   //         this.xitems.splice(movedIndex, 1);
                   //      this.items.push(movedRecord);
                   //  } else {
                   //      this.items.splice(movedIndex, 1);
                   //     this.xitems.push(movedRecord);
                   //  }

                       console.log('movedIndex==='+ movedIndex)
                   }, (response) => {
                       console.log('bad?'+ response)
                   });
           },



        togglePanel: function(ev) {
            if(this.showPanel === false) {
                this.showPanel = true;
            } else {
                this.showPanel = false;
            }
            console.log('this.showPanel' + this.showPanel)
        },
        toggleBody: function(ev) {
            if(this.showBody == false) {
                this.showBody = true;
            } else {
                this.showBody = false;
            }
            console.log('toggleBody' + this.showBody)
        },
        doThis: function(ev) {
            this.item.is_approved = (this.is_approved === 0)?1:0;
           this.$emit('item-change',this.item);
        //console.log('ev ' + ev + 'this.item.id= '+  this.item.priority)
        },
        addMediaFile: function(ev) {
            var formData = new FormData();
            formData.append('image', fileInput ,this.$els.finput.files[0]);

            // var fileinputObject = this.$els.finput;
            // console.log('fileinputObject.name= '+ fileinputObject.name)
            // console.log('fileinputObject.value= '+ fileinputObject.value)
            // console.log('fileinputObject.files= '+ fileinputObject.files[0])
            this.$emit('add-media-file', formData);
            console.log('ev ' + ev + 'this.item.id= '+  this.item)
        }

    },
    watch: {
        // 'isapproved': function(val, oldVal) {
        //     if (val !=  oldVal) {
        //         console.log('val change')
        //     }
        // }
    },
    directives: {
        // mydatedropper: require('../directives/mydatedropper.js')
        // dtpicker: require('../directives/dtpicker.js')
    },

    filters: {
        titleDay: function (value) {
            return  moment(value).format("ddd")
        },
        titleDate: function (value) {
            return  moment(value).format("MM/DD")
        },
        titleDateLong: function (value) {
            return  moment(value).format("ddd MM/DD")
        },
        momentPretty: {
            read: function(val) {
                console.log('read-val'+ val )

                return 	val ?  moment(val).format('MM-DD-YYYY') : '';
            },
            write: function(val, oldVal) {
                console.log('write-val'+ val + '--'+ oldVal)

                return moment(val).format('YYYY-MM-DD');
            }
        }
    },
    events: {

        // 'building-change':function(name) {
        // 	this.newbuilding = '';
        // 	this.newbuilding = name;
        // 	console.log(this.newbuilding);
        // },
        // 'categories-change':function(list) {
        // 	this.categories = '';
        // 	this.categories = list;
        // 	console.log(this.categories);
        // }
    }
};


</script>
