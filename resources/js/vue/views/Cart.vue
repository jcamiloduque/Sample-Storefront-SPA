<template>
    <div class="cart">
        <h3>Shopping Cart</h3>
        <div class="container">
            <div>
                <template v-if="hasProducts">
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        <cart-list @update="updated" />
                        <tr>
                            <td colspan="4" class="tlt">
                                <table>
                                    <tr>
                                        <td>Cart Overview</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>{{total}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>{{total}} CAD</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="total">
                        <div class="continue">
                            <router-link to="/" class="cnt">Continue shopping</router-link>
                        </div>
                        <div class="tlt">
                            Subtotal <br>
                            <small>Shipping & taxes calculated at checkout</small>
                        </div>
                        <div class="_t">
                            {{total}}
                        </div>
                        <div class="chout">
                            <button class="dark">Checkout ({{total}})</button>
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
    background: #f6f6f6;
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
    .cnt{
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 1px;
        font-size: 0.8em;
        color: var(--font-colour);
        border-bottom: 1px solid;
        padding-bottom: 3px;
    }
    .container{
        flex: 1;
        display: flex;
        flex-direction: column;
        background: white !important;
        max-width: 800px !important;
        >div{
            padding: 100px 70px;
        }
    }
    div >table{
        width: 100%;
        overflow: hidden;
        border-collapse: collapse;

        ::v-deep{
            >tr{
                >th{
                    color: #88929b;
                    text-transform: uppercase;
                    font-size: 0.8em;
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
                    &.tlt{
                        text-align: right;
                    }
                }
            }
        }

        table{
            margin-left: auto;
            min-width: 50%;
            text-transform: uppercase;
            color: #b6b0ab;
            font-size: 0.8em;
            tr{
                td{
                    font-weight: bold;
                    &:first-child{
                        font-weight: bold;
                        text-align: left;
                    }
                }
                &:last-child{
                    td{
                        &:last-child{
                            color: #555150;
                        }
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
        .continue{
            flex: 1;
        }
        .tlt{
            width: 70%;
            flex-direction: column;
            align-items: stretch;
            text-align: right;
            margin-right: 30px;
            display: none;
        }
        ._t{
            width: 30%;
            font-weight: bold;
            display: none;
        }
    }
}
</style>
