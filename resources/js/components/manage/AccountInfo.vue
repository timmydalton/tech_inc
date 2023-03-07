<template>
  <div style="display:contents">
      <h3>Cập nhật thông tin cá nhân</h3>
        <table>
            <tbody><tr>
                <td width="150px">Họ tên</td>
                <td>
                    <input type="text" name="fullname" id="fullname" v-model="name" class="form-input">
                </td>
            </tr>

            <tr>
                <td width="150px">Email</td>
                <td>
                    <input type="text" class="form-input" name="email" id="email" v-model="account.username" readonly>
                </td>
            </tr>

            <tr>
                <td width="150px">Địa chỉ nhà</td>
                <td>
                    <input type="text" name="address" id="address" v-model="address" class="form-input">
                </td>
            </tr>

            <tr>
                <td width="150px">Tỉnh/Thành Phố</td>
                <td>
                    <select @change="e => changeCity(e)" :value="city" name="province" class="form-input">
                        <option value=""> Chọn tỉnh/Thành phố </option>

                        <option value="01"> Hà Nội </option>

                        <option value="02"> TP HCM </option>

                        <option value="03"> Hải Phòng </option>

                        <option value="04"> Đà Nẵng </option>

                        <option value="51"> An Giang </option>

                        <option value="52"> Bà Rịa-Vũng Tàu </option>

                        <option value="44"> Bình Dương </option>

                        <option value="43"> Bình Phước </option>

                        <option value="47"> Bình Thuận </option>

                        <option value="37"> Bình Định </option>

                        <option value="60"> Bạc Liêu </option>

                        <option value="18"> Bắc Giang </option>

                        <option value="11"> Bắc Kạn </option>

                        <option value="19"> Bắc Ninh </option>

                        <option value="56"> Bến Tre </option>

                        <option value="06"> Cao Bằng </option>

                        <option value="61"> Cà Mau </option>

                        <option value="55"> Cần Thơ </option>

                        <option value="38"> Gia Lai </option>

                        <option value="05"> Hà Giang </option>

                        <option value="24"> Hà Nam </option>

                        <option value="30"> Hà Tĩnh </option>

                        <option value="23"> Hòa Bình </option>

                        <option value="21"> Hải Dương </option>

                        <option value="64"> Hậu Giang </option>

                        <option value="22"> Hưng Yên </option>

                        <option value="41"> Khánh Hòa </option>

                        <option value="54"> Kiên Giang </option>

                        <option value="36"> Kon Tum </option>

                        <option value="07"> Lai Châu </option>

                        <option value="08"> Lào Cai </option>

                        <option value="42"> Lâm Đồng </option>

                        <option value="10"> Lạng Sơn </option>

                        <option value="49"> Long An </option>

                        <option value="25"> Nam Định </option>

                        <option value="29"> Nghệ An </option>

                        <option value="27"> Ninh Bình </option>

                        <option value="45"> Ninh Thuận </option>

                        <option value="15"> Phú Thọ </option>

                        <option value="39"> Phú Yên </option>

                        <option value="31"> Quảng Bình </option>

                        <option value="34"> Quảng Nam </option>

                        <option value="35"> Quảng Ngãi </option>

                        <option value="17"> Quảng Ninh </option>

                        <option value="32"> Quảng Trị </option>

                        <option value="59"> Sóc Trăng </option>

                        <option value="14"> Sơn La </option>

                        <option value="46"> Tây Ninh </option>

                        <option value="28"> Thanh Hóa </option>

                        <option value="26"> Thái Bình </option>

                        <option value="12"> Thái Nguyên </option>

                        <option value="33"> Thừa Thiên-Huế </option>

                        <option value="53"> Tiền Giang </option>

                        <option value="58"> Trà Vinh </option>

                        <option value="09"> Tuyên Quang </option>

                        <option value="57"> Vĩnh Long </option>

                        <option value="16"> Vĩnh Phúc </option>

                        <option value="13"> Yên Bái </option>

                        <option value="40"> Đắk Lắk </option>

                        <option value="48"> Đồng Nai </option>

                        <option value="50"> Đồng Tháp </option>

                        <option value="62"> Điện Biên </option>

                        <option value="63"> Đăk Nông </option>

                    </select>
                </td>
            </tr>

            <tr>
                <td width="150px">Điện thoại di động</td>
                <td>
                    <input type="text" name="mobile" id="mobile" v-model="phone" class="form-input">
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
  name: 'AccountInfo',
  props: ['selectedKeys'],
  data() {
    return {
      name: '',
      address: '',
      city: '',
      phone: '',
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
  mounted() {
    const info = this.account.info
    this.address = info.address
    this.name = info.name
    this.city = info.city
    this.phone = info.phone
  },
  watch: {
    selectedKeys() {
    }
  },
  methods: {
    changeCity(e) {
      this.city = e.target.value
    },
    handleSubmit() {
      if (!(this.address && this.phone)) {
        this.showAlert('Vui lòng điền đầy đủ thông tin', 'error')
      } else {
        const url = `${import.meta.env.VITE_APP_API_URL}/account/update_info`
        const param = {
          token: this.account.token,
          info: JSON.stringify({
            ...this.account.info,
            address: this.address,
            name: this.name,
            city: this.city,
            phone: this.phone
          }),
        }
        axios.post(url, param)
        .then(res => {
          if (res.status == 200) {
            this.$store.commit('account/set-account', res.data.data)
            this.showAlert('Cập nhật thành công!', 'success')
          }
        })
        .catch(err => {
          this.showAlert('Cập nhật thất bại!', 'error')
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
