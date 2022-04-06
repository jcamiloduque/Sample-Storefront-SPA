<template>
    <div class="hero">
        <div class="content">
            <h3>Plates</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eligendi explicabo hic natus nisi saepe sit. Amet architecto autem excepturi, fugiat fugit illum labore officia perspiciatis.</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Hero"
}
</script>

<style scoped lang="scss">
    .hero{
        display: flex;
        position: relative;
        background-image: url("./../assets/media/plates-header.jpg");
        min-height: 20vw;
        width: 100%;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        justify-content: center;
        align-items: stretch;
        >.content{
            background: #42423e;
            color: white;
            display: flex;
            max-width: 700px;
            width: calc(80% - 60px);
            border-style: solid;
            border-color: white;
            border-width: 0 10px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            >h3{
                font-size: 2.7em;
                font-family: 'Times New Roman', serif;
                margin: 0;
                padding-bottom: 15px;
                border-bottom: 1px solid;
                display: inline-block;
            }
            >p{
                margin-top: 25px;
                font-weight: bold;
            }
        }
        @media all and (max-width: 950px){
            >.content{
                width: 100%;
                max-width: 100%;
                border: none;
            }
        }
    }
</style>
