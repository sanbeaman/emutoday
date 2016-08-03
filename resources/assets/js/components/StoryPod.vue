<template>

    <div class="box box-solid {{item.type}}">
        <div class="box-header with-border">

                <div class="row">

                    <a v-on:click.prevent="toggleBody" href="#">
                    <div class="col-md-10">
                        <span class="item-type-icon" :class="typeIcon"></span>
                        <h6 class="box-title">{{item.title}}</h6>
                    </div><!-- /.col-md-7-->
                    </a>
                    <div class="col-md-2">
                    <!-- <form class="form-inline pull-right"> -->
                        <span class="item-featured-icon" :class="liveIcon"></span>
                        <span class="item-featured-icon" :class="featuredIcon"></span>
                        <!-- <div class="form-group">
                            <button v-on:click.prevent="doThis" class="btn btn-sm">BTN</button>
                        </div> -->
                        <!-- /.form-group -->

                    <!-- </form> -->
                </div><!-- /.col-md-6 -->
            </div><!-- /.row -->
      </div>  <!-- /.box-header -->
      <div v-if="showBody" class="box-body">
            <p>ID: {{item.id}}</p>
            <p>Type: {{item.type}}</p>
            <p>Title: {{item.title}}</p>
            <p>Approved: {{item.approved}}</p>
            <p>Promoted: {{item.promoted}}</p>
            <p>Featured: {{item.featured}}</p>
            <p>Live: {{item.live}}</p>
            <p>Archived: {{item.archived}}</p>
            <p>Start Date: {{item.start_date}}</p>
            <div class="announcement-info">
                Start Date: {{item.start_date}}</br>
            </div>

      </div><!-- /.box-body -->
            <div class="box-footer list-footer">
                <h6>Start Date: {{item.start_date}}</h6>
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
}

.box-header {
    padding: 3px;
}
h6.box-title {
    color: #1B1B1B;
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
.external  {
        color: #1B1B1B;
    background-color: #cccccc;
    border: 1px solid #cccccc;
}
.news  {
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
    color: #1B1B1B;
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
var moment = require('moment')

module.exports  = {
                props: [
                    'item',
                    'pid'
                ],
              data: function() {
                return {
                        showBody: false,
                        currentDate: {},
                        record: {
                            user_id : '',
                            title: '',
                            type: '',
                            start_date: ''
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
                    console.log('type'+ this.item.type);
                },
              computed: {
                  typeClass: function() {

                  },
                  liveIcon: function() {

                      if (this.item.live === 1){
                          featuredicon = 'fa fa-home'
                      } else {
                          featuredicon = ''
                      }

                      return featuredicon
                  },
                  featuredIcon: function() {

                      if (this.item.featured === 1){
                          featuredicon = 'fa-star'
                      } else {
                          featuredicon = 'fa-star-o'
                      }

                      return 'fa '+ featuredicon + ' pull-right'
                  },
                  typeIcon: function() {
                      switch (this.item.type) {
                          case 'emutoday':
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
                    toggleBody: function(ev) {
                        if(this.showBody == false) {
                            this.showBody = true;
                        } else {
                            this.showBody = false;
                        }
                        console.log('toggleBody' + this.showBody)
                    },
                    doThis: function(ev) {
                        this.$emit('item-change',this.item);
                        console.log('ev ' + ev + 'this.item.id= '+  this.item.priority)
                    }

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
                        // listselect2: require('./ListSelect2.vue')
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
