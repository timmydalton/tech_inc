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
            <a-menu-item-group key="g2" title="Admin" v-if="userRole == 0">
              <a-menu-item key="4">Check đơn</a-menu-item>
              <a-menu-item key="5">Quản lý sản phẩm</a-menu-item>
              <a-menu-item key="6">Quản lý mẫu mã</a-menu-item>
            </a-menu-item-group>
          </a-menu>
        </div>
        <div class="profile-box--right" style="width: 1000px">
          <template v-if="selectedKeys == '1'">
            <h3>Danh sách đơn hàng</h3>
            <p>Bạn chưa mua đơn hàng nào</p>
          </template>
          <template v-if="selectedKeys == '2'">
            <AccountInfo :selectedKeys="selectedKeys"/>
          </template>
          <template v-if="selectedKeys == '3'">
            <ChangePassword :selectedKeys="selectedKeys"/>
          </template>
          <template v-if="selectedKeys == '4'">
          </template>
          <template v-if="selectedKeys == '5'">
            <ManageProduct :selectedKeys="selectedKeys"/>
          </template>
          <template v-if="selectedKeys == '6'">
            <ManageVariations :selectedKeys="selectedKeys"/>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { get } from 'lodash'
import axios from 'axios'
import AccountInfo from '../manage/AccountInfo.vue'
import ChangePassword from '../manage/ChangePassword.vue'
import ManageProduct from '../manage/ManageProduct.vue'
import ManageVariations from '../manage/ManageVariations.vue'

export default {
  name: 'Profile',
  data() {
    return {
      selectedKeys: '1',
    }
  },
  components: {
    AccountInfo,
    ChangePassword,
    ManageProduct,
    ManageVariations
  },
  created() {
    if (this.$route && this.$route.query.key) {
      this.selectedKeys = this.$route.query.key
    }
  },
  computed: {
    ...mapState({
      account: state => state.account.data,
    }),
    userRole() {
      return get(this.account, 'role', 1)
    }
  },
  methods: {
    selectOption(e) {
      this.selectedKeys = e.key
    },
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
