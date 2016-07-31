<template>
    <div class="row">
            <div class="col-md-6">
                <div id="dragcontainer">
                  <div id="box1" class="dragbox">box1</div>
                  <div id="box2" class="dragbox">box2</div>
                  <div id="box3" class="dragbox">box3</div>
                </div>
            </div><!-- /.col-md-6 -->
            <div class="col-md-6">

            </div><!-- /.col-md-6 -->
    </div><!-- ./row -->
</template>
<style scoped>
#dragcontainer {
  position:relative;
}
.dragbox {
  position:absolute;
  width: 200px;
  height: 80px;
  text-align: center;
  line-height: 80px;
  font-size: 20px;
  color: white;
  border-radius:10px;
  border: 2px solid black;
}
#box1 {
    background-color: red;
  top:0px;
}
#box2 {
    background-color: blue;
  top:88px;
}
#box3 {
  background-color:green;
  top:176px;
}
</style>
<script>
// import { TweenLite, Elastic, CSSPlugin, TimelineLite } from "gsap";
require ("Draggable");
      export default  {
        components: {

        },
        props: [
        ],
        ready() {
            this.droppables = $(".dragbox");

            // TweenLite.to($(".dragbox"), 1, { x: 400, ease: Elastic.easeInOut });

            Draggable.create(this.droppables, {
              bounds:window,
              onDrag: function(e) {
                var i = Object.keys(this.droppables).length;
                     while (--i > -1) {
                   if (this.hitTest(this.droppables[i], this.overlapThreshold)) {
                     $(this.droppables[i]).addClass("highlight");
                   } else {
                     $(this.droppables[i]).removeClass("highlight");
                   }

                   /* ALTERNATE TEST: you can use the static Draggable.hitTest() method for even more flexibility, like passing in a mouse event to see if the mouse is overlapping with the element...
                   if (Draggable.hitTest(droppables[i], e) && droppables[i] !== this.target) {
                     $(droppables[i]).addClass("highlight");
                   } else {
                     $(droppables[i]).removeClass("highlight");
                   }
                   */
                }
              },
              onDragEnd:function(e) {
                    var i = this.droppables.length;
                    while (--i > -1) {
                        if (this.hitTest(this.droppables[i], overlapThreshold)) {
                            this.onDrop(this.target, this.droppables[i]);
                        }
                    }
                }
            });




        },
        data: function() {
          return {
              overlapThreshold: "50%",
              droppables : [],
              allitems: []
            }
        },
        computed: {


        },
        methods : {
            fetchAllRecords: function() {
                this.$http.get('/api/story/listall')

                    .then((response) =>{
                            //response.status;
                            console.log('response.status=' + response.status);
                            console.log('response.ok=' + response.ok);
                            console.log('response.statusText=' + response.statusText);
                            console.log('response.data=' + response.data);
                            // data = response.data;
                            //
                            this.$set('allitems', response.data.data)

                            // this.allitems = response.data.data;
                            // console.log('this.record= ' + this.record);

                            //this.checkOverDataFilter();
                        }, (response) => {
                            //error callback
                            console.log("ERRORS");

                            //  this.formErrors =  response.data.error.message;

                        }).bind(this);
                    },
            onDrop: function(dragged, dropped) {
              TweenMax.fromTo(dropped, 0.1, {opacity:1}, {opacity:0, repeat:3, yoyo:true});
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
