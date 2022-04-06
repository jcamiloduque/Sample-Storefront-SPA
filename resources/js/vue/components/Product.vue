<template>
    <figure>
        <router-link :to="url">
            <div class="image-frame">
                <img :src="image" :alt="product.title">
                <div class="hover">
                    <button type="button" class="dark">View details</button>
                    <button type="button" class="gray" @click.prevent.stop="addToCart(1)">Add to cart</button>
                </div>
            </div>
        </router-link>
        <figcaption>
            <router-link :to="url">
                <div class="brand">{{ product.brand }}</div>
                <div class="name">{{ product.title }}</div>
                <div class="price">{{ price }}</div>
            </router-link>
        </figcaption>
    </figure>
</template>

<script>
import product from "../mixings/product";

export default {
    name: "Product",
    mixins:[product],
    props:{
        product: {
            required: true,
            type: Object,
        },
    },
    computed:{
        url(){
            return '/product/'+encodeURIComponent(this.product.title);
        }
    }
}
</script>

<style scoped lang="scss">
    figure{
        $marging: 20px;
        display: block;
        margin: 0;
        width: 100%;
        padding: 0 $marging (2.5*$marging);
        -webkit-column-break-inside: avoid;
        page-break-inside: avoid;
        break-inside: avoid;

        figcaption{
            a {
                text-decoration: none;
                text-align: center;
            }
        }
        .brand{
            margin: 25px 0 5px;
            font-weight: bold;
            color: #989898;
        }
        .name{
            text-transform: uppercase;
            color: var(--font-colour);
            font-weight: 500;
            margin-bottom: 10px;
        }
        .price{
            font-family: Georgia, serif;
            color: #b4b4b4;
            font-weight: 600;
        }
    }
</style>
