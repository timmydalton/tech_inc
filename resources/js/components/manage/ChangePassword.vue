<template>
  <div style="display:contents">
      <h3>Thay đổi mật khẩu</h3>
        <table>
            <tbody><tr>
                <td width="150px">Nhập mật khẩu cũ</td>
                <td>
                    <input type="text" name="fullname" id="fullname" v-model="oldPass" class="form-input">
                </td>
            </tr>

            <tr>
                <td width="150px">Nhập mật khẩu mới</td>
                <td>
                    <input type="text" name="fullname" id="fullname" v-model="pass" class="form-input">
                </td>
            </tr>

            <tr>
                <td width="150px">Nhập lại mật khẩu mới</td>
                <td>
                    <input type="text" name="mobile" id="mobile" v-model="repass" class="form-input">
                </td>
            </tr>

            <tr>
                <td width="150px"></td>
                <td>
                    <div class="form-group" :style="{'transition': 'ease .3s', 'overflow': 'hidden', 'height': visibleAlert ? 'auto' : '0px', 'opacity': visibleAlert ? '1' : '0', 'margin-top': '6px'}">
                <a-alert :message="alert" :type="alertType" />
                </div>
                </td>
            </tr>

            <tr>
                <td width="150px"></td>
                <td>
                    <button @click="handleSubmit" class="btn-submit bg-green" style="color: #fff;border: 0;height: 40px;max-width: 200px;width: 100%;border-radius: 5px;margin: 10px 0 0 0;">THAY ĐỔI</button>
                </td>
            </tr>
        </tbody></table>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { get } from 'lodash'
import axios from 'axios'

export default {
  name: 'ChangePassword',
  props: ['selectedKeys'],
  data() {
    return {
      oldPass: '',
      pass: '',
      repass: '',
      visibleAlert: false,
      alert: '',
      alertType: 'error'
    }
  },
  computed: {
    ...mapState({
      account: state => state.account.data,
    }),
  },
  methods: {
    changeCity(e) {
      this.city = e.target.value
    },
    handleSubmit() {
      if (!(this.pass == this.repass)) {
        this.showAlert('Mật khẩu nhập lại không trùng khớp!', 'error')
      } else {
        const url = `${import.meta.env.VITE_APP_API_URL}/account/change_password`
        const param = {
          token: this.account.token,
          pass: this.pass,
          username: this.account.username,
          oldPass: this.oldPass
        }
        axios.post(url, param)
        .then(res => {
          if (res.status == 200) {
            this.$store.commit('account/set-account', res.data.data)
            this.showAlert('Cập nhật thành công!', 'success')
          }
        })
        .catch(err => {
          this.showAlert('Cập nhật thất bại! Sai password', 'error')
        })
      }
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
