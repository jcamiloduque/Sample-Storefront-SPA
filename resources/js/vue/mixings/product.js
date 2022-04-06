
export default {
    methods:{
        addToCart(quantity = 1){
            this.$store.commit('addItem', {product_id:this.product.title, quantity});
        }
    },
    computed:{
        image(){
            return '/media/' + this.product.image;
        },
        price(){
            let val = parseFloat(this.product.price);
            if(isNaN(val))val = 0;
            else val = Math.round((val + Number.EPSILON) * 100) / 100;
            return "$" + val.toFixed(2);
        },
    }
}
