<template>
    <div class="not-found flex-center position-ref full-height">
        <div class="content">
            <div class="error">404</div>
            <div class="description">Page Not Found</div>
            <div class="title">Sorry, the page you are looking for could not be found.</div>
            <div class="actions">
                <button class="gray" @click="$router.push('/')">Continue shopping</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "NotFound"
}
</script>

<style scoped lang="scss">
    .not-found{
        background-color: #fff;
        color: #636b6f;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        flex: 1;
        margin: 0;
    }
    .full-height {
        flex: 1;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .content {
        text-align: center;
    }
    .title {
        font-weight: 300;
        margin-top: 15px;
    }
    .error {
        font-size: 200px;
        line-height: 200px;
        font-weight: 300;
    }
    .actions {
        margin-top: 20px;
    }
    .description{
        font-size: 20px;
    }
</style>
