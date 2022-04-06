<template>
    <div class="product" v-if="loading || product">
        <ul class="breadcrumb">
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/">Plates</router-link></li>
            <li>{{product ? product.title : this.$route.params.id}}</li>
        </ul>
        <div class="product-info container" v-if="product">
            <div class="image">
                <div class="image-frame">
                    <img :src="image" :alt="product.title">
                </div>
            </div>
            <div class="details">
                <div class="brand">{{ product.brand }}</div>
                <h3 class="name">{{ product.title }}</h3>
                <div class="price">{{ price }}</div>
                <div class="description">{{product.description}}</div>
                <hr>
                <div class="add">
                    <quantity v-model="quantity" />
                    <button class="dark" @click="addToCart(quantity)">Add to cart</button>
                </div>
            </div>
        </div>
    </div>
    <not-found v-else />
</template>

<script>
import NotFound from "./NotFound";
import product from "../mixings/product";
import Quantity from "../components/Quantity";
export default {
    name: "ProductView",
    components:{NotFound, Quantity, },
    mixins:[product],
    data(){
        return {
            product: null,
            loading: false,
            quantity: 1,
            id: null,
        }
    },
    beforeMount() {
        if(this.$route.params.id){
            this.id = this.$route.params.id;
            this.getProducts();
        }
    },
    methods:{
        async getProducts(){
            this.loading = true;
            await this.axios.get('/v1/product/' + encodeURIComponent(this.id),{
                headers: {
                    Accept: 'application/json'
                }
            }).then(response => {
                if(response.data && response.data.title === this.id) this.product = response.data;
            }).catch(() => {});
            this.loading = false;
        }
    },
    computed:{

    }
}
</script>

<style scoped lang="scss">
    .product{
        display: flex;
        flex-direction: column;
        .breadcrumb{
            padding: 30px;
        }
        .product-info{
            display: flex;
            flex-direction: row;
            .image{
                flex: 1;

            }
            .details{
                padding: 0 3vw;
                width: 40%;
                text-align: center;

                .brand{
                    font-size: 0.85em;
                    font-weight: 600;
                    color: #9f9f9f;
                }
                .name{
                    margin: 25px 0;
                    font-weight: normal;
                    padding: 0;
                }
                .price{
                    font-family: Georgia, serif;
                    color: #b4b4b4;
                    font-weight: 600;
                }
                .description{
                    margin: 25px 0;
                    display: -webkit-box;
                    -webkit-line-clamp: 4;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    font-size: 0.97em;
                }
                hr{
                    border: 1px solid #ebebeb;
                    margin-bottom: 25px;
                }
                .add{
                    button {
                        padding: 16px 32px !important;
                        vertical-align: middle;
                        margin-left: 13px;
                        margin-top: -1px;
                    }
                }
            }
        }
    }
</style>
