import { createStore } from 'vuex'

function doSaveLocally(cart){
    if('localStorage' in window){
        window.localStorage.setItem('cart', JSON.stringify(cart));
    }
}

function getLocallySaved(){
    if('localStorage' in window){
        let tmp = JSON.parse(window.localStorage.getItem('cart'));
        if(tmp) return tmp;
    }
    return {};
}
/* eslint-disable no-unused-vars, no-debugger */
const store = createStore({
    state () {
        return {
            cart: getLocallySaved(),
        }
    },
    mutations: {
        addItem (state, {product_id, quantity}) {
            if(quantity > 0){
                if(!state.cart[product_id])state.cart[product_id] = 0;
                state.cart[product_id] += quantity;
            }
            else if(state.cart[product_id])delete state.cart[product_id];
            doSaveLocally(state.cart);
        },
        updateItem(state, {product_id, quantity}){
            if(state.cart[product_id]){
                state.cart[product_id] = quantity;
                doSaveLocally(state.cart);
            }
        }
    }
});

export default store;
