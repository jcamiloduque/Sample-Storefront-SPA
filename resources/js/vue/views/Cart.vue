<template>
    <div class="cart">
        <ul class="breadcrumb">
            <li><router-link to="/">Home</router-link></li>
            <li>Cart</li>
        </ul>
        <div class="container">
            <template v-if="hasProducts">
                <div class="t-container">
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        <cart-list @update="updated" />
                    </table>
                </div>
                <div class="total">
                    <div class="continue">
                        <button class="gray" @click="$router.push('/')">Continue shopping</button>
                    </div>
                    <div class="tlt">
                        Subtotal <br>
                        <small>Shipping & taxes calculated at checkout</small>
                    </div>
                    <div class="_t">
                        {{total}}
                    </div>
                    <div class="chout">
                        <button class="dark">Checkout </button>
                    </div>
                </div>
            </template>
            <div v-if="!hasProducts" class="empty">
                Looks like your cart is empty
                <div>
                    <button class="gray" @click="$router.push('/')">Continue shopping</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import CartList from "../components/CartList";
export default {
    name: "Cart",
    components:{CartList,},
    data(){
        return {
            products: [],
        };
    },
    methods:{
        updated(products){
            this.products = products;
        }
    },
    computed:{
        total(){
            let val = 0;
            this.products.map(p=>val+=p.product.price * p.quantity);
            if(isNaN(val))val = 0;
            else val = Math.round((val + Number.EPSILON) * 100) / 100;
            return "$" + val.toFixed(2);
        },
        hasProducts(){
            for (const title in this.$store.state.cart) {
                /* eslint-disable  no-prototype-builtins */
                if (this.$store.state.cart.hasOwnProperty(title)) {
                    return true;
                }
            }
            return false;
        }
    }
}
</script>

<style scoped lang="scss">
.cart{
    display: flex;
    flex-direction: column;
    .t-container{
        border-radius: 3px;
        border: 1px solid #88929b;
        overflow: hidden;
    }
    .empty{
        flex: 1;
        display: flex;
        flex-direction: column;
        text-align: center;
        justify-content: center;
        >div{
            margin-top: 40px;
        }
    }
    .container{
        flex: 1;
        display: flex;
        flex-direction: column;

    }
    table{
        width: 100%;
        overflow: hidden;
        border-collapse: collapse;

        ::v-deep{
            tr{
                >th{
                    background: #f7f9fa;
                    color: #88929b;
                }
                >*{
                    border-bottom: 1px solid #adb6b9;
                    padding: 10px;
                    &:first-child{
                        width: 60%;
                    }
                    &:last-child{
                        text-align: right !important;
                    }
                }
                &:last-child{
                    >*{
                        border-bottom: none;
                    }
                }
            }
        }
    }
    button{
        white-space: nowrap;
    }
    .total{
        margin-top: 40px;
        display: flex;
        >div{
            display: flex;
            align-items: center;
        }
        .tlt{
            width: 70%;
            flex-direction: column;
            align-items: stretch;
            text-align: right;
            margin-right: 30px;
        }
        ._t{
            width: 30%;
            font-weight: bold;
        }
    }
}
</style>
