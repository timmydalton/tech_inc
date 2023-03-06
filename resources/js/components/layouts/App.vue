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
      const url = `${import.meta.env.VITE_APP_API_URL}/account/login_token?token=${token}`
      axios.get(url, {headers: {"Accept":"application/json"}})
        .then(res => {
          if (res.status == 200) {
            this.$store.commit('account/set-account', res.data.data)
          }
        })
        .catch(err => {
          console.log(err, 'token failed')
          document.cookie = 'Token=; Max-Age=-99999999;';
        })
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
      fetchCategories: "categories/fetch-data"
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
