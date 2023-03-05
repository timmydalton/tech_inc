<template>
  <div class="bg-white p-3">
    <div class="container">
        <div class="row login-page">
            <div class="col-6">
                <p class="login_title"><b>Thông tin khách hàng đăng nhập hệ thống</b></p>
                <input type="hidden" name="login" id="login" value="yes">
                <input type="hidden" id="return_url" name="return_url" value="/taikhoan">
                <table cellpadding="5" cellspacing="0" width="100%" shadow="" cor="">
                    <tbody><tr>
                        <td style="width: 200px">Email đăng nhập</td>
                        <td><input v-model="username" type="text" size="25" name="email" id="email" class="form-control"></td>
                    </tr>

                    <tr>
                        <td style="width: 200px">Mật khẩu</td>
                        <td><input v-model="password" type="password" size="25" name="password" id="password" class="form-control"></td>
                    </tr>

                    <tr :style="{'transition': 'all ease .3s', 'overflow': 'hidden', 'display': visibleAlert ? 'contents' : 'none'}">
                        <td style="width: 200px"></td>
                        <td>
                            <a-alert :message="alert" :type="alertType" />
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 200px"></td>
                        <td>
                            <div style="position: relative;">
                                <input type="button" @click="handleLogin" value="Đăng nhập" class="btn btn-primary bg-green" style="color: #fff;border-color: transparent;">
                                <a href="">Quên mật khẩu ?</a>
                            </div>
                        </td>
                    </tr>
                </tbody></table>
            </div>

            <div class="col-6">
                <p><b>Bạn chưa là thành viên ?</b></p>
                <p>Đăng ký là thành viên để hưởng nhiều lợi ích và đặt mua hàng dễ dàng hơn.</p>
                <p><a title="Click đăng ký tài khoản miễn phí" href="/signup" class="bold"><b>Đăng ký tài khoản</b></a></p>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Login',
  data() {
    return {
      username: '',
      password: '',
      visibleAlert: false,
      alert: '',
      alertType: 'error'
    }
  },
  methods: {
    handleLogin() {
      if (!(this.username && this.password)) {
        this.showAlert('Chưa nhập tên tài khoản và mật khẩu!!!', 'error')
      }
      const url = `${import.meta.env.VITE_APP_API_URL}/account/login`
      const param = {
        username: this.username,
        password: this.password
      }
      axios.post(url, param)
        .then(res => {
          if (res.status == 200) {
            const user = res.data.data.user
            this.$store.commit('account/set-account', user)
            const token = res.data.data.token
            let d = new Date();
            d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000 * 360);
            let expires = "expires=" + d.toUTCString();
            document.cookie =
              "Token=" + token + ";" + expires + ";path=/";
            this.showAlert('Đăng nhập thành công, vui lòng đợi 3s!', 'success')
            this.$router.push('/')
          }
        })
        .catch(err => {
          if (err.response.status == 401) {
            this.showAlert('Tên đăng nhập hoặc mật khẩu không chính xác!', 'error')
          } else {
            this.showAlert('Ái chà bug server!', 'error')
          }
        })
    },
    showAlert(mes, type) {
      this.alert = mes
      this.visibleAlert = true
      this.alertType = type
      setTimeout(() => {
        this.visibleAlert = false
      }, 3000)
    }
  }
}
</script>

<style>

</style>
