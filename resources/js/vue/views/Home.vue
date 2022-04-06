<template>
    <div class="home">
        <hero />
        <div class="product-container container">
            <div class="content">
                <product v-for="(product, i) in products" :key="i" :product="product" />
            </div>
        </div>
    </div>
</template>

<script>

import Hero from "../components/Hero";
import Product from "../components/Product";

export default {
    name: 'Home',
    data() {
        return {
            loading: true,
            products: [],
        }
    },
    components: {
        Hero,
        Product,
    },
    mounted() {
        this.getProducts();
    },
    methods:{
        async getProducts(){
            this.loading = true;
            await this.axios.get('/v1/products',{
                headers: {
                    Accept: 'application/json'
                }
            }).then(response => {
                if(Array.isArray(response.data)) this.products = response.data;
            }).catch(() => {});
            this.loading = false;
        }
    },
}
</script>

<style lang="scss" scoped>
    .product-container{
        text-align: left;
        padding: 0 !important;
        margin-top: 4vw !important;
        >.content{
            margin: 0;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            figure{
                width: calc(100%/3);
            }
            @media all and (max-width: 860px){
                figure {
                    width: 50%;
                }
            }
            @media all and (max-width: 520px){
                figure {
                    width: 100%;
                }
            }
        }
    }
</style>
