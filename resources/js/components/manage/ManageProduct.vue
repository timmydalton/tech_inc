<template>
  <div style="display:contents">
    <h3>Quản lý sản phẩm</h3>
    <a-table :dataSource="dataSource" :columns="columns">
      <template #action>
        <a style="color: #29a07e">Edit</a>
      </template>
    </a-table>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { get } from 'lodash'
import axios from 'axios'

export default {
  name: 'ManageProduct',
  props: ['selectedKeys'],
  data() {
    return {
      dataSource: [
        {

        }
      ],
      columns: [
        {
          title: 'Index',
          dataIndex: 'id',
          key: 'id'
        },
        {
          title: 'Name',
          dataIndex: 'name',
          key: 'name'
        },
        {
          title: 'Description',
          dataIndex: 'info',
          key: 'info'
        },
        {
          title: 'Category',
          dataIndex: 'category',
          key: 'category'
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
    }),
  },
  methods: {
  }
}
</script>

<style>

</style>
