<template>
    <div class="border border-blue-300 md:w-2/5 p-3 rounded-xl shadow-md space-y-3">
        <section class="text-sm font-thin">
            {{ created_at }}
        </section>
        <section class="text-3xl font-bold">
            {{ title }}
        </section>
        <section class="font-normal text-md text-gray-400">
            {{ description }}
        </section>
        <section class="font-bold text-lg text-blue-500">
            {{ company }}
        </section>
        <section class="flex justify-end">
            <button type="button"
                    class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    @click="showLongDescription">
                Read more
            </button>
        </section>
    </div>
</template>

<script>
    export default {
        name: "job_card",
        props: {
            title: {required: true, type: String},
            description: {required: true, type: String},
            created_at: {required: true, type: String},
            company: {required: true, type: String}
        },
        methods: {
            showLongDescription() {
                console.log('show long description');
            }
        }
    }
</script>

<style scoped>

</style>