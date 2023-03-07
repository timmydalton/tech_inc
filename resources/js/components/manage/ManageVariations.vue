<template>
  <div style="display:contents">
    <h3>Quản lý mẫu mã</h3>
    <h5> Đang chọn: {{ selectedProduct ? selectedProduct.name : 'Không' }} </h5>
    <div style="margin: 12px 8px 12px 0px">
      <a-dropdown trigger="click">
        <template #overlay>
          <a-menu @click="handleMenuClick">
            <a-menu-item key="1">Thêm mẫu mã</a-menu-item>
          </a-menu>
        </template>
        <a-button>
          Thao tác
          <DownOutlined />
        </a-button>
      </a-dropdown>
    </div>

    <div style="margin-bottom: 16px">
      <a-input style="max-width: 300px; margin-right: 16px" v-model:value="productID" placeholder="Nhập id sản phẩm"></a-input>
      <a-button @click="clickFindProduct">Tìm</a-button>
    </div>

    <a-table :loading="loading" :dataSource="data" :columns="columns" :pagination="{ pageSize: 15 }">
      <template #action="{record}">
        <a-popover trigger='hover' placement="bottom">
          <template #content>
            <a-menu @click="e => clickEdit(e, record)">
              <a-menu-item key="1">Chỉnh sửa</a-menu-item>
              <a-menu-item key="2">Xóa</a-menu-item>
            </a-menu>
          </template>
          <a style="color: #29a07e">...</a>
        </a-popover>
      </template>
      <template #image="{ record }">
        <img style="height: 40px; width: 40px" :src="record.image" alt="">
      </template>
    </a-table>

     <ModalVariation :visible="visbleModalVariation" :selectedProduct="selectedProduct" :record="selectedRecord" :action="action" @fetch="clickFindProduct" @hideModal="e => visbleModalVariation = false"/>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import { get } from 'lodash'
import axios from 'axios'
import { DownOutlined } from '@ant-design/icons-vue';
import { message } from 'ant-design-vue';
import ModalVariation from '../modal/ModalVariation.vue';

export default {
  name: 'ManageVariations',
  props: ['selectedKeys'],
  components: {
    DownOutlined,
    ModalVariation
  },
  data() {
    return {
      loading: false,
      visbleModalVariation: false,
      selectedRecord: {},
      action: '',
      productID: '',
      selectedProduct: '',
      data: [],
      columns: [
        {
          title: 'ID',
          dataIndex: 'id',
          key: 'id'
        },
        {
          title: 'Tên',
          dataIndex: 'name',
          key: 'name'
        },
        {
          title: 'Giá',
          dataIndex: 'price',
          key: 'price'
        },
        {
          title: 'Ảnh mô tả',
          dataIndex: 'image',
          slots: { customRender: 'image'}
        },
        {
          title: 'Số lượng còn',
          dataIndex: 'quantity',
          key: 'quantity'
        },
        {
          title: '',
          dataIndex: '',
          slots: { customRender: 'action'}
        },
      ]
    }
  },
  computed: {
    ...mapState({
      account: state => state.account.data,
      products: state => state.manageProduct.data,
      categories: state => state.categories.categories,
      productType: state => state.categories.productType
    }),
  },
  methods: {
    handleMenuClick(e) {
      switch (e.key) {
        case '1': {
          if (!this.selectedProduct) return
          this.selectedRecord = null
          this.action = 'addVariation'
          this.visbleModalVariation = true
          break
        }
      }
    },
    clickEdit(e, record) {
      switch (e.key) {
        case '1': {
            this.selectedRecord = Object.assign({}, record)
            this.action = 'editVariation'
            this.visbleModalVariation = true
            break
        }
      }
    },
    clickFindProduct() {
        const url = `${import.meta.env.VITE_APP_API_URL}/product/get_by_id`
        axios.post(url, { token: this.account.token, id: this.productID })
        .then(res => {
            if (res.status == 200) {
                this.selectedProduct = res.data.data
                if (res.data.data) {
                    message.success('Tìm thấy sản phẩm!!!')
                    this.findVariations(this.selectedProduct.id)
                }
                else message.success('Không tồn tại sản phẩm này!!!')
            }
        })
        .catch(err => {
            console.log(err)
            this.selectedProduct = null
            this.data = []
            message.error('Sản phẩm không tồn tại hoặc đã bị xóa')
        })
    },
    findVariations(id) {
        const url = `${import.meta.env.VITE_APP_API_URL}/variation/get_by_product_id`
        axios.post(url, { token: this.account.token, id: id })
        .then(res => {
            if (res.status == 200) {
                this.data = res.data.data
            }
        })
        .catch(err => {
            console.log(err)
            message.error('Lỗi tìm kiếm mẫu mã!')
        })
    }
  }
}
</script>

<style>

</style>
