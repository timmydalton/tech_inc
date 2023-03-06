<template>
  <div class="topbar">
    <div class="topbar--first is-flex">
      <div class="topbar--right">
        <div class="topbar--head is-flex">
          <a-button shape="round" class="mr-8">
            <i class="fa-solid fa-location-dot" style="margin-right:4px"></i>
            Địa chỉ liên hệ
          </a-button>
          <a-button shape="round" class="mr-48">
            <i class="fa-solid fa-headphones-simple" style="margin-right:4px"></i>
            Hotline trực tuyến
          </a-button>
          <a href="https://shopee.vn/" class="is-flex is-flex--center mr-8">
            <div class="icon shopee"></div>
            Shopee
          </a>
          <a href="https://www.lazada.vn/" class="is-flex is-flex--center mr-8">
            <div class="icon lazada"></div>
            Lazada
          </a>
          <a href="https://www.instagram.com/" class="is-flex is-flex--center mr-8">
            <i class="fa-brands fa-instagram mr-8"></i>
            Instagram
          </a>
          <a href="https://www.tiktok.com/" class="is-flex is-flex--center mr-8">
            <i class="fa-brands fa-tiktok mr-8"></i>
            Tiktok
          </a>
          <a href="https://www.youtube.com/" class="is-flex is-flex--center mr-8">
            <i class="fa-brands fa-youtube mr-8"></i>
            Youtube
          </a>
          <a href="https://www.facebook.com/" class="is-flex is-flex--center mr-8">
            <i class="fa-brands fa-square-facebook mr-8"></i>
            Facebook
          </a>
        </div>
      </div>
      <div class="topbar--left">
        <div class="topbar--head is-flex">
          <a href="" class="is-flex is-flex--center mr-8" style="font-weight: 700">
            <i class="fa-regular fa-newspaper mr-8"></i>
            Tin tức
          </a>
          <i class="is-flex is-flex--center fa-regular fa-circle-user mr-8"></i>
          <div class="is-flex is-flex--center mr-8" v-if="!account">
            <a href="/login">Đăng nhập</a>
            /
            <a href="/signup">Đăng ký</a>
          </div>
          <template v-else>
            <a-popover trigger='hover' placement="bottomRight" overlayClassName="custom-overlay">
              <template #content>
                <a-menu :selected="[]">
                  <a-menu-item key="1" @click="e => handleClick('profile')">
                    <a>Trang cá nhân</a>
                  </a-menu-item>
                  <a-menu-item key="2" v-if="account.role == 0" @click="e => handleClick('admin')">
                    <a>Chỉnh sửa cửa hàng</a>
                  </a-menu-item>
                  <a-menu-divider/>
                  <a-menu-item key="3" @click="e => handleClick('logout')">
                    <a>Đăng xuất</a>
                  </a-menu-item>
                </a-menu>
              </template>
              <div class="is-flex is-flex--center mr-8" style="cursor: pointer">
                {{ account.name || account.username }}
              </div>
            </a-popover>
          </template>
        </div>
      </div>
    </div>
    <div class="topbar--body is-flex is-flex--center shadow">
      <a href="/home">
        <img src="https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/213325254/original/4802c9fa2c952a807666ef2e88b3c24ac82ae36e/design-a-minimalist-logo-for-your-climbing-gear-shop.jpg" alt="">
      </a>
      <a-button class="cate is-flex is-flex--center mr-16" style="position:relative" @click="clickMenu">
        <i class="fa-solid fa-list mr-8"></i>
        DANH MỤC
      </a-button>
      <a-input placeholder="Bạn cần tìm gì?" class="mr-16">
        <template #prefix>
          <i class="fa-solid fa-magnifying-glass"></i>
        </template>
      </a-input>
      <div class="item is-flex is-flex--center mr-16">
        <i class="fa-solid fa-phone-volume green mr-8" style="font-size: 24px"></i>
        <div style="border-right: solid 1px var(--color-primary); padding-right: 12px; margin-right: 12px">
          <a href="" style="text-decoration:none;font-size:13px" class="green">
            <div class="text" style="color:#000">Hotline</div>
            <div class="text">0123.456.789</div>
          </a>
        </div>
        <div class="item is-flex is-flex--center">
          <i class="fa-solid fa-bolt-lightning green mr-8" style="font-size: 24px"></i>
          <a href="" style="text-decoration:none;font-size:13px" class="green">
            <div class="text">Tư vấn trực tiếp</div>
          </a>
        </div>
      </div>
      <a-button style="height: 46px; border-radius: 10px" class="is-flex is-flex--center cart">
          <i class="fa-solid fa-cart-shopping mr-8" style="font-size: 24px"></i>
          <span style="color:#000; font-size:12px;font-weight: bold">Giỏ hàng</span>
      </a-button>

      <div class="menu-list shadow" v-if="showMenu">
        <a @dblclick="dblClick('mouse_pad')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'mouse_pad'}" @click="clickCate('mouse_pad')">
            <div class="is-flex">
              <i class="fa-regular fa-keyboard mr-16" style="font-size:24px"></i>
              LÓT CHUỘT
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('gaming_gear')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'gaming_gear'}" @click="clickCate('gaming_gear')">
            <div class="is-flex">
              <i class="fa-solid fa-gamepad mr-16" style="font-size:24px"></i>
              GAMING GEAR
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('computer_accessories')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'computer_accessories'}" @click="clickCate('computer_accessories')">
            <div class="is-flex">
              <i class="fa-solid fa-display mr-16" style="font-size:24px"></i>
              PHỤ KIỆN MÁY TÍNH
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('figure')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'figure'}" @click="clickCate('figure')">
            <div class="is-flex">
              <i class="fa-solid fa-box-open mr-16" style="font-size:24px"></i>
              MÔ HÌNH
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('decors')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'decors'}" @click="clickCate('decors')">
            <div class="is-flex">
              <i class="fa-solid fa-frog mr-16" style="font-size:24px"></i>
              PHỤ KIỆN TRANG TRÍ
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('speaker_micro_webcam')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'speaker_micro_webcam'}" @click="clickCate('speaker_micro_webcam')">
            <div class="is-flex">
              <i class="fa-solid fa-microphone mr-16" style="font-size:24px"></i>
              LOA, MICRO, WEBCAM
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('gaming_chair')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'gaming_chair'}" @click="clickCate('gaming_chair')">
            <div class="is-flex">
              <i class="fa-solid fa-chair mr-16" style="font-size:24px"></i>
              GHẾ GAMING
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('gaming_table')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'gaming_table'}" @click="clickCate('gaming_table')">
            <div class="is-flex">
              <i class="fa-solid fa-stapler mr-16" style="font-size:24px"></i>
              BÀN GAMING
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('usb_devices')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'usb_devices'}" @click="clickCate('usb_devices')">
            <div class="is-flex">
              <i class="fa-brands fa-usb mr-16" style="font-size:24px"></i>
              USB, BỘ CHIA TÍN HIỆU
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('fan_cooler')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'fan_cooler'}" @click="clickCate('fan_cooler')">
            <div class="is-flex">
              <i class="fa-solid fa-fan mr-16" style="font-size:24px"></i>
              TẢN NHIỆT, COOLING
            </div>
          </div>
        </a>
        <a @dblclick="dblClick('phone_accessories')">
          <div :class="{'menu-item': true, 'selected': viewCate == 'phone_accessories'}" @click="clickCate('phone_accessories')">
            <div class="is-flex">
              <i class="fa-solid fa-mobile-screen-button mr-16" style="font-size:24px"></i>
              PHỤ KIỆN ĐIỆN THOẠI
            </div>
          </div>
        </a>
      </div>

      <div class="menu-expand shadow header-menu-group" v-show="hoverMenu">
        <div class="sub-item" :key="cat.id" v-for="cat in cate.filter(el => el.product_type.key == viewCate)">
          <a :href="'/categories/' + cat.key" class="cat-2">{{ cat.name.toUpperCase() }}</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { get } from 'lodash'
