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
        <h6>Tên sản phẩm:</h6>
      </div>
      <div class="modal-item--input">
        <a-input v-model:value="prodName"></a-input>
      </div>
    </div>
    <div class="modal-item">
      <div class="modal-item--label">
        <h6>Key:</h6>
      </div>
      <div class="modal-item--input">
        <a-input v-model:value="prodKey"></a-input>
      </div>
    </div>
    <div class="modal-item">
      <div class="modal-item--label">
        <h6>Giá hiển thị:</h6>
      </div>
      <div class="modal-item--input">
        <a-input type="number" min="0" v-model:value="price"></a-input>
      </div>
    </div>
    <div class="modal-item">
      <div class="modal-item--label">
        <h6>Mô tả:</h6>
      </div>
      <div class="modal-item--input">
        <a-textarea v-model:value="info" :autoSize="{ minRows: 2 }"></a-textarea>
      </div>
    </div>
    <div class="modal-item">
      <div class="modal-item--label">
        <h6>Loại sản phẩm:</h6>
      </div>
      <div class="modal-item--input">
        <a-select
          style="width: 100%"
          :value="selectedCategory"
          @change="onSelectCategory"
          :filterOption="false"
        >
          <select-option value="none">{{ "Không" }}</select-option>
          <select-option v-for="cate in categories" :key="cate.id" :value="cate.id">
            {{ getCateName(cate) }}
          </select-option>
        </a-select>
      </div>
      <div class="modal-item">
      <div class="modal-item--label">
        <h6>Ảnh mô tả:</h6>
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
    </div>
  </a-modal>
</template>

<script>
import axios from 'axios'

import { mapState, mapActions } from 'vuex'
import { Select } from 'ant-design-vue'
import { message } from 'ant-design-vue';

export default {
  name: 'ModalProduct',
  props: ['visible', 'action', 'record'],
  data() {
    return {
      prodName: "",
      prodKey: "",
      info: "",
      selectedCategory: "none",
      selectedType: "",
      price: "",
      imageUrl: "",
      loading: false
    }
  },
  components: {
    'select-option': Select.Option
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
        this.prodName = this.record.name
        this.prodKey = this.record.key
        this.info = this.record.info
        this.price = this.record.display_price
        this.selectedCategory = this.record.categories_id
        this.selectedType = this.record.product_type_id
        this.imageUrl = this.record.display_image
      } else {
        this.prodName = ""
        this.prodKey = ""
        this.info = ""
        this.price = ""
        this.selectedCategory = ""
        this.selectedType = ""
        this.imageUrl = ""
      }
    }
  },
  methods: {
    ...mapActions({
      fetchProduct: "manageProduct/fetch-product",
    }),
    hideModal() {
      this.$emit('hideModal')
    },
    onOk() {
      if (!(this.prodKey && this.prodName && this.selectedCategory != 'none' && this.selectedType)) {
        message.error('Vui lòng điền đủ thông tin')
        return
      }
      const url = this.action == 'addProduct' ? `${import.meta.env.VITE_APP_API_URL}/product/create` : `${import.meta.env.VITE_APP_API_URL}/product/update`
      const param = {
        id: this.record ? this.record.id : '',
        token: this.account.token,
        name: this.prodName,
        key: this.prodKey,
        info: this.info,
        categoriesId: this.selectedCategory,
        productTypeId: this.selectedType,
        price: this.price,
        display_image: this.imageUrl
      }
      axios.post(url, param)
      .then(res => {
        if (res.status == 200) {
          if (this.action == 'addProduct') message.success('Tạo sản phẩm thành công')
          else message.success('Cập nhật sản phẩm thành công')
          this.fetchProduct()
          this.hideModal()
        }
      })
      .catch(err => {
        console.log(err)
        message.error('Tạo sản phẩm thất bại')
      })
    },
    getCateName(cate) {
      const productType = this.productType.find(el => el.id == cate.product_type_id)
      if (productType) {
        return productType.name + ' - ' + cate.name
      }
      return cate.name
    },
    onSelectCategory(val) {
      this.selectedCategory = val
      this.selectedType = this.categories.find(el => el.id == val).product_type_id

    },
    handleChangeImage(e) {
      if (e.file.status != 'done') return
      const image = e.file.response.data.path
      this.imageUrl = image
    }
  }
}
</script>
