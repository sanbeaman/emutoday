<template>
  <div class="eventview">
    <h6>{{item.title}}</h6>
    <template v-if="item.all_day">
      <p>All Day</p>
    </template>
    <template v-else>
      <p v-if="item.no_end_time">{{item.start_time}}</p>
      <p v-else>
        From: {{item.start_time}} to {{item.end_time}}
      </p>
    </template>
    <p>{{item.location}}</p>
    <p>Building:{{item.building}}</p>
    <p class="description">{{item.description}}</p>
    <p>Contact</p>
    <ul>
      <li>{{item.contact_person}}</li>
      <li>Phone: {{item.contact_phone}}</li>
      <li>Email: {{item.contact_email}}</li>
    </ul>
    <template v-if="item.related_link_1">
      <p>Additional Information</p>
      <ul>
        <li>{{item.related_link_1}}</li>
        <li v-if="item.related_link_2">{{item.related_link_2}}</li>
      <li v-if="item.related_link_3">{{item.related_link_3}}</li>
      </ul>
    </template>
    <p v-if="item.free">Cost: Free</p>
    <p v-else>Cost: {{item.cost | currency }}</p>
    <p>{{item.participants}}</p>
    <p>LBC Approved:{{item.lbc_approved | yesNo }}</p>
    <template v-if="item.tickets">
      <p v-if="item.ticket_details_online">For Tickets Visit: {{item.ticket_details_online}}</p>
      <p v-if="item.ticket_details_phone">For Tickets Call: {{item.ticket_details_phone}}</p>
      <p v-if="item.ticket_details_office">For Tickets Office: {{item.ticket_details_office}}</p>
      <p v-if="item.ticket_details_other">Or: {{item.ticket_details_other}}</p>
    </template>
    </p>{{item.id}}</p>
  </div>

</template>
<style>
.eventview {
  padding-top: 0.8rem;
  padding-bottom: 0.3rem;
  border-bottom: 1px dotted  #bebdbd;
}
h6 {
  color: #0f654a;
}
p {
  padding: 0;
  margin:0;
  line-height: 1.4rem;
  font-size: 1rem;
}
p.description {
  padding-left: 1rem;
}
</style>
<script>
module.exports  = {
  data: function() {
    return {
      eventRange: {}
    }
  },
  filters: {
    reformatDate: function (value) {
      var arr = value.split('-');
      return arr[1] + '/' + arr[2] + '/' + arr[0];
    },
    yesNo: function(value) {
      return (value == true) ? 'Yes' : 'No';
    }
  },
  props:
  ['item','$index']
  ,
  computed: {

  },
  methods: {
    sortKeyInt: function ($key) {
     return parseInt($key);
   }
 },
watch: {

},
created: function() {

},
components: {

},
events: {

	}
};
</script>
