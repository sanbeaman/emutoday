<template>
<form>
    <slot name="csrf"></slot>
    <!-- <slot name="author_id" v-model="newevent.author_id"></slot> -->
    <div class="row">
        <div class="col-md-12">


            <div v-show="formMessage.isOk"  class="callout callout-success">
              <h5>{{formMessage.msg}}</h5>
                </div>
            </div><!-- /.small-12 columns -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Title <i class="fi-star reqstar"></i></label>
                <p class="help-text" id="title-helptext">Please enter a title ({{titleChars}} characters left)</p>
                <input v-model="record.title" v-bind:class="[formErrors.title ? 'invalid-input' : '']"  name="title" type="text">
                <p v-if="formErrors.title" class="help-text invalid">	Please Include a Title!</p>
            </div>
            <div class="form-group">
                <label>Slug <i class="fi-star reqstar"></i></label>
                <p class="help-text" id="slug-helptext">Automatic Readable link for sharing and social media</p>
                <input v-model="recordSlug" v-bind:class="[formErrors.slug ? 'invalid-input' : '']"  name="slug" type="text">
                <p v-if="formErrors.slug" class="help-text invalid">needs slug!</p>
            </div>
            <div class="form-group">
                <label>Subtitle</label>
                <p class="help-text" id="subtitle-helptext">Visibible in some cases</p>
                <input v-model="record.subtitle" v-bind:class="[formErrors.subtitle ? 'invalid-input' : '']" @blur="onBlur" name="subtitle" type="text">
                <p v-if="formErrors.subtitle" class="help-text invalid"></p>
            </div>
            <div class="form-group">
                <label>Content <i class="fi-star reqstar"></i></label>
                <p class="help-text" id="content-helptext">Enter the story content</p>
                <textarea v-if="content"  id="content" name="content" v-ckrte="content" :content.sync="content" :fresh="isFresh"></textarea>
                <p v-if="formErrors.content" class="help-text invalid">Need Content!</p>
            </div>
            <div class="form-group author-display">
            <div class="author-name">{{record.author.first_name}} {{record.author.last_name}}</div>
            <div class="author-info">Contact {{record.author.first_name}} {{record.author.last_name}}, {{record.author.email}}, {{record.author.phone}}</div>
            </div><!-- /.frm-group -->

            <div class="form-group ">
                <label>Author Info</label>
                <p class="help-text" id="author-info-helptext">Visibible in some cases</p>
                <input v-model="record.subtitle" v-bind:class="[formErrors.author_info ? 'invalid-input' : '']" name="author-info" type="text">
                <p v-if="formErrors.subtitle" class="help-text invalid"></p>
            </div>
        </div><!-- /.small-12 columns -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-6">
            <!-- <div class="form-group">
                    <label for="start-date">Start Date: <i class="fi-star reqstar"></i></label>
                    <input v-if="record.start_date" id="start-date" name="start-date" class="formControl" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text" v-model="record.start_date" />
                    <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
                </div> -->
                <!--form-group -->
        </div><!-- /.small-6 columns -->
        <div class="col-md-6">
            <div class="form-group">
                    <label for="start-date">Start Date: <i class="fi-star reqstar"></i></label>
                     <input v-if="fdate" type="text" :value="fdate" :initval="fdate"  v-flatpickr="fdate">
                    <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
                </div><!--form-group -->
        </div><!-- /.small-6 columns -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">Save Story</button>
            </div>
        </div><!-- /.medium-12 column -->
    </div>
</form>


</template>
<style scoped>
    p {
        margin:0;
    }
    label {
        display: block;
        /*margin-bottom: 1.5em;*/
    }

    label > span {
        display: inline-block;
        width: 8em;
        vertical-align: top;
    }
    .valid-titleField {
        background-color: #fefefe;
        border-color: #cacaca;
    }
    .no-input {
        background-color: #fefefe;
        border-color: #cacaca;
    }
    .invalid-input {
        background-color: rgba(236, 88, 64, 0.1);
        border: 1px dotted red;
    }
    .invalid {
        color: #ff0000;
    }
    .author-display {
        color: #666;
        font-size: 16px;
    }
    .author-display .author-name {

        font-style: italic;
    }
    .author-display .author-info {
        font-size: .9rem;
    }





    fieldset label.radiobtns  {
        display: inline;
        margin: 4px;
        padding: 2px;
    }

    [type='text'], [type='password'], [type='date'], [type='datetime'], [type='datetime-local'], [type='month'], [type='week'], [type='email'], [type='number'], [type='search'], [type='tel'], [type='time'], [type='url'], [type='color'],
    textarea {
        margin: 0;
        padding: 0;
        padding-left: 8px;
        width: 100%;
    }
    [type='file'], [type='checkbox'], [type='radio'] {
        margin: 0;
        margin-left: 8px;
        padding: 0;
        padding-left: 2px;
    }
    .reqstar {
        font-size: .5rem;
        color: #E33100;
        vertical-align:text-top;
    }

    button.button-primary{
        margin-top: 1rem;
    }
