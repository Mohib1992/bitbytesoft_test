<template>
    <div>
        <h1>This is vue</h1>
        {{message}}
    </div>
</template>
<script>
    export default {
        computed: {},
        data() {
            return {
                message: 'Hello World'
            }
        }
    };
</script>