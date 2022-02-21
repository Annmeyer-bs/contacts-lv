<template>
    <nav aria-label="Page navigation example" class=" d-flex flex-row justify-content-between">
        <ul class="pagination ">
            <li class="page-item" :class="{ 'disabled' : pagination.current_page === 1 }">
                <a class="page-link" href="#"
                   @click.prevent="changePage(1)">First</a>
            </li>
            <li class="page-item" :class="{ 'disabled' : pagination.current_page === 1 }">
                <a class="page-link" href="#"
                   @click.prevent="changePage(pagination.current_page - 1)">Previous</a>
            </li>
            <li class="page-item" v-for="pageNumber in pageNumbers" @click.prevent="changePage(pageNumber)"
                :class="{ 'active' : pageNumber === pagination.current_page }">
                <a class="page-link" href="#">{{ pageNumber }}</a>
            </li>
            <li class="page-item" :class="{ 'disabled' : pagination.current_page === pagination.last_page }">
                <a class="page-link" href="#"
                   @click.prevent="changePage(pagination.current_page + 1)">Next</a>
            </li>
            <li class="page-item" :class="{ 'disabled' : pagination.current_page === pagination.last_page }">
                <a class="page-link" href="#"
                   @click.prevent="changePage(pagination.last_page)">Last</a>
            </li>
        </ul>
        <div>
                   <span>
                Showing: {{ totalItems }} of {{ pagination.total }} entries.
            </span>
        </div>

    </nav>
</template>

<script>
export default {
    name: "Pagination.vue",
    props: {
        pagination: '',
        totalItems: '',
    },
    data() {
        return {
            offset: 4
        }
    },
    computed: {
        pageNumbers() {
            let pages = []
            const {from, to, current_page, last_page} = this.pagination
            if (!to) return []
            let fromPage = current_page - this.offset
            if (fromPage < 1) fromPage = 1
            let toPage = fromPage + (this.offset * 2)
            if (toPage >= last_page) {
                toPage = last_page
            }
            for (let page = fromPage; page <= toPage; page++) {
                pages.push(page)
            }
            return pages
        }
    },
    methods: {
        changePage(pageNumber) {
            this.$emit('pageChanged', pageNumber)
        }
    }
}
</script>

<style scoped>

</style>
