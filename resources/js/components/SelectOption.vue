<template>
    <div class="bg-white">

        <div class="flex flex-col space-y-8 overflow-y-scroll container pb-4 mb-40 mt-16">
            <div class="flex mx-4 mt-4">
                <img src=""
                     class="rounded-md w-32 h-32 md:w-52 md:h-52">
                <div class="flex-grow">
                    <div class="flex-col pl-4">
                        <div class="flex-grow text-2xl md:text-4xl mx-4 mt-4">
                            {{ product.product_name }}
                        </div>
                        <div class="text-3xl md:text-5xl  mt-5 float-end text-yellow-500">
                            HK${{ min_price }} ~
                            HK${{ max_price }}

                        </div>
                    </div>
                </div>
            </div>

            <div class="flex mx-4">
                <div class="text-2xl">
                    Quantity
                </div>
                <div class="flex-grow ">
                    <div class="flex space-x-6 float-end align-middle">
                        <div class="text-2xl hover:cursor-pointer" @click="qty = changeQty(0, qty)">-</div>
                        <div class="text-2xl ">{{ qty }}</div>
                        <div class="text-2xl hover:cursor-pointer text-yellow-500" @click="qty = changeQty(1, qty)">+
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col mx-4" v-for="(category, catIndex) in product_options">
                <div class="text-2xl">
                    {{ category.option_name }}
                </div>
                <div class="flex flex-wrap mt-3">

                    <button v-for="(values, valIndex) in category.option_values"
                            v-bind:key="values.option_value_id"
                            v-on:click="[clickedOption(catIndex, valIndex)]"
                            :ref="'optionButton' + values.option_value_id"
                            :class="buttonStyle(values.clicked, values.available)">

                        {{ values.option_value_name }} - {{ values.option_value_id }}

                    </button>

                    <!--                    @click="checkAvailable(category.option_id, values.option_value_id)"-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SelectOption",
    props: [
        'product',
        'product_sku',
    ],

    data() {
        return {
            product_name: null,
            min_price: null,
            max_price: null,
            product_options: [],
            qty: 1,
            mapping: [],
            clickedOptions: []
        }
    },

    mounted() {
        axios.post('/api/fetch').then
        (
            axios.get('/api/product').then(response => {
                this.product = response.data;
                this.min_price = response.data.min_price;
                this.max_price = response.data.max_price;
            }),
            axios.get('/api/product_sku').then(response => {
                this.product_sku = response.data;
                this.createMap();
            }),
            axios.get('/api/product_options').then(response => {
                this.product_options = response.data;

                this.product_options.forEach((category, catIndex) => {
                        category.option_values.forEach((options, optionIndex) =>
                            options = Object.assign(options, {clicked: false, available: true}),
                        )
                    },
                )
            }),
            this.checkAvailable()
        ).catch((err) => {
            (err);
        })
    },

    methods: {

        buttonStyle(clicked, available) {
            return {
                'px-4 py-2 my-2 mr-2 rounded-full decoration-2 line-through text-gray-400 bg-gray-200 font-semibold text-sm align-center w-max cursor-pointer transition duration-200 ease whitespace-nowrap': !available,
                'px-4 py-2 my-2 mr-2 rounded-full bg-gray-200 bg-gray-200 font-semibold text-sm align-center w-max cursor-pointer transition duration-200 ease whitespace-nowrap': !clicked,
                'px-4 py-2 my-2 mr-2 rounded-full text-yellow-500 bg-amber-100 font-semibold text-sm align-center w-max cursor-pointer transition duration-200 ease whitespace-nowrap': clicked
            }
        },

        clickedOption: function (option_id, option_values_id) {
            this.product_options[option_id].option_values[option_values_id].clicked = !this.product_options[option_id].option_values[option_values_id].clicked;

            this.product_options[option_id].option_values.forEach((option, index) => {
                    if (index != option_values_id) {
                        this.product_options[option_id].option_values[index].clicked = false;
                    }
                }
            )
            this.checkAvailable();
            this.$forceUpdate();
        },

        changeQty: function (change, qty) {
            var vm = this;
            if (!change) {
                if (qty > 1) {
                    vm.min_price = vm.product.min_price * (qty - 1);
                    vm.max_price = vm.product.max_price * (qty - 1);

                    return qty - 1;
                } else
                    return 1;
            }

            if (change) {
                vm.min_price = vm.product.min_price * (qty + 1);
                vm.max_price = vm.product.max_price * (qty + 1);

                return qty + 1;
            }
        },

        createMap: function () {
            this.product_sku.forEach((sku, skuIndex) => {
                this.mapping.push(JSON.parse(sku.sku_mapping))
            })
        },

        checkAvailable: function () {
            var option_id;
            var value_id;
            this.clickedOptions = [];

            // Get clicked options
            this.product_options.forEach((category, optionIndex) => {
                category.option_values.forEach((options, valueIndex) => {
                        if (options.clicked) {
                            option_id = category.option_id;
                            value_id = options.option_value_id;
                            this.clickedOptions.push({option_id, value_id});
                        }
                    }
                )
            })

            // Check mapping

            var score = 0;


            this.mapping.forEach((map, mapIndex) => {

                // (map);

                map.forEach((mapOption, mapOptionIndex) => {
                    // (mapOption);
                    this.clickedOptions.forEach((option, catIndex) => {

                        if (mapOption.option_id == option.option_id && mapOption.option_value_id == option.value_id) {
                            score++;
                        }
                    })
                })


                if (score == this.clickedOptions.length || this.clickedOptions.length == 0) {
                //
                //     ( map);
                //
                    this.product_options.forEach((category, optionIndex) => {
                            category.option_values.forEach((options, valueIndex) => {
                                options.available = true;
                            })
                    })

                    map.forEach((button) => {
                        this.$refs['optionButton'][button.option_value_id].available = false;

                        // (button)
                        // this.product_options.forEach((category, optionIndex) => {
                        //     category.option_values.forEach((options, valueIndex) => {
                        //         (options.option_value_name + ' status: ' + (button.option_id == category.option_id  && button.option_value_id == options.option_value_id));
                        //         if(button.option_id == category.option_id  && button.option_value_id == options.option_value_id)
                        //         {
                        //             this.product_options[optionIndex].option_values[valueIndex].available = false;
                        //         }
                        //
                        //     })
                        // })
                        ('---------------------');
                        }
                    )

                    // ('---------------');
                }
                this.$forceUpdate();

                score = 0;
            })
        }
    },
}


</script>

<style scoped>

</style>
