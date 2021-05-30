import Vue from 'vue';
import Buefy from 'buefy'
import Vuex from 'vuex'
import VueRouter from 'vue-router'

import App from './components/App.vue'
import '@mdi/font/css/materialdesignicons.css'
import 'buefy/dist/buefy.css'



Vue.use(Buefy).use(Vuex).use(VueRouter);

Vue.filter('toCurrency', function (val) {
    var value = parseFloat(val);
    if (typeof value !== "number") {
        return value;
    }
    var formatter = new Intl.NumberFormat('it-IT', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 0
    });
    return formatter.format(value);
});

const store = new Vuex.Store({
    state: {
        item: [],
        menus: [],
        modified: false,
        timeout: null,
        darkmode: false,
        coperto: null,
    },
    mutations: {
        darken(state) {
            state.darkmode = !state.darkmode;
        },
        increment (state, food) {
            state.modified = true;

            const section = food.$parent.section;
            const foodinfo = state.item.find(function (element) {
                return element.secId == section.id
            })

            if(!foodinfo) {
                state.item.push({ "secId": section.id ,"secName" : section.Name, "foods" : Array(food) })
            } else {
                const foodfound = 
                    foodinfo.foods.find( storedfood => {    
                        return storedfood.food.id == food.food.id;
                    })

                if(!foodfound) {
                    foodinfo.foods.push(food);
                }
            }

            store.commit("throwcartinfo")
        },
        decrement (state, food) {
            state.modified = true;

            if(food.quantity <= 0) {

                const section = food.$parent.section;
                const foodinfo = state.item.find(function (element) {
                    return element.secId == section.id
                })
                
                if(foodinfo) {
                    const foodfoundindex = 
                        foodinfo.foods.findIndex( storedfood => {    
                            return storedfood.food.id == food.food.id;
                        })

                    if(foodfoundindex != -1) {
                        foodinfo.foods.splice(foodfoundindex,1)
                    }

                    if(foodinfo.foods.length == 0) {
                        const foodinfoindex = state.item.findIndex(function (element) {
                            return element.secId == section.id
                        })
                        state.item.splice(foodinfoindex,1)
                    }
                }

            }

            store.commit("throwcartinfo")            
        },
        incrementmenu(state, menu) {
            state.modified = true;

            if(menu.quantity > 1) {
                const foundmenu = state.menus.find((fixedmenu) => {
                    return fixedmenu.menu.id == menu.menu.id
                })
                foundmenu.quantity = menu.quantity;
            } else {
                state.menus.push(menu)
            }   

            store.commit("throwcartinfo")
        },
        decrementmenu(state, menu) {
            state.modified = true;
            
            if(menu.quantity == 0) {
                const indexmenu = state.menus.findIndex((fixedmenu) => {
                    return fixedmenu.menu.id == menu.menu.id;
                    })
                state.menus.splice(indexmenu, 1)
            } else {
                const foundmenu = state.menus.find((fixedmenu) => {
                    return fixedmenu.menu.id == menu.menu.id;
                    })

                foundmenu.quantity = menu.quantity;
            }

            store.commit("throwcartinfo")
        },
        throwcartinfo(state) {
            if(!state.timeout) {
                state.timeout = setTimeout(() => {
                    state.modified = false;
                    state.timeout = null;
                },2000)
            }
        }
    },
    getters: {
        foodcount: state => {
            let count = 0;
            state.item.forEach( section =>  {
                section.foods.forEach(food => {
                    count += food.quantity  
                })
            })

            state.menus.forEach( menu => {
                count += menu.menu.FixedMenuFoods.length * menu.quantity
            })

            return count;
        },

        totalcost: state => {
            let cost = 0.0;

            state.item.forEach( section => {
                section.foods.forEach( food => {
                    if(food.isAlternativeSelected) {
                        cost += food.quantity * food.food.second_price
                    } else {
                        cost += food.quantity * food.food.price
                    }
                    
                })
            })

            state.menus.forEach( menu => {
                cost += menu.quantity * menu.menu.totalPrice;
            })

            if(state.coperto && cost > 0.0) {
                cost += state.coperto;
            }

            return cost;
        }
    }
  })

new Vue({
    components: {App},
    store: store,
}).$mount("#app")