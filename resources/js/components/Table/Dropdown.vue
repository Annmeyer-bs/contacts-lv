<template>
  <div class="dropdown" ref="dropMenu">
    <div class="dropdown-trigger" @click="visible = !visible">
      <slot name="trigger"></slot>
    </div>

    <transition name="pop-out-quick">
      <ul v-show="visible" class="ul down-right absolute mt-2 rounded text-white z-10">
        <slot>

        </slot>
      </ul>
    </transition>

  </div>
</template>
<script>
export default {

  data(){
    return{
      visible:false,
    }
  },
  methods:{
    // documentClick(e){
    //   let el = this.$refs.dropMenu
    //   let target = e.target
    //   if (( el !== target) && !el.contains(target)) {
    //     this.visible=false
    //   }
    // }
  },
  created () {
    document.addEventListener('click', this.documentClick)
  },
  destroyed () {
    // important to clean up!!
    document.removeEventListener('click', this.documentClick)
  }
}
</script>

<style>
.pop-out-quick-enter-active, .pop-out-quick-leave-active {
  transition: all .4s;
}
.pop-out-quick-enter-active, .pop-out-quick-enter, .pop-out-quick-leave, .pop-out-quick-leave-active {
  opacity: 0;
  transform: translateX(7px);
}
.ul {
  padding-left: 0;
}
</style>
