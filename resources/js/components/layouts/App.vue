<template>
  <div id="body">
    <Topbar/>
    <router-view/>
    <Footer/>
  </div>
</template>

<script>
import Topbar from './Topbar.vue'
import Footer from './Footer.vue'

export default {
  name: 'App',
  components: {
    Topbar,
    Footer
  }
}
</script>

<style>

</style>