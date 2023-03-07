<template>
  <a-modal
    :visible="visible"
    :title="action == 'addProduct' ? 'Thêm sản phẩm' : 'Chỉnh sửa sản phẩm'"
    class="modal-product"
    @cancel="hideModal"
    @ok="onOk"
  >
    <div class="modal-item">
      <div class="modal-item--label">
        <h6>Tên mẫu mã:</h6>
      </div>
      <div class="modal-item--input">
        <a-input v-model:value="name"></a-input>
      </div>
    </div>
    <div class="modal-item">
      <div class="modal-item--label">
        <h6>Giá:</h6>
      </div>
      <div class="modal-item--input">
        <a-input type="number" min="0" v-model:value="price"></a-input>
      </div>
    </div>
    <div class="modal-item">
      <div class="modal-item--label">
        <h6>Số lượng:</h6>
      </div>
      <div class="modal-item--input">
        <a-input type="number" min="0" v-model:value="quantity"></a-input>
      </div>
    </div>
    <div class="modal-item">
      <div class="modal-item--label">
        <h6>Ảnh mô tả mẫu mã:</h6>
      </div>
      <div class="modal-item--input">
        <a-upload
            name="avatar"
            list-type="picture-card"
            class="avatar-uploader"
            :show-upload-list="false"
            action="http://localhost:8000/api/upload_asset"
            @change="handleChangeImage"
        >
            <img v-if="imageUrl" :src="imageUrl" alt="avatar" />
            <div v-else>
            <loading-outlined v-if="loading"></loading-outlined>
            <plus-outlined v-else></plus-outlined>
            <div class="ant-upload-text">Upload</div>
            </div>
        </a-upload>
      </div>
    </div>
  </a-modal>
</template>

<script>
import axios from 'axios'

import { mapState, mapActions } from 'vuex'
import { message } from 'ant-design-vue';
import { PlusOutlined, LoadingOutlined } from '@ant-design/icons-vue';

export default {
  name: 'ModalVariation',
  props: ['visible', 'action', 'record', 'selectedProduct'],
  data() {
    return {
      name: "",
      price: "",
      quantity: "",
      imageUrl: "",
      loading: false,
    }
  },
  components: {
    PlusOutlined,
    LoadingOutlined
  },
  computed: {
    ...mapState({
      account: state => state.account.data,
      categories: state => state.categories.categories,
      productType: state => state.categories.productType,
      mapType: state => state.categories.mapType,
    }),
  },
  watch: {
    visible(value) {
      if (value && this.record) {
        this.name = this.record.name
        this.price = this.record.price
        this.imageUrl = this.record.image
        this.quantity = this.record.quantity
      } else {
        this.name = ""
        this.price = ""
        this.imageUrl = ""
        this.quantity = ""
      }
    }
  },
  methods: {
    hideModal() {
      this.$emit('hideModal')
    },
    fetch() {
      this.$emit('fetch')
    },
    onOk() {
      const url = this.action == 'addVariation' ? `${import.meta.env.VITE_APP_API_URL}/variation/create` : `${import.meta.env.VITE_APP_API_URL}/variation/update`
      const param = {
        id: this.record ? this.record.id : '',
        token: this.account.token,
        product_id: this.selectedProduct.id,
        image: this.imageUrl,
        name: this.name,
        price: this.price,
        quantity: this.quantity,
      }
      axios.post(url, param)
      .then(res => {
        if (res.status == 200) {
          if (this.action == 'addVariation') message.success('Tạo mẫu mã thành công')
          else message.success('Cập nhật mẫu mã thành công')
          this.hideModal()
          this.fetch()
        }
      })
      .catch(err => {
        console.log(err)
        message.error('Lỗi tạo thất bại')
      })
    },
    handleChangeImage(e) {
      if (e.file.status != 'done') return
      const image = e.file.response.data.path
      this.imageUrl = image
    }
  }
}
</script>
