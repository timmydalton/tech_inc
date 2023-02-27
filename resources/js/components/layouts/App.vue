<template>
  <div id="body">
    <Topbar/>
    <router-view/>
  </div>
</template>

<script>
import Topbar from './Topbar.vue'

export default {
  name: 'App',
  components: {
    Topbar
  }
}
</script>

<style>

</style>