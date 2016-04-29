<template>
  <div>
    <h2>EventForm</h2>
    <typeahead inline-template>
    <div class="typeahead">
      <div class="column row">


        <!-- optional indicators -->
        <i class="fa fa-spinner fa-spin" v-if="loading"></i>
        <template v-else>
            <i class="fa fa-search" v-show="isEmpty"></i>
            <i class="fa fa-times" v-show="isDirty" @click="reset"></i>
        </template>
        <div class="small-6 columns">
          <!-- the input field -->
          <input type="text"
                 placeholder="..."
                 autocomplete="on"
                 v-model="query"
                 @keydown.down="down"
                 @keydown.up="up"
                 @keydown.enter="hit"
                 @keydown.esc="reset"
                 @blur="reset"
                 @input="update"/>


          <!-- the list -->
          <ul v-show="hasItems">
              <li v-for="item in items" :class="activeClass($index)" @mousedown="hit" @mousemove="setActive($index)">
                  <span class="name" v-text="item.name"></span>
              </li>
          </ul>
        </div>
        <div class="small-6 columns">
          <span>{{building}}</span>
        </div>

        </div>
    </div>
</typeahead>

  </div>
</template>
<style>
  .typeahead ul  {
    list-style-type: none;
    border: 1px solid #ddd;
  }
  .typeahead ul li.active {
    background-color: #ccc;
  }
</style>

<script>

import VueTypeaheadMixin from 'vue-typeahead'

export default {
  components: {
    'typeahead': {
      props: ['building'],
      mixins: [VueTypeaheadMixin],
      data:function() {
        return {
          src: 'fetch/buildings',
          data: {},
          onHit (item) {
            this.building = item.name;


          },
          prepareResponseData(data){
            // data =
            return data;
          },

        }
      },
      methods: {

      }
    }
  }
}
</script>
