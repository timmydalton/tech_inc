<template>
  <div style="display:contents">
    <h3>Quản lý sản phẩm</h3>
    <div style="margin: 12px 8px 12px 0px">
      <a-dropdown trigger="click">
        <template #overlay>
          <a-menu @click="handleMenuClick">
            <a-menu-item key="1">Thêm sản phẩm</a-menu-item>
          </a-menu>
        </template>
        <a-button>
          Thao tác
          <DownOutlined />
        </a-button>
      </a-dropdown>
    </div>

    <a-table :loading="loading" :dataSource="showProducts" :columns="columns" :pagination="{ pageSize: 10 }">
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
      <template #image="{record}">
          <img :src="record.display_image" style="width: 32px; height: 32px" alt="">
      </template>
    </a-table>

    <ModalProduct :visible="visbleModalCate" :record="selectedRecord" :action="action" @hideModal="e => visbleModalCate = false"/>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import { get } from 'lodash'
import axios from 'axios'
import { DownOutlined } from '@ant-design/icons-vue';
import { message } from 'ant-design-vue';

import ModalProduct from '../modal/ModalProduct.vue';

export default {
  name: 'ManageProduct',
  props: ['selectedKeys'],
  components: {
    DownOutlined,
    ModalProduct
  },
  data() {
    return {
      loading: false,
      visbleModalCate: false,
      selectedRecord: {},
      action: '',
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
          title: 'Danh mục',
          dataIndex: 'category',
          key: 'category'
        },
        {
          title: 'Loại sản phẩm',
          dataIndex: 'type',
          key: 'type'
        },
        {
          title: 'Giá hiển thị',
          dataIndex: 'display_price',
          key: 'display_price'
        },
        {
          title: 'Ảnh',
          dataIndex: 'display_image',
          slots: { customRender: 'image'}
        },
        {
          title: '',
          dataIndex: '',
          slots: { customRender: 'action'}
        },
      ]
    }
  },
  mounted() {
    this.fetchProduct()
  },
  computed: {
    ...mapState({
      account: state => state.account.data,
      products: state => state.manageProduct.data,
      categories: state => state.categories.categories,
      productType: state => state.categories.productType
    }),
    showProducts() {
      return (this.products || []).map(pd => {
        pd.category = this.categories.find(el => el.id == pd.categories_id).name
        pd.type = this.productType.find(el => el.id == pd.product_type_id).name
        return pd
      })
    }
  },
  methods: {
    ...mapActions({
      fetchProduct: "manageProduct/fetch-product",
    }),
    handleMenuClick(e) {
      switch (e.key) {
        case '1': {
          this.selectedRecord = null
          this.action = 'addProduct'
          this.visbleModalCate = true
          break
        }
      }
    },
    clickEdit(e, record) {
      switch (e.key) {
        case '1': {
          this.selectedRecord = Object.assign({}, record)
          this.action = 'editProduct'
          this.visbleModalCate = true
          break
        }
        case '2': {
          const url = `${import.meta.env.VITE_APP_API_URL}/product/delete`
          axios.post(url, { token: this.account.token, id: record.id })
          .then(res => {
                if (res.status == 200) {
                message.success('Đã xóa!!!')
                this.fetchProduct()
                }
            })
            .catch(err => {
                console.log(err)
                message.error('Xóa sản phẩm thất bại')
            })
          break
        }
      }
    }
  }
}
</script>

<style>

</style>
