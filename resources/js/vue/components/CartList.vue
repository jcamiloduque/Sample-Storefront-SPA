<template>
    <component class="cart-list" :is="alone ? 'div' : 'tr'" v-for="(product, i) in inCart" :key="`${i}-cart`" >
        <template v-if="!alone">
            <td>
                <cart-item :product="product.product" :quantity="product.quantity" :alone="false" />
            </td>
            <td>
                <quantity v-model="product.quantity" @update:modelValue="(q)=>updateQuantity(product, q)" />
            </td>
            <td>
                {{toMoney(product.product.price * product.quantity)}}
            </td>
            <td>
                <i class="fa-solid fa-times" @click="remove(product)"></i>
            </td>
        </template>
        <div v-if="alone" class="single">
            <cart-item :product="product.product" :quantity="product.quantity" :alone="true" />
            <span><i class="fa-solid fa-times" @click="remove(product)"></i></span>
        </div>
    </component>
</template>

<script>

import CartItem from "./CartItem";
import Quantity from "./Quantity";
export default {
    name: "CartList",
    components:{CartItem, Quantity, },
    props:{
        alone: {
            type: Boolean,
            default: false,
        }
    },
    data(){
        return {
            loading: true,
            products: [],
        };
    },
    mounted() {
        this.getProducts();
    },
    methods:{
        async getProducts() {
            this.loading = true;
            await this.axios.get('/v1/products', {
                headers: {
                    Accept: 'application/json'
                }
            }).then(response => {
                if (Array.isArray(response.data)) this.products = response.data;
            }).catch(() => {
            });
            this.loading = false;
        },
        remove(product){
            this.$store.commit('addItem', {product_id:product.product.title, quantity: 0});
        },
        updateQuantity(product, q){
            if(q > 0) {
                this.$store.commit('updateItem', {product_id: product.product.title, quantity: q});
            }
        }
    },
    computed:{
        inCart(){
            let products = [];
            for (const title in this.$store.state.cart) {
                /* eslint-disable  no-prototype-builtins */
                if (this.$store.state.cart.hasOwnProperty(title)) {
                    const product = this.products.find(p=>p.title === title);
                    if(product && this.$store.state.cart[title] > 0){
                        products.push({
                            product,
                            quantity: Math.floor(this.$store.state.cart[title]),
                        });
                    }
                }
            }
            this.$emit('update', products);
            return products;
        },
        toMoney(){
            return (data)=>{
                let val = parseFloat(data);
                if(isNaN(val))val = 0;
                else val = Math.round((val + Number.EPSILON) * 100) / 100;
                return "$" + val.toFixed(2);
            };
        }
    }
}
</script>

<style scoped lang="scss">
.cart-list{
    .quantity-selector{
        margin-right: 10px;

    }
    .fa-trash-can{
        color: #808080;
        cursor: pointer;
    }
    .single{
        display: flex;
        .cart-item{
            flex: 1;
        }
        .fa-times{
            color: #adadae;
        }
    }
}
</style>
