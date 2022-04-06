<template>
    <div class="cart-item">
        <div :class="['image',{alone,}]">
            <div class="image-frame">
                <img :src="image" :alt="product.title">
            </div>
        </div>
        <div>
            <div class="name"><span class="nm">{{ product.title }}</span><span class="quantity" v-if="alone" @click="remove">x<span>{{quantity}}</span></span></div>
            <div class="brand">{{ product.brand }}</div>
            <div class="price" v-if="alone">{{ price }}</div>
        </div>
    </div>
</template>

<script>
import product from "../mixings/product";
export default {
    name: "CartItem",
    mixins: [product, ],
    props:{
        product:Object,
        quantity:Number,
        alone: {
            type: Boolean,
            default: true,
        },
    },
    methods:{
        remove(){
            this.$store.commit('addItem', {product_id:this.product.title, quantity: 0});
        },
    }
}
</script>

<style scoped lang="scss">
.cart-item{
    display: flex;
    text-transform: uppercase;
    font-size: 0.8em;
    align-items: center;
    .image{
        margin-right: 5px;
        width: 50px;
        .image-frame {
            padding-bottom: 100% !important;
        }
        &.alone{
            width: 75px;
            min-width: 75px;
        }
    }
    .brand{
        color: #bababa;
        font-size: 0.9em;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .price{
        font-weight: bold;
    }
    .name{
        span.nm{
            font-weight: bold;
            letter-spacing: 1px;
        }
        .quantity{
            font-size: 0.8em;
            margin-left: 6px;
            font-weight: 100;
            >span{
                margin-left: 4px;
            }
        }
        margin-bottom: 5px;
    }

}
</style>
