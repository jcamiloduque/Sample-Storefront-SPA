<template>
    <span class="quantity-selector">
        <input type="number" v-model="val" min="1" >
        <button class="add" @click="$emit('update:modelValue', val + 1)"><span>+</span></button>
        <button class="remove" @click="$emit('update:modelValue', val - 1 >= 1 ? val - 1 : 1)"><span>-</span></button>
    </span>
</template>

<script>
export default {
    name: "Quantity",
    props: ['modelValue'],
    computed:{
        val:{
            get(){
                return this.modelValue;
            },
            set(val){
                this.$emit('update:modelValue', parseInt(val));
            }
        }
    }
}
</script>

<style scoped lang="scss">
.quantity-selector{
    position: relative;
    padding-right: 25px;
    height: 48px;
    display: inline-block;
    width: 85px;
    >input{
        height: 48px;
        border: none;
        background: #eeeeee;
        color: #8d8d8d !important;
        font-weight: 600;
        width: 100%;
        text-align: center;
        -moz-appearance: textfield;
        &::-webkit-outer-spin-button,
        &::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    }
    >button{
        position: absolute;
        background: #dbdbdb !important;
        color: #a9a9a9 !important;
        font-weight: bold !important;
        width: 23px;
        padding: 0 !important;
        height: 23px;
        top: 0;
        display: flex !important;
        right: 0;
        align-items: center;
        justify-content: center;
        span{
            font-size: 18px;
            line-height: 17px;
            position: relative;
            top: -1px;
            right: -1px;
        }
        &.remove{
            top: 25px;
        }
    }
}
</style>
