<template>
  <transition name="fade" mode="out-in">
    <div v-show="isActive">
      <slot>
      </slot>
    </div>
  </transition>
</template>

<script>
export default {
  data () {
    return {
      isActive: false
    }
  },

  props: {
    name: {
      required: true,
    },
    selected: {
      default: false
    }
  },

  mounted () {
    this.isActive = this.selected
  }
}  
</script>