<template>
    <form>
        <slot name="csrf"></slot>
        <!-- <slot name="author_id" v-model="newevent.author_id"></slot> -->
        <div class="row">
            <div :class="md12col">
                <div v-show="formMessage.isOk"  class="callout success">
                    <h5>{{formMessage.msg}}</h5>
                </div>
                <div class="form-group">
                    <label>Title <span :class="iconStar" class="reqstar"></span></label>
                    <p class="help-text" id="title-helptext">Please enter a title ({{titleChars}} characters left)</p>
                    <input v-model="newevent.title" class="form-control" :class="[formErrors.title ? 'invalid-input' : '']"  name="title" type="text">
                    <p v-if="formErrors.title" class="help-text invalid">	Please Include a Title!</p>
                </div>
                <div class="form-group">
                    <label>Short Title	</label>
                    <input v-model="newevent.short_title" class="form-control" type="text" placeholder="Short Title" name="short-title" >
                </div>
            </div><!-- /.md12col -->
        </div><!-- /.row -->
        <div class="row">
            <div :class="md6col">
                <div class="form-group">
                    <label>Is Event on Campus?
                        <input id="on-campus-yes" name="on_campus" type="checkbox" value="1" v-model="newevent.on_campus"/>
                    </label>
                </div>
            </div><!-- /.md6col -->
            <div :class="md6col">

            </div><!-- /.md6col -->
        </div><!-- /.row -->
        <div class="row">
            <div :class="md12col">
                <template v-if="isOnCampus">
                    <div class="row">
                        <div :class="md8col">
                            <label>Building</label>
                            <select id="select-zbuilding" class="js-example-basic-multiple" style="width: 100%" v-myselect="zbuildings"  ajaxurl="/api/zbuildings" v-bind:resultvalue="buildings" data-tags="false" multiple="multiple" data-maximum-selection-length="1">
                                <!-- <option value="0">default</option> -->
                            </select>
                        </div><!-- /.md8col -->
                        <div :class="md4col">
                            <label>Room</label>
                            <input v-model="newevent.room" :class="[formErrors.room ? 'invalid-input' : '']" name="room" type="text">

                        </div><!-- /.md4col -->
                    </div><!-- /.row -->
                </template>
                <div class="row">
                    <div :class="md12col">
                        <template v-if="isOnCampus">
                            <label>Location <span :class="iconStar" class="reqstar"></span></label>
                            <input v-model="computedLocation" class="form-control" :class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text" readonly="readonly">
                        </template>
                        <template v-else>
                            <label>Location <span :class="iconStar" class="reqstar"></span></label>
                            <input v-model="newevent.locationoffcampus" class="form-control" :class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text">
                        </template>
                    </div><!-- /.md12col -->
                </div><!-- /.row -->
            </div><!-- /.md12col -->
        </div><!-- /.row -->
        <div class="row">
            <div :class="md6col">
                <div class="form-group">
                    <label for="start-date">Start Date: <span :class="iconStar" class="reqstar"></span></label>
                    <input id="start-date" :class="[formErrors.start_date ? 'invalid-input' : '']" type="text" v-model="newevent.start_date" aria-describedby="errorStartDate" />
                    <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
                </div><!--form-group -->
            </div><!-- /.md6col -->
            <div :class="md6col">
                <div class="form-group">
                    <label for="end-date">End Date: <span :class="iconStar" class="reqstar"></span></label>
                    <input id="end-date" :class="[formErrors.end_date ? 'invalid-input' : '']" type="text" v-model="newevent.end_date"  aria-describedby="errorEndDate" />
                    <!-- <datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate"></datepicker> -->
                    <p v-if="formErrors.end_date" class="help-text invalid">Need an End Date</p>

                </div><!--form-group -->
            </div><!-- /.md6col -->
        </div><!-- /.row -->

        <div class="row">
            <div :class="md6col">
                <div class="form-group">
                    <label for="all-day">All Day Event:
                        <input id="all-day" name="all_day" type="checkbox" value="1" v-model="newevent.all_day"/>
                    </label>
                </div>
            </div><!-- /.small-6 column -->
            <div :class="md6col">
                <div v-show="hasEndTime" class="form-group">
                    <label for="no-end-time">No End Time:
                        <input id="no-end-time" name="no_end_time" type="checkbox" value="1" v-model="newevent.no_end_time"/>
                        <!-- <label for="no-end-time-no" class="radiobtns">no</label><input id="no-end-time-no"  name="no_end_time" type="radio" value="0" v-model="newevent.no_end_time"/> -->
                    </div>
                </div><!-- /.small-6 column -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md6col">
                    <div v-show="hasStartTime" class="form-group">
                        <label for="start-time">Start Time: <span :class="iconStar" class="reqstar"></span></label>
                        <input id="start-time" class="form-control" type="text" v-model="newevent.start_time" />
                    </div><!-- /.form-group -->
                </div><!-- /.md6col -->
                <div :class="md6col">
                    <div v-show="hasEndTime" class="form-group">
                        <label for="end-time">End Time: <span :class="iconStar" class="reqstar"></span></label>
                        <input id="end-time" class="form-control" type="text" v-model="newevent.end_time" />
                    </div><!-- /.form-group -->
                </div><!-- /.md6col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md12col">
                    <div class="form-group">
                        <label>Categories: <span :class="iconStar" class="reqstar"></span></label>
                        <select  :class="[formErrors.categories ? 'invalid-input' : '']" id="select-zcats" style="width: 100%" v-myselect="zcategories" v-bind:resultvalue="zcats" ajaxurl="/api/zcats" data-close-on-select="false" data-placeholder="zcats" data-tags="false"  multiple="multiple">
                            <option value="0">
                                default
                            </option>
                        </select>

                    </div><!-- /.form-group -->
                </div><!-- /.md12col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md6col">
                    <div class="form-group">
                        <label>Contact Person <span :class="iconStar" class="reqstar"></span>
                            <input v-model="newevent.contact_person" class="form-control" :class="[formErrors.contact_person ? 'invalid-input' : '']" name="contact-person" type="text">
                            <p v-if="formErrors.contact_person" class="help-text invalid">Need a Contact Person!</p>
                        </label>
                    </div>
                </div><!-- /.md6col -->
                <div :class="md6col">
                    <div class="form-group">
                        <label>Contact Email: <span :class="iconStar" class="reqstar"></span><em>(ex.janedoe@emich.edu)</em>
                            <input v-model="newevent.contact_email" class="form-control" :class="[formErrors.contact_email ? 'invalid-input' : '']" name="contact-email" type="text">
                            <p v-if="formErrors.contact_email" class="help-text invalid">Need a Contact Email!</p>
                        </label>
                    </div>
                </div><!-- /.md6col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md6col">
                    <div class="form-group">

                        <label>Contact Phone <span :class="iconStar" class="reqstar"></span> <em>(ex. 734.487.1849)</em>
                            <input v-model="newevent.contact_phone" class="form-control" :class="[formErrors.contact_phone ? 'invalid-input' : '']" name="contact-phone" type="text">
                            <p v-if="formErrors.contact_phone" class="help-text invalid">Need a Contact Phone!</p>
                        </label>
                    </div>
                </div><!-- /.md6col -->
                <div :class="md6col">
                    <div class="form-group">
                        <label>Contact Fax: <em>(ex. 734.487.1849)</em>
                            <input v-model="newevent.contact_fax" class="form-control" :class="[formErrors.contact_fax ? 'invalid-input' : '']" name="contact-fax" type="text">
                        </label>
                    </div>
                </div><!-- /.md6col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md12col">
                    <div :class="formGroup">
                        <label>Related Link: <em>(ex. http://www.emich.edu/calendar)</em></label>
                        <div class="row">
                            <div :class="md6col">
                                <label for="link_text_1">Link Text</label><input v-model="linkText1" class="form-control" name="link_text_1" type="text">
                            </div><!-- /.md6col -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div :class="md12col">
                                <label for="link_url_1">Link URL</label><input v-model="linkUrl1" class="form-control" name="link_url_1" type="text">
                            </div><!-- /.md12col -->
                        </div><!-- /.row -->
                        {{relatedLink1}}
                    </div>
                        <!-- <label>Related Link: <em>(ex. http://www.emich.edu/calendar)</em>
                            <label for="link_text_2">Link Text</label><input v-model="linkText2"  name="link_text_2" type="text">
                            <label for="link_url_2">Link URL</label><input v-model="linkUrl2"  name="link_url_2" type="text">
                        </label>{{relatedLink2}}
                        <label>Related Link: <em>(ex. http://www.emich.edu/calendar)</em>
                            <label for="link_text_3">Link Text</label><input v-model="linkText3"  name="link_text_3" type="text">
                            <label for="link_url_3">Link URL</label><input v-model="linkUrl3"  name="link_url_3" type="text">
                        </label>{{relatedLink3}} -->

                </div><!-- /.md12col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md6col">
                    <div class="form-group">
                        <label for="reg-deadline">Registration Deadline</label>
                        <input id="reg-deadline" type="text" v-model="newevent.reg_deadline" :value.sync="rdate" aria-describedby="errorRegDeadline"  />
                    </div>
                </div><!-- /.md6col-->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md12col">

                    <div class="row">
                        <div :class="md2col">
                            <label>Free</label>
                            <div :class="formGroup">
                                <input id="free" name="free" type="checkbox" value="1" v-model="newevent.free"/>
                            </div><!-- /.form-group -->
                        </div><!-- /.md4col -->
                        <div :class="md10col">
                            <label>Event Cost <span :class="iconStar" class="reqstar"></span></label>
                            <div v-show="hasCost" class="form-group">
                                <div class="input-group">
                                    <span class="input-group-label">$</span>
                                    <input v-model="newevent.cost" class="form-control" :class="[formErrors.cost ? 'invalid-input' : '']" name="event-cost"  type="number">
                                </div><!-- /. input-group -->
                            </div>
                            <div v-else :class="formGroup">
                                <div class="input-group">
                                    <span class="input-group-label">$</span>
                                    <input v-model="newevent.cost" :class="[formErrors.cost ? 'invalid-input' : '']" name="event-cost"  type="number" readonly="readonly">
                                </div><!-- /. input-group -->
                            </div>
                        </div><!-- /.md8col -->
                    </div><!-- /.row -->


                </div><!-- /.medium-6 -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md12col">
                    <div :class="formGroup">
                        <label>Tickets Available
                            <select v-model="newevent.tickets">
                                <option v-for="ticketoption in ticketoptions" :value="ticketoption.value">
                                    {{ ticketoption.text }}
                                </option>
                            </select>
                        </label>
                        <template v-if="newevent.tickets == 'online' || newevent.tickets == 'all'">
                            <label>Link: <em>(ex. http://www.emich.edu/calendar)</em>
                                <input v-model="newevent.ticket_details_online" class="form-control" :class="[formErrors.ticket_details_online ? 'invalid-input' : '']" name="ticket-details-online" type="text">
                            </label>
                        </template>
                        <template v-if="newevent.tickets == 'phone' || newevent.tickets == 'all'">
                            <label>Tickets by Phone <em>(ex. 734.487.1849)</em>
                                <input v-model="newevent.ticket_details_phone" class="form-control" :class="[formErrors.ticket_details_phone ? 'invalid-input' : '']" name="ticket-details-phone" type="text">
                            </label>
                        </template>
                        <template v-if="newevent.tickets == 'office' || newevent.tickets == 'all'">
                            <label>Address
                                <input v-model="newevent.ticket_details_office" class="form-control" :class="[formErrors.ticket_details_office ? 'invalid-input' : '']" name="ticket-details-office" type="text">
                            </label>
                        </template>
                        <template v-if="newevent.tickets == 'other'">
                            <label>Other
                                <input v-model="newevent.ticket_details_other" class="form-control" :class="[formErrors.ticket_details_other ? 'invalid-input' : '']" name="ticket-details-other" type="text">
                            </label>
                        </template>
                    </div><!-- /.form-group -->
                </div><!-- /.md12col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md12col">
                    <div :class="formGroup">
                        <label>Participants</label>
                            <v-select :value="newevent.participants"
                                        :options="participants"
                                        :searchable="false"
                            >
                                <!-- <option v-for="participant in participants" v-bind:value="participant.value">
                                    {{ participant.text }}
                                </option> -->
                            </v-select>

                    </div>
                </div><!--/.md12col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md6col">
                    <div :class="formGroup">
                        <label for="lbc-reviewed">LBC Approved: <em>(pre-approval required)</em>
                            <input id="lbc-reviewed" name="lbc-reviewed" type="checkbox" value="1" v-model="newevent.lbc_reviewed"/>
                        </label>
                    </div>
                </div><!-- /.md6col -->
                <div :class="md6col">

                </div><!-- /.md6col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md12col">
                    <div :class="formGroup">
                        <label>Description <span :class="iconStar" class="reqstar"></span> <p class="help-text" id="description-helptext">({{descriptionChars}} characters left)</p>

                            <textarea v-model="newevent.description" class="form-control" :class="[formErrors.description ? 'invalid-input' : '']" name="description" type="textarea" rows="6"></textarea>
                        </label>
                        <p v-if="formErrors.description" class="help-text invalid">Need a Description!</p>

                    </div>
                </div><!-- /.md12col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md12col">

                    <div :class="formGroup">
                        <label>Group Website Calendar <p class="help-text" id="minicalendar-helptext">If your groups website has a calendar that is fed from this one, and you would like this event to show up on it, please select it from the list below:</p>
                            <v-select
                                :debounce="250"
                                :value="newevent.mini_calendar"
                                :on-search="fetchForSelectMiniCalendarList"
                                :options="minicals"
                                placeholder="Select a minicalendar..."
                                label="calendar">
                            </v-select>
                        </label>
                    </div>
                </div><!-- /.md12col -->

                <div :class="md12col">

                    <!-- <div :class="formGroup">
                        <label>Group Website Calendar <p class="help-text" id="minicalendar-helptext">If your groups website has a calendar that is fed from this one, and you would like this event to show up on it, please select it from the list below:</p>
                            <select v-model="newevent.mini_calendar" id="mini_calendar" v-myselect="mini_calendar">
                                <option v-for="minicalendar in minicalendars" :value="minicalendar.id">
                                    {{minicalendar.calendar}}
                                </option>
                            </select>
                        </label>
                    </div> -->
                </div><!-- /.md12col -->
            </div><!-- /.row -->
            <div class="row">
                <div :class="md12col">
                    <div :class="formGroup">
                        <button id="btn-event" @click="submitForm" type="submit" :class="btnPrimary">Submit For Approval</button>
                    </div>
                </form>
            </div><!-- /.md12col -->


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
            /*width: 8em;*/
            vertical-align: top;
        }
        /*input[type='text'], [type='password'],
        [type='date'], [type='datetime'],
        [type='datetime-local'], [type='month'],
        [type='week'], [type='email'],
        [type='number'], [type='search'],
        [type='tel'], [type='time'],
        [type='url'], [type='color'],
        textarea {
        marging-bottom: 0;
        }*/

        .input-group input[type='text'] {
            marging-bottom: 0;
        }

        input[type='number'] {
            marging-bottom: 0;
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
        .reqstar {
            font-size: .7rem;
            color: #E33100;
            vertical-align:text-top;
        }

        select {
            margin: 0;
        }

        [type='submit'], [type='button'] {
            margin-top: 0.8rem;
        }
        input[type="number"]{
            margin: 0;
        }
        input[type="text"]{
            margin: 0;
        }

        </style>

        <script>

        import flatpickr from "flatpickr"
        import vSelect from "vue-select"
        import myselect from "../directives/myselect.js"
        module.exports  = {
            directives: {
                myselect
            },
            components: {
                vSelect
            },
            props:{
                authorid: {default : '0'},
                recordexists: {default: false},
                editid: {default: ''},
                framework: {default: 'foundation'}
            },
            data: function() {
                return {
                    linkText1: '',
                    linkUrl1: '',
                    linkText2: '',
                    linkUrl2: '',
                    linkText3: '',
                    linkUrl3:'',
                    startdatePicker:null,
                    enddatePicker:null,
                    starttimePicker:null,
                    endtimePicker:null,
                    regdeadlinePicker:null,
                    sdate: '',
                    edate: '',
                    stime: '',
                    rdate: '',
                    ticketoptions: [
                        { text: 'Online', value: 'online'},
                        { text: 'Phone', value: 'phone'},
                        { text: 'Ticket Office', value: 'office'},
                        { text: 'Online, Phone and Ticket Office', value: 'all'},
                        { text: 'Other', value: 'other'},
                    ],
                    participants: [
                        { label: 'Campus Only', value: 'campus'},
                        { label: 'Open to Public', value: 'public'},
                        { label: 'Students Only', value: 'students'},
                        { label: 'Invitation Only', value: 'invite'},
                        { label: 'Tickets Required', value: 'tickets'},
                    ],
                    totalChars: {
                        start: 0,
                        title: 100,
                        description: 255
                    },
                    newbuilding: '',
                    zcategories: [],
                    zbuildings: [],
                    buildings: [],
                    zcats: [],
                    categories: {},
                    minicals: null,
                    minicalendars: {},
                    newevent: {
                        on_campus: 1,
                        all_day: 0,
                        no_end_time: 0,
                        free: 0,
                        title: '',
                        description: '',
                        mini_calendar: ''
                    },
                    response: {

                    },
                    formStatus: {},
                    vModelLike: "",
                    formMessage: {
                        isOk: false,
                        msg: ''
                    },
                    formInputs : {},
                    formErrors : {}
                }
            },
            ready: function() {
                this.newevent.user_id = this.authorid;
                var self = this;


                this.startdatePicker = flatpickr(document.getElementById("start-date"),{
                    minDate: "today",
                    enableTime: false,
                    altFormat: "m-d-Y",
                    altInput: true,
                    altInputClass:"form-control",
                    dateFormat: "Y-m-d",
                    onChange(dateObject, dateString) {
                        self.newevent.start_date = dateString;
                        self.startdatePicker.value = dateString;
                    }

                });
                this.enddatePicker = flatpickr(document.getElementById("end-date"),{
                    minDate: "today",
                    enableTime: false,
                    altFormat: "m-d-Y",
                    altInput: true,
                    altInputClass:"form-control",
                    dateFormat: "Y-m-d",
                    onChange(dateObject, dateString) {
                        self.newevent.end_date = dateString;
                        self.enddatePicker.value = dateString;
                    }

                });
                this.starttimePicker = flatpickr(document.getElementById("start-time"),{
                    noCalendar: true,
                    enableTime: true,
                    onChange(timeObject, timeString) {
                        self.newevent.start_time = timeString;
                        self.starttimePicker.value = timeString;
                    }

                });
                this.endtimePicker = flatpickr(document.getElementById("end-time"),{
                    noCalendar: true,
                    enableTime: true,
                    onChange(timeObject, timeString) {
                        self.newevent.end_time = timeString;
                        self.endtimePicker.value = timeString;
                    }

                });

                this.regdeadlinePicker = flatpickr(document.getElementById("reg-deadline"),{
                    minDate: "today",
                    enableTime: false,
                    altFormat: "m-d-Y",
                    altInput: true,
                    altInputClass:"form-control",
                    dateFormat: "Y-m-d",
                    onChange(dateObject, dateString) {
                        self.record.reg_deadline = dateString;
                        self.regdeadlinePicker.value = dateString;
                    }

                });
                //  this.fetchCategoryList();
                // console.log('editevent='+ this.editevent)
                console.log('eventexists'+ this.eventexists)

                if(this.eventexists){
                    console.log('editeventid'+ this.editeventid)
                    this.fetchCurrentEvent(this.editeventid)

                }


                //this.fetchMiniCalendarList();
            },


            computed: {
                md6col: function () {
                    return (this.framework == 'foundation')? 'medium-6 columns':'col-md-6'
                },
                md12col: function () {
                    return (this.framework == 'foundation')? 'medium-12 columns':'col-md-12'
                },
                md8col: function () {
                    return (this.framework == 'foundation')? 'medium-8 columns':'col-md-8'
                },
                md4col: function () {
                    return (this.framework == 'foundation')? 'medium-4 columns':'col-md-4'
                },
                md2col: function () {
                    return (this.framework == 'foundation')? 'medium-2 columns':'col-md-2'
                },
                md10col: function () {
                    return (this.framework == 'foundation')? 'medium-10 columns':'col-md-10'
                },
                btnPrimary: function() {
                    return (this.framework == 'foundation')? 'button button-primary':'btn btn-primary'
                },
                formGroup: function() {
                    return (this.framework == 'foundation')? 'form-group':'form-group'
                },
                iconStar: function() {
                    return (this.framework == 'foundation')? 'fi-star':'fa fa-star'
                },
                computedLocation: function() {
                    if (this.zbuildings) {
                        this.newevent.building  = (this.zbuildings.length > 0)?this.zbuildings[0]:'';
                        buildingChoice = 	this.newevent.building
                    } else {
                        return
                    }
                    var room = (this.newevent.room)?' - Room:' + this.newevent.room:'';
                    return buildingChoice + room;
                    // return this.zbuilding[0] + room
                },
                isOnCampus: function() {
                    return this.newevent.on_campus == 1 ? true:false;
                },
                realCost: function() {
                    if(this.newevent.free == 1 ) {
                        return '0.00';
                    } else {
                        // this.newevent.cost = '';
                        return '';
                    }
                    // return this.newevent.free == 1 ? false:true;
                },
                hasCost: function() {
                    if(this.newevent.free == 1 ) {
                        this.newevent.cost = '0.00';
                        return false;
                    } else {
                        // this.newevent.cost = '';
                        return true;
                    }
                    // return this.newevent.free == 1 ? false:true;
                },
                titleChars: function() {
                    var str = this.newevent.title;
                    console.log(str.length);
                    var cclength = str.length;
                    return this.totalChars.title - cclength;
                    // this.totalChars.title - (this.newevent.title).length
                },
                descriptionChars: function() {
                    var str = this.newevent.description;
                    console.log(str.length);
                    var cclength = str.length;
                    return this.totalChars.description - cclength;
                    // this.totalChars.title - (this.newevent.title).length
                },
                hasStartTime: function() {
                    return this.newevent.all_day == 1? false : true;

                },
                hasEndTime: function() {
                    return (this.newevent.all_day == 1 || this.newevent.no_end_time == 1)?false : true;
                },
                relatedLink1: function() {
                    if (this.linkUrl1 || this.linkText1) {
                        return '<a href="'+ this.linkUrl1 +'">'+ this.linkText1 +'</a>'
                    }
                },
                relatedLink2: function() {
                    if (this.linkUrl2 || this.linkText2) {
                        return '<a href="'+ this.linkUrl2 +'">'+ this.linkText2 +'</a>'
                    }
                },
                relatedLink3: function() {
                    if (this.linkUrl3 || this.linkText3) {
                        return '<a href="'+ this.linkUrl3 +'">'+ this.linkText3 +'</a>'
                    }
                },

            },
            methods: {
                fetchCurrentEvent: function() {
                    this.$http.get('/api/event/'+ this.editeventid)

                    .then((response) =>{
                        //response.status;
                        console.log('response.status=' + response.status);
                        console.log('response.ok=' + response.ok);
                        console.log('response.statusText=' + response.statusText);
                        // console.log('response.data=' + response.data.json());
                        this.newevent = response.data;

                        this.checkOverData();
                    }, (response) => {
                        //error callback
                        console.log("ERRORS");

                        // this.formErrors =  response.data.error.message;

                    }).bind(this);
                },
                checkOverData: function() {

                    if (this.newevent.building) {
                        this.buildings.push(this.newevent.building);
                    }
                    if (this.newevent.room) {
                        this.newevent.room = this.newevent.room;
                    }

                    if (this.newevent.eventcategories){
                        for (var i= 0; i < this.newevent.eventcategories.length ; i++){
                            var reduceobj = this.newevent.eventcategories[i].id;
                            this.zcats.push(reduceobj)

                        }

                        console.log('this.zcats'+ this.zcats.length)
                    }

                    // this.newbuilding = this.newevent.building;
                    // this.zbuilding.push(this.newevent.building);

                },
                fetchForSelectMiniCalendarList(search,loading) {
                    loading(true)
                    this.$http.get('/api/minicals',{
                        q: search
                    }).then(resp => {
                        this.minicals = resp.data;
                        loading(false)
                    })
                },
                fetchMiniCalendarList: function() {
                    this.$http.get('/api/minicalendars').then(function(response){
                        // console.log('response->minicalendars=' + JSON.stringify(response.data));
                        this.minicalendars = response.data.data;

                    }, function(response) {
                        //  this.$set(this.formErrors, response.data);
                        console.log(response);
                    });
                },

                submitForm: function(e) {
                    //  console.log('this.eventform=' + this.eventform.$valid);
                    e.preventDefault();
                    // this.newevent.start_date = this.sdate;
                    // this.newevent.end_date = this.edate;
                    // this.newevent.reg_deadline = this.rdate;
                    this.newevent.author_id = this.authorid;
                    this.newevent.related_link_1 = this.relatedLink1;
                    if(this.newevent.on_campus == true) {
                        this.newevent.location = this.computedLocation;
                    } else {
                        this.newevent.location = this.newevent.locationoffcampus;
                    }
                    // this.newevent.location = (this.on_campus)?this.computedLocation: this.newevent.location;
                    this.newevent.categories = this.zcategories;
                    console.log("cats="+ this.newevent.categories);
                    this.$http.post('/api/event', this.newevent)

                    .then((response) =>{
                        //response.status;
                        console.log('response.status=' + response.status);
                        console.log('response.ok=' + response.ok);
                        console.log('response.statusText=' + response.statusText);
                        console.log('response.data=' + response.data.message);
                        this.formMessage.msg = response.data.message;
                        this.formMessage.isOk = response.ok;
                    }, (response) => {
                        //error callback
                        // console.log("FORM ERRORS     "+ response.json() );

                        this.formErrors =  response.data.error.message;

                    }).bind(this);
                }
            },

            watch: {

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