</style>

<script>
var moment = require('moment')
// import Datepicker from 'vue-bulma-datepicker'
import {incrementCounter, sendMessage, updateRecordState} from '../vuex/actions'
import { getMessage, getRecordState } from '../vuex/getters'
// import flatpickr from 'flatpickr';
module.exports  = {
                props:{
                    authorid: {default : '0'},
                    recordexists: {default: false},
                    editid: {default: ''},
                    inrecord: {default: {}}
                },
                vuex: {
                    getters: {
                        message: getMessage,
                        thisRecordState: getRecordState

                    },
                    actions: {
                        updateMessage: ({ dispatch }, value) => {
                            dispatch('UPDATE_MESSAGE', value)
                        },
                        updateRecord: ({dispatch}, value) => {
                            dispatch('RECORD_STATE', value)
                        },


                        increment:incrementCounter
                    }
                },
                computed: {
                    recordContent: function() {
                        return this.record.content
                    },

                    hasLocalRecordChanged: function() {
                        var ckval = false
                        if (this.inrecord.title !== this.record.title){
                                ckval = true
                        }

                        if (this.inrecord.content !== this.content ) {
                                ckval = true
                        }

                        if (ckval) {
                            this.updateRecord('edit')

                        }
                        return ckval
                    },

                thisRecordState: {
                    get () {
                        return this.recordState
                    },
                    set (val) {
                        this.updateRecord(val)
                    }
                },
                    thisMessage: {
                        get () {
                            return this.message
                        },
                        set (val) {
                            this.updateMessage(val)
                        }
                    },
                    recordSlug: function(){
                        if(this.record.title){
                            return  this.record.title.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, '')

                        }
                    },
                    hasStartDate: function () {
                        if (this.record.start_date === undefined || this.record.start_date == '') {
                            return false
                        } else {
                            return true
                        }

                    }
                },
              data: function() {
                return {
                    isFresh: true,
                    thisRecordState: '',
                    thisMessage: {},
                    stateOfrecord: '',
                    content: '',
                    startdatePicker: null,
                    date: {},
                    currentDate: {},
                    recordState: '',
                    record: {
                        title: '',
                        content: ''
                    },
                    fdate: null,
                    dateOptions: {
                        minDate: "today",
                        enableTime: false,
                        altFormat: "m-d-Y",
                        altInput: true,
                        altInputClass:"form-control",
                        dateFormat: "Y-m-d",
                    },

                  response: {

                        },
                        formMessage: {
                            isOk: false,
                            msg: ''
                        },
                  formInputs : {},
                  formErrors : {}
                }
              },
              watch: {
                //   'recordState': function(val,oldVal) {
                //       console.log('new: %s, old: %s', val, oldVal)
                //       this.updateRecordState(val)

                  //
                //   },
                //   deep: true

              },

              directives: {
                  ckrte: require('../directives/myrte.js'),
                  flatpickr: require('../directives/flatpickr.js')
              },
                created: function () {
                    this.currentDate = moment();
                    console.log('this.currentDate=' + this.currentDate)
                    this.recordState = 'created';

                },
                ready() {
                    this.recordState = 'ready';

                    if (this.recordexists){
                        console.log('inrecord='+ this.inrecord)
                        //this.parseCurrentRecord();
                         this.fetchCurrentRecord();
                    }
                },

              methods: {
                  parseCurrentRecord: function(rcd) {
                    //  var json=JSON_decode(this.inrecord);
                    //console.log('JSON_decode= ' + JSON.parse(this.inrecord))
                    var storyjson = this.inrecord
                    //console.log('JSON_parse= ' + JSON_parse(this.inrecord))
                    this.record =  storyjson; //this.inrecord
                    //   this.$set('record', this.inrecord)


                  },
                  onBlur: function(evt){
                      if (this.recordState != 'dirty') {
                          this.recordState = 'dirty'
                         this.updateRecord('dirty');
                      }
                      console.log('blur')
                  },
                  onContentChange: function(evt){
                      if (this.recordState != 'dirty') {
                          this.recordState = 'dirty'
                         this.updateRecord('dirty');
                      }
                      console.log('change')
                  },
                  jsonEquals: function(a,b) {
                      return JSON.stringify(a) === JSON.stringify(b);
                  },
                    fetchCurrentRecord: function() {
                        this.$http.get('/api/story/'+ this.editid +'/edit')

                            .then((response) =>{
                                    //response.status;
                                    console.log('response.status=' + response.status);
                                    console.log('response.ok=' + response.ok);
                                    console.log('response.statusText=' + response.statusText);
                                    console.log('response.data=' + response.data);
                                    // data = response.data;
                                    this.$set('record', response.data.data)
                                    // this.record = response.data.data;
                                    console.log('this.record= ' + this.record);

                                    this.checkOverData();
                                }, (response) => {
                                    //error callback
                                    console.log("ERRORS");

                                     this.formErrors =  response.data.error.message;

                                }).bind(this);
                    },
                    checkOverData: function() {
                        console.log('this.record'+ this.record.id)
                        this.content = this.record.content;
                        this.fdate = this.record.start_date;
                    //    this.addDatePicker();
                    },
                    addDatePicker: function() {
                        var self = this;
                        this.startdatePicker = flatpickr(document.getElementById("start-date"),{
                                minDate: "today",
                                enableTime: false,
                                altFormat: "m-d-Y",
                                altInput: true,
                                altInputClass:"form-control",
                                dateFormat: "Y-m-d",
                                onChange(dateObject, dateString) {
                                    self.updateRecord('dirty');
                                    self.record.start_date = dateString;
                                    self.startdatePicker.value = dateString;
                                }

                            });
                    },
                    submitForm: function(e) {
                    //  console.log('this.eventform=' + this.eventform.$valid);
                        e.preventDefault();
                  // this.newevent.start_date = this.sdate;
                  // this.newevent.end_date = this.edate;
                  // this.newevent.reg_deadline = this.rdate;
                  this.record.author_id = this.authorid;
                  this.record.content = this.content;
                  this.record.slug = this.recordSlug;
                  this.record.start_date = this.fdate;
                  let method = (this.recordexists) ? 'put' : 'post'
                    let route =  (this.recordexists) ? '/api/story/' + this.record.id : '/api/story/';

                //   this.$http.post('/api/story', this.record)
                  this.$http[method](route, this.record)

                            .then((response) =>{
                                    //response.status;
                                    console.log('response.status=' + response.status);
                                    console.log('response.ok=' + response.ok);
                                    console.log('response.statusText=' + response.statusText);
                                 console.log('response.data=' + response.data.message);

                                 this.formMessage.msg = response.data.message;
                                 this.formMessage.isOk = response.ok;
                                this.updateRecord('ready');
                                }, (response) => {
                                    //error callback
                                    this.formErrors =  response.data.error.message;
                                }).bind(this);
                    }
                    },


                    components: {
                        // Datepicker: require('vue-bulma-datepicker')
                        // datepicker: require('datepicker')

                        // listselect2: require('./ListSelect2.vue')
                        // autocomplete: require('./vue-autocomplete.vue'),
                    // 'datepicker': require('../vendor/datepicker.vue'),

                    },
                    filters: {
                        momentstart: {
                            read: function(val) {
                                    console.log('read-val'+ val )

                                return 	val ?  val : '';
                            },
                            write: function(val, oldVal) {
                                console.log('write-val'+ val + '--'+ oldVal)
                                return moment(val).format('MM-DD-YYYY');
                            }
                        },
                        momentfilter: {
                            read: function(val) {
                                    console.log('read-val'+ val )

                                return 	val ?  moment(val).format('MM-DD-YYYY') : '';
                            },
                            write: function(val, oldVal) {
                                console.log('write-val'+ val + '--'+ oldVal)

                                return moment(val).format('YYYY-MM-DD');
                            }
                        },
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
