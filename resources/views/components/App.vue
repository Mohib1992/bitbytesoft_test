<template>
    <!--<div class="container mx-auto my-12">-->
    <!--<div class="flex justify-center max-w-full pb-5 row-span-2" v-for="job in jobList" :key="job.id">-->
    <!--<job_card :title="job.title"-->
    <!--:description="job.description"-->
    <!--:created_at="job.created_at"-->
    <!--:company="job.company"-->
    <!--&gt;-->
    <!--</job_card>-->
    <!--</div>-->
    <!--</div>-->
    <div class="flex h-screen bg-gray-100 font-roboto">
        <div class="bg-white w-1/3 z-30">
            <div class="flex items-center justify-center mt-8">
                <form class="mb-4 pt-6 px-16 rounded w-full">
                    <div class="mb-4">
                        <input class="border border-blue-200 leading-tight px-3 py-2 rounded shadow text-gray-700 w-full"
                               id="username" type="text" placeholder="Search Jobs....">
                    </div>
                    <button class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button">
                        Search
                    </button>
                </form>
            </div>
            <div>
                <form class="mb-4 pt-6 px-16 rounded w-full">
                    <select name="attribute"
                            class="mb-2 border border-blue-200 leading-tight px-3 py-2 rounded shadow text-gray-700 w-full">
                        <option value="0">Job Title</option>
                        <option value="0">Company</option>
                        <option value="0">Posted At</option>
                    </select>
                    <select name="attribute"
                            class="border border-blue-200 leading-tight px-3 py-2 rounded shadow text-gray-700 w-full">
                        <option value="desc">Desc</option>
                        <option value="asc">Asc</option>
                    </select>
                    <button class="mt-2 bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button">
                        Sort
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                <div class="px-6 py-8">
                    <div class="grid col-span-1">
                        <div class="flex w-screen mb-2" v-for="job in jobList"
                             :key="job.id">
                            <job_card :title="job.title"
                                      :description="job.description"
                                      :created_at="job.created_at"
                                      :company="job.company"
                            >
                            </job_card>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</template>
<script>
    import job_card from "./JobCard";

    export default {
        components: {job_card},
        data() {
            return {
                jobList: [
                    {
                        id: 1,
                        title: 'title',
                        description: 'this is description',
                        created_at: '23/23/2333',
                        company: 'abcd'
                    },
                    {
                        id: 2,
                        title: 'title 2',
                        description: 'this is description',
                        created_at: '23/23/2333',
                        company: 'abcd'
                    },
                    {
                        id: 3,
                        title: 'title 2',
                        description: 'this is description',
                        created_at: '23/23/2333',
                        company: 'abcd'
                    },
                    {
                        id: 4,
                        title: 'title 2',
                        description: 'this is description',
                        created_at: '23/23/2333',
                        company: 'abcd'
                    }
                ],
                info: null,
                loading: true,
                errored: false
            }
        },
        mounted() {
            // const headers = {};
            // axios
            //     .get('https://paikat.te-palvelut.fi/tpt-api/tyopaikat?englanti=true', { headers })
            //     .then(response => {
            //         this.info = response.data.bpi
            //     })
            //     .catch(error => {
            //         console.log(error)
            //         this.errored = true
            //     })
            //     .finally(() => this.loading = false)
        }
    };
</script>