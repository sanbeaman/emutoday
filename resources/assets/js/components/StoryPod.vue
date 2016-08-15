<template>
    <div>


    <div v-show="itemMsgStatus.show" class="callout callout-{{itemMsgStatus.level}}">
         <span class="Alert__close" @click="itemMsgStatus.show = false">X</span>
        <h5>{{itemMsgStatus.msg}}</h5>
    </div>
    <div class="box box-solid {{item.group}}">
        <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <span class="item-type-icon" :class="typeIcon"></span>
                            <span class="item-featured-icon" :class="promotedIcon"></span>
                            <span class="item-featured-icon" :class="featuredIcon"></span>
                            <span class="item-featured-icon" :class="homeIcon"></span>
                            <span class="item-featured-icon" :class="archivedIcon"></span>
                        </div><!-- /.pull-left -->
                        <div class=" form-inline pull-right">
                            <div class="form-group">
                                <label>approved:</label>
                            </div><!-- /.form-group -->
                            <div class="form-group">

                                <vui-flip-switch id="switch-{{item.id}}"
                                    v-on:click="approveItem"
                                    :value="isApproved" >
                                </vui-flip-switch>
                            </div>
                        </div><!-- /.pull-right -->
                    </div><!-- /.col-md-12-->
                </div><!-- /.row -->
                <div class="row">
                        <a v-on:click.prevent="toggleBody" href="#">
                    <div class="col-md-12">
                        <h6 class="box-title">{{item.title}}</h6>
                    </div><!-- /.col-md-12 -->
  </a>
                </div><!-- /.row -->

        </div>  <!-- /.box-header -->

      <div v-if="showBody" class="box-body">
            <p>ID: {{item.id}}</p>
            <p>Type: {{item.story_type}}</p>
            <p>Title: {{item.title}}</p>
            <p>Approved: {{item.is_approved}}</p>
            <p>Promoted: {{item.is_promoted}}</p>
            <p>Featured: {{item.is_featured}}</p>
            <p>Live: {{item.is_live}}</p>
            <p>Archived: {{item.is_archived}}</p>
            <p>Tags: {{item.tags | json}}</p>
            <p>Start Date: {{item.start_date}}</p>

      </div><!-- /.box-body -->
            <div class="box-footer list-footer">
                <div class="row">
                    <div class="col-sm-7">
                        <h5>Live {{timefromNow}}</h5>
                    </div><!-- /.col-md-7 -->
                    <div class="col-sm-5">
                        <div class="btn-group pull-right">
                                <button v-on:click.prevent="editItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-pencil"></i></button>
                                <button v-on:click.prevent="previewItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-eye"></i></button>
                        </div><!-- /.btn-toolbar -->

                    </div><!-- /.col-md-7 -->
                </div><!-- /.row -->


            </div><!-- /.box-footer -->

    </div><!-- /.box- -->
