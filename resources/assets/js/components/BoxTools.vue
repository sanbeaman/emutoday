<template>

<div class="toolbar-row">
    <div class="toolbar-block">
        <span v-if="isDirty" class="label label-danger">Need to Save before leaving</span>

    </div><!-- /.tool-block -->
    <div class="toolbar-block pull-right">
        <div class="btn-toolbar btn-group-sm ">

            <button id="btn-preview-{{id}}" @click="viewPreview" :disabled="canPreview" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></button>
            <button id="btn-new-{{id}}" @click="createNew" :disabled="canCreate" class="btn bg-orange btn-sm"><i class="fa fa-plus-square"></i></button>
            <button id="btn-list-{{id}}" @click="viewList" :disabled="canListView" class="btn bg-orange btn-sm"><i class="fa fa-list-alt"></i></button>
        </div><!-- /.btn-toolbar -->
    </div><!-- /.toolbar-block -->
</div><!-- /.center-text -->

</template>
<style>
.toolbar-row {
  width: 100%;
text-align: right;
}

.toolbar-block {

  display: inline-block;
}​
#items-unapproved .box {
    margin-bottom: 4px;
}
#items-approved .box {
    margin-bottom: 4px;

}
</style>
<script>
import { getCount, getMessage, getRecordState } from '../vuex/getters'

export default  {
    vuex: {
        getters: {
            // note that you're passing the function itself, and not the value 'getCount()'
            counterValue: getCount,
            thisMessage: getMessage,
            thisRecordState: getRecordState

        },
    },

    props: [
        'isnotdirty',
        'rte',
        'formView',
        'currentUser',
        'role',
        'recordId'
    ],
    ready() {
        console.log('BoxTools')
    },
    data: function() {
        return {

        }
    },
    computed: {
        isDirty: function() {
            if(this.thisRecordState == 'dirty'){
                return true
            } else {
                return false
            }
        },
        canCreate: function() {
            if(this.formView === 'create'){
                return true
            } else {
                return false
            }


        },
        canListView: function() {
            if(this.formView != 'list' ){
                return false
            } else {
                return true
            }

        },
        canPreview: function() {
            if(this.formView === 'edit'){
                return false
            } else {
                return true
            }
        },
    },

    methods : {
        // checkIndexWithValue: function (chitem){
        // 	return
        // },
        viewPreview: function(evt) {
            console.log('this.rte='+ this.rte)
        },
        viewList: function(evt) {
            var url = '/admin/story/' + this.rte +  '/'
            console.log(url);
            document.location = url;
        },
        createNew: function(evt) {
            console.log('this.rte='+ this.rte)
        },

    },


    // the `events` option simply calls `$on` for you
    // when the instance is created
    events: {

    }
}
</script>
