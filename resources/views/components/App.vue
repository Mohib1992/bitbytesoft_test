<template>
    <div class="flex h-screen bg-gray-100 font-roboto">
        <div class="bg-white w-1/3 z-30">
            <div class="flex items-center justify-center mt-8">
                <form class="mb-4 pt-6 px-16 rounded w-full">
                    <div class="mb-4">
                        <input class="border border-blue-200 leading-tight px-3 py-2 rounded shadow text-gray-700 w-full"
                               id="search" type="text" placeholder="Search Jobs...."
                               v-model="search"
                        >
                    </div>
                    <button class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button"
                            @click="searchJob"
                    >
                        Search
                    </button>
                </form>
            </div>
            <div>
                <form class="mb-4 pt-6 px-16 rounded w-full">
                    <select name="attribute"
                            v-model="attribute"
                            @change="onChange"
                            class="mb-2 border border-blue-200 leading-tight px-3 py-2 rounded shadow text-gray-700 w-full">
                        <option value="title">Job Title</option>
                        <option value="company">Company</option>
                        <option value="posted_at">Posted At</option>
                    </select>
                    <select name="order"
                            v-model="order"
                            @change="onChange"
                            class="border border-blue-200 leading-tight px-3 py-2 rounded shadow text-gray-700 w-full">
                        <option value="desc">Desc</option>
                        <option value="asc">Asc</option>
                    </select>
                </form>
            </div>
            <pagination v-if="meta" :meta="meta" @paginate="loadData"></pagination>
        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                <div class="bg-white px-6 py-8">
                    <div class="grid col-span-1">
                        <div v-if="!loading"
                             class="flex w-screen mb-2" v-for="job in jobList"
                             :key="job.id">
                            <job_card
                                    :title="job.title"
                                    :description="job.description"
                                    :created_at="job.created_at"
                                    :company="job.company"
                            >
                            </job_card>
                        </div>
                    </div>
                    <div class="flex justify-center pt-28 h-screen" v-if="loading">
                        <div class="loader"></div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</template>
<style>
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<script>
    import job_card from "./JobCard";
    import Pagination from "./pagination";

    export default {
        components: {Pagination, job_card},
        data() {
            return {
                jobList: null,
                loading: true,
                errored: false,
                attribute: 'title',
                order: 'desc',
                search: null,
                meta: {
                    total: 0,
                    from: 0,
                    to: 0,
                    nextPageUrl: null,
                    prevPageUrl: null,
                }
            }
        },
        mounted() {
            axios
                .get('/syncData')
                .then(response => {
                    this.loadData();
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true;
                })
                .finally(() => this.loading = false)
        },
        methods: {
            loadData() {
                this.loading = true;
                axios
                    .get('/jobs', {
                        params: {
                            query: this.search,
                            field: this.attribute,
                            orderBy: this.order,
                            page: localStorage.current_page
                        }
                    })
                    .then(response => {
                        this.jobList = response.data.data;
                        this.meta.total = response.data.total;
                        this.meta.from = response.data.from;
                        this.meta.to = response.data.to;
                        this.meta.nextPageUrl = response.data.next_page_url;
                        this.meta.prevPageUrl = response.data.prev_page_url;
                        localStorage.current_page = response.data.current_page;
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error)
                        this.errored = true;
                    })
                    .finally(() => this.loading = false)
            },
            onChange() {
                this.loadData();
            },
            searchJob() {
                if (!this.search)
                    return;

                this.loadData();
            }
        }
    };
</script>