<template>
    <ul class="cart-button" @click="show" >
        <li>
            <span class="noselect">My Cart <span v-if="totalItems > 0">({{totalItems}})<i class="fa-solid fa-caret-down"></i></span></span>
            <div class="details" v-if="showDetails && totalItems > 0" @click.stop.prevent>
                <div class="lst">
                    <cart-list @update="updated" :alone="true" />
                </div>
                <div class="actions">
                    <button class="white" @click="navigate('/cart')">View Cart</button>
                    <button class="back" @click="showDetails = false;">Chackout</button>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
import CartList from "./CartList";
export default {
    name: "CartButton",
    data(){
       return {
           showDetails: false,
       };
    },
    components:{
        CartList,
    },
    mounted() {
        addEventListener('click', this.windowClick);
    },
    beforeUnmount() {
    },
    computed:{
        totalItems(){
            let t = 0;
            for (const title in this.$store.state.cart) {
                /* eslint-disable no-prototype-builtins */
                if (this.$store.state.cart.hasOwnProperty(title)) {
                    t += this.$store.state.cart[title];
                }
            }
            return t;
        }
    },
    methods:{
        updated(){
            this.$nextTick(()=>{
                if(this.totalItems === 0 && this.showDetails)this.showDetails = false;
            });
        },
        show(){
            if(!this.showDetails)this.showDetails = this.totalItems > 0;
            else this.showDetails = false;
        },
        navigate(to){
            this.showDetails = false;
            this.$router.push(to);
        },
        windowClick(e){
            if(!this.showDetails) return;
            let elm =  e.target;
            while (elm.parentNode !== document.body){
                elm = elm.parentNode;
                if(elm === this.$el)return;
            }
            this.showDetails = false;
        }
    }
}
</script>

<style scoped lang="scss">
.cart-button{
    cursor: pointer;
    margin: 0 !important;
    position: relative;
    margin: -20px;
    .fa-caret-down{
        margin-left: 10px;
    }
    >li{
        height: 72px;
        display: flex;
        align-items: center;
    }
    .details{
        -webkit-box-shadow: 5px 5px 12px 1px rgba(0,0,0,0.33);
        box-shadow: 5px 5px 12px 1px rgba(0,0,0,0.33);
        position: absolute;
        top: 100%;
        z-index: 2;
        background: white;
        width: 100vw;
        right: 0;
        padding: 10px;
        max-width: 300px;
        .lst{
            overflow: auto;
            max-height: 300px;
            margin-bottom: 10px;
            ::v-deep{
                text-align: left;
                div.single{
                    margin: 10px 0;
                    &:first-child{
                        margin-top: 0;
                    }
                }
            }
        }
        .actions{
            display: flex;
            margin-left: -10px;
            button{
                white-space: nowrap;
                flex: 1;
                margin-left: 10px;
                padding: 12px 0 !important;
            }
        }
    }
}
</style>
