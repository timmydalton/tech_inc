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
import axios from 'axios'
import { mapState, mapActions } from 'vuex'

export default {
  name: 'App',
  components: {
    Topbar,
    Footer
  },
  mounted() {
    const token = this.getCookie('Token')
    if (token) {
      this.fetchAccount({token: token})
    }

    this.fetchCategories()
  },
  computed: {
    ...mapState({
      account: state => state.account.data
    })
  },
  methods: {
    ...mapActions({
      fetchCategories: "categories/fetch-data",
      fetchAccount: "account/fetch-account"
    }),
    getCookie(cookieName) {
      let cookie = {};
      document.cookie.split(';').forEach(function(el) {
        let [key,value] = el.split('=');
        cookie[key.trim()] = value;
      })
      return cookie[cookieName];
    }
  }
}
</script>

<style>

</style>