import { mapState } from 'vuex'

export default {
  name: 'Topbar',
  data() {
    return {
      hoverMenu: false,
      showMenu: false,
      allowClickMenu: true,
      viewCate: ''
    }
  },
  created() {
    if (this.path == '/') {
      this.showMenu = true
      this.allowClickMenu = false
    }
  },
  watch: {
    path(value) {
      if (!value) return
      if (value == '/' || value == '/home') {
        this.showMenu = true
        this.allowClickMenu = false
      } else {
        this.showMenu = false
        this.allowClickMenu = true
      }
    }
  },
  computed: {
    ...mapState({
      account: state => state.account.data,
      categories: state => state.categories.categories,
      productType: state => state.categories.productType
    }),
    route() {
      return get(this.$router, ['currentRoute', 'value'], {})
    },
    path() {
      return this.route.fullPath
    },
    cate() {
      return this.categories.map(cate => {
        cate.product_type = this.productType.find(pt => pt.id == cate.product_type_id)
        return cate
      })
    }
  },
  methods: {
    clickMenu() {
      if (!this.allowClickMenu) return
      this.showMenu = !this.showMenu
    },
    toggleMenu() {
      this.showMenu = false
    },
    handleClick(state) {
      switch (state) {
        case 'logout': {
          this.$store.commit('account/set-account', null)
          document.cookie = 'Token=; Max-Age=-99999999;';
          this.$router.go()
          break
        }
        case 'profile': {
          this.$router.push('profile')
          break
        }
      }
    },
    clickCate(cate) {
      if (this.viewCate == cate) {
        this.viewCate = ''
        this.hoverMenu = false
      } else {
        this.viewCate = cate
        this.hoverMenu = true
      }
    },
    dblClick(type) {
      this.$router.push('/product-type/' + type)
    }
  }
}
</script>
<style>

</style>
