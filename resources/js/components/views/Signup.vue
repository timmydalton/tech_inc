<template>
  <div class="container">
    <div class="box-register bg-w bg-white">
        <div class="title text-center">Tạo tài khoản khách hàng cá nhân</div>
        <div class="box-register-content">

            <div class="box-register-content-left">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email đăng ký*</label>
                        <div class="label-for">
                            <input v-model="username" type="text" class="inputText" size="50" name="info[email]" id="email">
                            <span id="check_user" class="style-check"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tên</label>
                        <div class="label-for">
                            <input v-model="name" type="text" class="inputText" size="50" name="info[name]" id="full_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại*</label>
                        <div class="label-for">
                            <input v-model="phone" type="text" class="inputText" size="20" name="info[mobile]" id="tel">
                            <span class="mobile-call style-check"></span>
                        </div>
                    </div>
                    <div class="form-group gioitinh">
                        <label>Giới tính</label>
                        <div class="label-for">
                            <input type="radio" @change="e => changeSex('male')" name="info[sex]" value="male">Nam
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" @change="e => changeSex('female')" name="info[sex]" value="female">Nữ
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu*</label>
                        <div class="label-for">
                            <input v-model="password" type="password" class="inputText" size="50" name="info[password]" id="password" aria-autocomplete="list">
                            <span class="password-call style-check"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu*</label>
                        <div class="label-for">
                            <input v-model="repass" type="password" name="info[password1]" id="password1" class="inputText" size="20">
                            <span class="repassword-call style-check"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ*</label>
                        <div class="label-for">
                            <input v-model="address" type="text" class="inputText" size="50" name="info[address]" id="address">
                            <span class="address-call style-check"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tỉnh/TP</label>
                        <div class="label-for">
                            <select @change="e => changeCity(e)" class="form-control mb-2" id="ship_to_province" name="info[province]">
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
                        </div>
                    </div>
                    <div class="js-province" id="district-holder-login"></div>

                    <div class="form-group" :style="{'transition': 'ease .3s', 'overflow': 'hidden', 'height': visibleAlert ? 'auto' : '0px', 'opacity': visibleAlert ? '1' : '0'}">
                      <a-alert :message="alert" :type="alertType" />
                    </div>

                    <div class="form-group">
                        <label></label>
                        <div class="label-for">
                            <input type="button" @click="clickSignup()" id="submit-register" value="Đăng ký" style="background: #29A07E;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Signup',
  data () {
    return {
    name: '',
    username: '',
    phone: '',
    gender: '',
    password: '',
    repass: '',
    address: '',
    city: '',
    visibleAlert: false,
    alert: '',
    alertType: 'error'
    }
  },
  methods: {
    changeSex(sex) {
      this.gender = sex
    },
    changeCity(e) {
      this.city = e.target.value
    },
    clickSignup() {

      if (!this.password || !this.username || !this.address || !this.phone) {
        this.showAlert('Bạn chưa nhập đủ thông tin!!!', 'error')
        return
      }
      if (this.password != this.repass) {
        this.showAlert('Mật khẩu nhập lại không chính xác!!!', 'error')
        return
      }
      const param = {
        username: this.username,
        password: this.password,
        info: JSON.stringify({
          address: this.address,
          city: this.city,
          gender: this.gender,
          phone: this.phone,
          name: this.name
        })
      }
      const url = `${import.meta.env.VITE_APP_API_URL}/account/create`
      axios.post(url, param)
        .then(res => {
          if (res.status == 200) {
            this.showAlert('Đăng ký thành công, chuyển tới trang đăng nhập sau 3s', 'success')
            setTimeout(() => {
              this.$router.push('/')
            }, 3000)
          }
        })
        .catch(err => {
          console.log(err.response, 'error')
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
