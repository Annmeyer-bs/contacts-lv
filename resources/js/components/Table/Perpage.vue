<template>
    <div class=" d-flex flex-row  justify-content-end align-items-center mr-auto p-2">
        <p class="btn-text">Per&#160page</p>
        <select class="form-control per-page" v-model="perPageUp" id="pageOption"
                @change="handlePerPage">
            <option v-for="page in pageOptions"
                    :key="page"
                    :value="page">{{ page }}</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "Perpage.vue",
    props: {
        perPage: '',
        page: ''
    },
    data() {
        return {
            pageOptions: [5, 10, 20, 50],
        }
    },
    computed: {
        perPageUp: {
            get() {
                return this.perPage;
            },
            set(data) {
                this.$emit('perPageUpdated', data)
            }
        },
        pageUp: {
            get() {
                return this.page;
            },
            set(data) {
                this.$emit('pageUpdated', data)
            }
        },
    },
    methods: {
        handlePerPage($event) {
            this.pageUp = 1
            this.perPageUp = $event.target.value
        }
    }
}
</script>

<style scoped>
.per-page {
    max-width: 60px;
    text-align: center;
}
</style>
