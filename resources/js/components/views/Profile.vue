<template>
  <div class="bg-white" style="margin-top: 16px">
    <div class="container" style="height: 600px">
      <div class="profile-box is-flex">
        <div class="profile-box--left">
          <a-menu style="width: 300px" :selectedKeys="[selectedKeys]"  @click="selectOption">
            <a-menu-item-group key="g1" title="Đơn hàng đặt mua">
              <a-menu-item key="1">Danh sách đơn hàng</a-menu-item>
            </a-menu-item-group>
            <a-menu-item-group key="g2" title="Thông tin tài khoản">
              <a-menu-item key="2">Thông tin cá nhân</a-menu-item>
              <a-menu-item key="3">Thay đổi mật khẩu</a-menu-item>
            </a-menu-item-group>
          </a-menu>
        </div>
        <div class="profile-box--right" style="width: 900px">
          <template v-if="selectedKeys == '1'">
            <h3>Danh sách đơn hàng</h3>
            <p>Bạn chưa mua đơn hàng nào</p>
          </template>
          <template v-if="selectedKeys == '2'">
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
                            <select @change="e => changeCity(e)" name="province" onchange="getProvince(this.value);" class="form-input">
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
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import axios from 'axios'

export default {
  name: 'Profile',
  data() {
    return {
      selectedKeys: '1',
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
  watch: {
    selectedKeys() {
      const info = this.account.info
      this.address = info.address
      this.name = info.name
      this.city = info.city
      this.phone = info.phone
    }
  },
  methods: {
    selectOption(e) {
      this.selectedKeys = e.key
    },
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

<style type="text/css">
    #tb-account { border-collapse:collapse}
    #account-left { vertical-align:top; padding-right:30px;}
    h2,h3{margin-top:0;}
    #account-left b {font-weight: bold;line-height: 26px;background:#D11A1A;color: white;padding: 0 8px;}
    #account-left dd, b, dl{ margin:0; padding:0}
    #account-left dl { margin-bottom:10px}
    #account-left a {color: #383838;text-decoration: none;line-height: 30px;}
    .account-left {line-height: 2.4;}
    .account-index {padding: 20px 0;}
    .account-left a:hover {color: #0676da;}
    .form-input {width: 100%;height: 34px;border-radius: 3px;border: solid 1px #ccc;padding: 0 5px;outline: none;max-width: 100%;}
    .p-15{padding:0 15px}
    .cart-detail-group .title{border-bottom:1px solid #d7d7d7;line-height:44px;}
    .cart-detail-group .item{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;border-top:1px solid #f5f5f5;padding:15px 0;}
    .cart-detail-group .item:first-child{border:0;}
    .cart-detail-group .item-left{width:82px;margin-right:8px;text-align:center;}
    .cart-detail-group .item-left img{display:block;margin:auto auto 15px auto;}
    .cart-detail-group .item-middle{width:362px;margin-right:8px;}
    .cart-detail-group .item-right{width:calc(100% - 460px);text-align:right;display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;}
    .cart-detail-group .item-variant{margin:10px 0 0 0;font-size:12px;font-weight:500;}
    .cart-detail-group .item-name{display:block;color:#222;margin-bottom:8px;font-weight:600;}
    .cart-detail-group .item-name:hover{color:#ee2d24;}
    .cart-detail-group .offer-group .active span{display:block;}
    .cart-detail-group .offer-group span{position:relative;display:none;padding-left:12px;margin-bottom:10px;}
    .cart-detail-group .offer-group span::before{content:'';width:5px;height:5px;border-radius:50%;background:#d4d4d4;position:absolute;top:7px;left:0;}
    .cart-detail-group .offer-group .offer-btn a{display:none;}
    .cart-detail-group .item-quantity{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;border:1px solid #e5e5e5;border-radius:4px;overflow:hidden;text-align:center;width: 100px;margin: auto 0 auto auto;}
    .cart-detail-group .item-quantity a{text-align:center;color:#222;width:30px;line-height:33px;font-weight:500;}
    .cart-detail-group .item-quantity input{text-align:center;border:0;border-left:1px solid #e5e5e5;border-right:1px solid #e5e5e5;width:37px;}
    .cart-detail-group .cart-voucher-group{padding:15px;background:#f5f5f5;}
    .cart-detail-group .cart-voucher-group .btn-check-voucher{background:#707070;color:#fff !important;width:85px;position:absolute;top:0;right:0;bottom:0;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;}
    .cart-detail-group .cart-voucher-group .cart-voucher-form{background:#fff;position:relative;overflow:hidden;border-radius:6px;margin-bottom:12px;}
    .cart-detail-group .cart-voucher-group .voucher-input{width:calc(100% - 90px);border:0;height:40px;padding-left:12px;}
    .account-index .cart-send-info {padding: 20px 15px;margin-top: 12px;background: #f5f5f5;font-weight: 300;}
    .account-index .btn-left {color: #fff;background-color: #6c757d;border-color: #6c757d;width: 100%;margin: 0 0 10px 0;color: #fff !important;line-height: 38px;padding: 0}
    .account-index .btn-left.current{background: #29A07E;}
    .account-right{padding: 0 15px}
    .order-detail-page td{padding: 8px 0}
</style>
