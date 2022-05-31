<template>
    <div class="bg-white">
        <div class="flex flex-col space-y-8 overflow-y-scroll container pb-4 mb-40 mt-16">
            <div class="flex mx-4 mt-4">
                <img src="https://orderhk.pokeguide.com/storage/img/goods/4/9332010275ffe76d5bdb046.02877134.jpeg"
                     class="rounded-md w-32 h-32 md:w-52 md:h-52">
                <div class="flex-grow">
                    <div class="flex-col pl-4">
                        <div class="flex-grow text-2xl md:text-4xl mx-4 mt-4">
                            {{ product.product_name }}
                        </div>
                        <div class="text-3xl md:text-5xl  mt-5 float-end text-yellow-500">
                            HK$26.00
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
                        <div class="text-2xl hover:cursor-pointer">-</div>
                        <div class="text-2xl ">1</div>
                        <div class="text-2xl hover:cursor-pointer text-yellow-500">+</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col mx-4">
                <div class="text-2xl">
                    Size
                </div>
                <div class="flex-wrap mt-3">
            <span
                class="px-4 py-2 mr-2 rounded-full text-gray-500 bg-gray-200 font-semibold text-sm align-center w-max cursor-pointer transition duration-300 ease whitespace-nowrap	">
                 large</span>

                    <span
                        class="px-4 py-2 rounded-full text-yellow-500 bg-amber-100 font-semibold text-sm text-center w-max cursor-pointer transition duration-300 ease whitespace-nowrap	">
                 small</span>
                </div>
            </div>

            <div class="flex flex-col mx-4">
                <div class="text-2xl">
                    Color
                </div>
                <div class="flex flex-wrap mt-3">
            <span
                class="px-4 py-2 my-2 mr-2 rounded-full text-gray-500 bg-gray-200 font-semibold text-sm align-center w-max cursor-pointer transition duration-300 ease whitespace-nowrap	">
                 Black black Black black</span>

                    <span
                        class="px-4 py-2 my-2 mr-2 rounded-full text-yellow-500 bg-amber-100 font-semibold text-sm text-center w-max cursor-pointer transition duration-300 ease whitespace-nowrap	">
                 yellow yellow yellow yellow</span>

                    <span
                        class="px-4 py-2 my-2 mr-2 rounded-full text-decoration-line-through text-gray-500 bg-gray-200 font-semibold text-sm text-center w-max cursor-pointer transition duration-300 ease whitespace-nowrap	">
                 white white white white</span>
                </div>
            </div>

            <div class="flex flex-col mx-4">
                <div class="text-2xl">
                    Origin
                </div>
                <div class="flex-wrap mt-3">
            <span
                class="px-4 py-2 rounded-full mr-2 text-gray-500 bg-gray-200 font-semibold text-sm w-max cursor-pointer transition duration-300 ease whitespace-nowrap	">
                 HK</span>

                    <span
                        class="px-4 py-2 rounded-full mr-2 text-yellow-500 bg-amber-100 font-semibold text-sm w-max cursor-pointer transition duration-300 ease whitespace-nowrap">
                 vietnam</span>

                    <span
                        class="px-4 py-2 rounded-full mr-2 text-decoration-line-through text-gray-500 bg-gray-200 font-semibold text-sm text-center w-max cursor-pointer transition duration-300 ease whitespace-nowrap	">
                 Taiwan</span>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "SelectOption",
    data() {
        return {
            product_name: null
        }
    },

    mounted()
    {
        axios.post('/api/fetch').then
        (
            axios.get('/api/product').then(response => {
                this.product = response.data;
            })
        )

    }
}


</script>

<style scoped>

</style>
