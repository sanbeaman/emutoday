<template>
  <div>


  <input type="text"
    v-model="query"
    v-on="keyup: search">

  <div class="results">
    <div v-for="item in buildings">
      <p>{{ item.name }}</p>
      </div>
    </div>
    <autocomplete
      name="buildings"
      url="fetch/buildings"
      anchor="name"
      label="alias"
      model="vModelLike">
  </autocomplete>
  </div>
</template>
<script>
import Autocomplete from './vue-autocomplete.vue'
  export default {
      components: { Autocomplete },
      props: ['buildings'],
      data() {
      return {
        vModelLike: "",
        data: {}
      };
    },


    ready() {
      this.$http.get('fetch/buildings')
        .then(function (response) {

        //get status
        response.status;

        //get all headers
        response.headers('expires');

        //set data on vm
        this.$set('buildings', response.data)

        }, function (response) {

        //error call back
        });

    },

    methods: {
      search() {

      }
    }
  }

</script>