</div>
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
        .callout {
            position: relative;
            background: #ddd;
            padding: 1em;
            margin: 0;
        }
        .callout .callout-danger {
            background: #ff0000;
            color:#000000;
            /*border: 1px solid #000000;*/
        }

        .callout .callout-success {
            background: #00ff00;
            color:#000000;
            /*border: 1px solid #000000;*/
        }

        .Alert__close {
            position: absolute;
            top: 1em;
            right: 1em;
            font-weight: bold;
            cursor: pointer;
        }

        .emutoday {

            background-color: #76D7EA;
            border: 1px solid #76D7EA
        }
        .student {
            color: #1B1B1B;
            background-color: #FED85D;
            border: 1px solid #FED85D
        }
        .news  {
            color: #1B1B1B;
            background-color: #cccccc;
            border: 1px solid #cccccc;
        }
        .external  {
            color: #1B1B1B;
            background-color: #C9A0DC;
            border: 1px solid #C9A0DC;
        }
        .article  {
            color: #1B1B1B;
            background-color: #29AB87;
            border: 1px solid #29AB87;
        }
        .item-type-icon {
            /*color: #1B1B1B;*/
            /*position:absolute;
            top: 5px;
            left: 5px;*/

        }
        .zcallout {
            border-radius: 5px;
            /*margin: 0 0 20px 0;*/
            /*padding: 15px 30px 15px 15px;*/
            border-left: 50px solid #ff0000;
        }
        .zinfo-box-icon {
            border-top-left-radius: 5px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 5px;
            display: block;
            float: left;
            height: auto;
            width: 60px;
            text-align: center;
            font-size: 45px;
            line-height: 90px;
            background: rgba(0,0,0,0.2);
        }
        .type-badge {
            width: 30px;
            height: 30px;
            font-size: 15px;
            line-height: 30px;
            position: absolute;
            color: #666;
            background: #d2d6de;
            border-radius: 50%;
            text-align: center;
            left: 18px;
            top: 0;
        }
        .onoffswitch {
            position: relative; width: 60px;
            -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
        }
        .onoffswitch-checkbox {
            display: none;
        }
        .onoffswitch-label {
            display: block; overflow: hidden; cursor: pointer;
            border: 2px solid #999999; border-radius: 50px;
        }
        .onoffswitch-inner {
            display: block; width: 200%; margin-left: -100%;
            transition: margin 0.3s ease-in 0s;
        }
        .onoffswitch-inner:before, .onoffswitch-inner:after {
            display: block; float: left; width: 50%; height: 18px; padding: 0; line-height: 18px;
            font-size: 11px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
            box-sizing: border-box;
        }
        .onoffswitch-inner:before {
            content: "YES";
            padding-left: 10px;
            background-color: #605CA8; color: #FFFFFF;
        }
        .onoffswitch-inner:after {
            content: "NO";
            padding-right: 10px;
            background-color: #EEEEEE; color: #999999;
            text-align: right;
        }
        .onoffswitch-switch {
            display: block; width: 22px; margin: 0px;
            background: #FFFFFF;
            position: absolute; top: 0; bottom: 0;
            right: 38px;
            border: 2px solid #999999; border-radius: 50px;
            transition: all 0.3s ease-in 0s;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
            margin-left: 0;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
            right: 0px;
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
        }*/
</style>
<script>

import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'

