<template>
    <app-header/>
    <div class="cnt"><router-view/></div>
    <app-footer/>
</template>
<script>
    import AppHeader from "./components/Header";
    import AppFooter from "./components/Footer";
    export default {
        name: "App",
        components:{AppHeader, AppFooter,},
    }
</script>
<style lang="scss" scoped>
    .cnt{
        flex: 1;
        display: flex;
        >div{
            flex: 1;
        }
    }
</style>
