<template>
    <div class="border border-blue-300 w-1/2 p-3 rounded-xl shadow-md space-y-3">
        <section class="text-sm font-thin">
            {{ created_at | dateFormat }}
        </section>
        <section class="text-3xl font-bold">
            {{ title }}
        </section>
        <section class="font-normal text-md text-gray-400">
            <span v-if="!readMore">
                {{ description | short }}
            </span>
            <span v-else>
                {{ description }}
            </span>
        </section>
        <section class="font-bold text-lg text-blue-500">
            {{ company }}
        </section>
        <section class="flex justify-end">
            <button type="button"
                    class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    @click="showLongDescription">
                Read <span v-if="!readMore"> More </span> <span v-else> Less</span>
            </button>
        </section>
    </div>
</template>

<script>
    export default {
        name: "job_card",
        data() {
            return {
                readMore: false
            }
        },
        props: {
            title: {required: true, type: String},
            description: {required: true, type: String},
            created_at: {required: true, type: String},
            company: {required: true, type: String}
        },
        filters : {
            short(value) {
                return value.slice(0, 200) + '......';
            },

            dateFormat(value) {
                return new Date(value);
            }
        },
        methods: {
            showLongDescription() {
                this.readMore = !this.readMore;
            }
        }
    }
</script>

<style scoped>

</style>