module.exports  = {
                props: [
                    'item',
                    'pid'
                ],
              data: function() {
                return {
                        response_msg: '',
                        response_approval: '',
                        showBody: false,
                        currentDate: {},
                        record: {
                            user_id : '',
                            title: '',
                            story_type: '',
                            start_date: ''
                        },
                        itemMsgStatus: {
                            show: false,
                            level: '',
                            msg: ''
                        }

                }
              },
                created: function () {
                    // this.currentDate = moment();
                    // console.log('this.currentDate=' + this.currentDate)
                },
                ready: function() {
                    //ready function
                    // this.record = this.props.item;
                    //console.log('type'+ this.item.story_type);
                },
              computed: {
                  timefromNow:function() {
                      return moment(this.item.start_date).fromNow()
                  },
                  isApproved: function() {
                      return this.item.is_approved;
                  },
                  itemEditPath: function(){
                      return '/admin/story/'+ this.item.story_type+'/'+this.item.id + '/edit'
                  },
                  itemPreviewPath: function(){
                      return '/preview/story/'+ this.item.story_type+'/'+this.item.id
                  },
                  typeClass: function() {

                  },
                  promotedIcon: function() {

                      if (this.item.is_promoted === 1){
                          pIcon = 'fa fa-circle'
                      } else {
                          pIcon = 'fa fa-circle-o'
                      }

                      return pIcon
                  },
                  liveIcon: function() {

                      if (this.item.is_live === 1){
                          lIcon = 'fa fa-home'
                      } else {
                          lIcon = ''
                      }

                      return lIcon
                  },
                  homeIcon: function() {
                      if (this.item.tags.length > 0){


                      if (this.item.tags.indexOf('homepage') >= 0){
                          hIcon = 'fa fa-home'
                      } else {
                          hIcon = ''
                      }
                  } else {
                      hIcon = ''
                  }

                      return hIcon
                  },
                  archivedIcon: function() {

                      if (this.item.archived === 1){
                          aIcon = 'fa fa-archive'
                      } else {
                          aIcon = ''
                        //   featuredicon = 'fa-star-o'
                      }

                      return aIcon
                  },
                  featuredIcon: function() {

                      if (this.item.featured === 1){
                          featuredicon = 'fa fa-star'
                      } else {
                        //   featuredicon = ''
                          featuredicon = 'fa fa-star-o'
                      }

                      return featuredicon
                  },
                  typeIcon: function() {
                      switch (this.item.story_type) {
                          case 'emutoday':
                          case 'story':
                          faicon = 'fa-file-image-o'
                          break
                          case 'news':
                          faicon = 'fa-file-text-o'
                          break
                          case 'student':
                          faicon = 'fa-graduation-cap'
                          break
                          case 'external':
                          faicon = 'fa-file-o'
                          break
                          case 'article':
                          faicon = 'fa-newspaper-o'
                          break
                          default:
                          faicon = 'fa-file-o'
                          break
                      }

                      return 'fa '+ faicon + ' fa-fw'

                  }

              },
              methods: {
                  editItem: function(ev) {


                      window.location.href = this.itemEditPath;
                  },
                  previewItem: function(ev) {
                      window.location.href = this.itemPreviewPath;
                  },
                    toggleBody: function(ev) {
                        if(this.showBody == false) {
                            this.showBody = true;
                        } else {
                            this.showBody = false;
                        }
                        console.log('toggleBody' + this.showBody)
                    },
                    // doThis: function(ev) {
                    //     this.$emit('item-change',this.item);
                    //     console.log('ev ' + ev + 'this.item.id= '+  this.item.priority)
                    // },
                    approveItem: function(ev){

                        if (this.item.is_approved === 1){
                            this.item.xIs_approved = 0;
                        } else {
                            this.item.xIs_approved = 1;
                        }

                        this.updateRecordStatus();



                    },
                    updateRecordStatus: function(){
                        // this.item.is_approved = (this.is_approved === 0)?1:0;
                        let self = this
                        this.$http.patch('/api/story/updateQueue' , this.item , {
                            method: 'PATCH'
                        } )
                        .then((response) => {
                            console.log('StoryPodgood?'+ response)
                            self.response_approval = response.data.isapproved;
                            self.item.is_approved = (self.response_approval == 1)?1:0;

                            self.$emit('item-change',self.item);
                            // self.itemMsgStatus.show = true;
                            // self.itemMsgStatus.level = 'success';
                            // self.itemMsgStatus.msg = response.data.msg;

                        }, (response) => {
                            console.log('bad?'+ response)

                            self.itemMsgStatus.show = true;
                            self.itemMsgStatus.level = 'danger';
                            self.itemMsgStatus.msg = response.data.error.message;
                        });
                },
                    doThis: function(ev) {
                        this.item.is_approved = (this.is_approved === 0)?1:0;
                       this.$emit('item-change',this.item);
                    //console.log('ev ' + ev + 'this.item.id= '+  this.item.priority)
                    },

                },
                watch: {
                    'isapproved': function(val, oldVal) {
                        if (val !=  oldVal) {
                            console.log('val change')
                        }
                    }
                },
                directives: {
                        // mydatedropper: require('../directives/mydatedropper.js')
                        // dtpicker: require('../directives/dtpicker.js')
                },
                components: {
                        VuiFlipSwitch
                        // autocomplete: require('./vue-autocomplete.vue'),
                    // 'datepicker': require('../vendor/datepicker.vue'),

                },
                filters: {

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
