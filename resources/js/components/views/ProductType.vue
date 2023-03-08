<template>
    <div class="product-page container" style="margin-top: 16px">
        <div class="col-left" style="margin-top: 45px">
            <div class="product-filter-container">
                <div class="filter-item">
                    <p class="box-title">KHOẢNG GIÁ</p>
                    <div class="filter-list">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-right">
            <div class="page-title-group">
                <h1 class="page-title" style="text-transform: capitallize">{{productType.name}}</h1>
                <span>({{pagination.count}} sản phẩm)</span>
            </div>
            <div class="product-holder-group">
                <div class="p-container">
                    <div class="p-item" v-for="product in products" :key="product.id">
                        <div class="p-text">
                            <a style="pointer-event: none" class="p-img">
                                <img :src="product.display_image" data-src="/media/product/250-3471-38.jpg" alt="SWITCH BÀN PHÍM CƠ KTT KANG WHITE V3" width="250" height="250" class="lazy loaded" data-was-processed="true">
                            </a>
                            <div class="d-flex align-item-center justify-content-between">
                                <p class="p-sku">Mã: {{product.key}}</p>
                                <p class="p-qty conhang">Còn hàng </p>
                            </div>
                            <a href="/switch-ban-phim-co-ktt-kang-white-v3" class="p-name"> <h3>{{ product.name }}</h3> </a>

                            <div class="p-price-container">

                                <span class="p-price">
                                    {{product.display_price}}<u>đ</u>

                                </span>

                                <a class="p-btn-cart"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="is-flex is-flex--center" style="padding-bottom: 12px">
                    <a-pagination v-model:current="page" :total="parseInt((pagination.count || 1)/(pagination.limit || 1))" show-less-items />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  name: 'ProductType',
  data() {
    return {
        view: 'main',
        page: 1,
    }
  },
  computed: {
    ...mapState({
       productType: state => state.productType.activeType,
       products: state => state.products.data,
       pagination: state => state.products.pagination
    })
  },
  created() {
    this.fetchProductType({type: this.$route.params.type})
    .then(res => {
        if (res.status == 200) {
            this.setProductType({data: res.data.data})
            this.fetchProducts({type_id: this.productType.id})
        }
    })
    .catch(err => {
        console.log(err, 'request failed')
    })
  },
  methods: {
    ...mapActions({
        fetchProductType: 'productType/fetch',
        setProductType: 'productType/set-data',
        fetchProducts: 'products/fetch-product'
    })
  }
}
</script>

<style>

</style>
