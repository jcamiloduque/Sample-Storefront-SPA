<template>
    <div class="footer" >
        <div class="container">
            © {{ year }} <a href="https://github.com/jcamiloduque">jcamiloduque</a>.
        </div>
    </div>
</template>

<script>
export default {
    name: "Footer",
    computed:{
        year(){
            return (new Date()).getFullYear();
        }
    }
}
</script>

<style scoped lang="scss">
.footer{
    border-top: 1px solid #ebebeb;
    .up{
        padding: 15px;
        border-bottom: 1px solid #ebebeb;
    }
    .container{
        padding: 30px 10px !important;
    }
    color: #4d4d4d;
    a{
        text-decoration: none;
        color: #4d4d4d;
    }
}
</style>
