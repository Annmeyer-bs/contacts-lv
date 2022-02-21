<template>
    <div>
        <headers></headers>
        <tables :url="url" :columns="columns"></tables>
    </div>
</template>

<script>
import Headers from './Header';
import Tables from "./Table/Table";

export default {
    components: {Tables, Headers},
    props: {
        url: {type: String, required: true},
        columns: {}
    },
    data() {
        return {}
    }
}
</script>

<style scoped>
@import url('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
@import url('https://fonts.googleapis.com/icon?family=Material+Icons');
</style>
