<template>
    <header id="nav" :class="{min, }">
        <div class="min-menu" @click="expanded=!expanded">
            <div :class="['animated-icon', {'open': expanded}]"><span></span><span></span><span></span></div>
        </div>
        <router-link to="/" class="logo"><img src="./../assets/media/logo.png" alt=""></router-link>
        <ul class="main" v-if="!min || expanded" @click="$nextTick(()=>expanded = false)">
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/about">Shop</router-link></li>
            <li><router-link to="/journal">Journal</router-link></li>
            <li><router-link to="/more">More</router-link></li>
        </ul>
        <div class="cart">
            <cart-button />
        </div>
    </header>
</template>

<script>
    import CartButton from "./CartButton";
    export default {
        name: "Header",
        components:{
            CartButton
        },
        data(){
            return {
                min: false,
                expanded: false,
            };
        },
        mounted() {
            addEventListener('resize', this.onResize);
            this.onResize();
        },
        beforeUnmount() {
            removeEventListener('resize', this.onResize);
        },
        watch:{
            '$route': function(){
                this.expanded = false;
            },
        },
        methods:{
            onResize(){
                this.min = window.innerWidth <= 650;
            }
        }
    }
</script>

<style scoped>

</style>
