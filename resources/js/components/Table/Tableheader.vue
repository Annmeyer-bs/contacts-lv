<template>

    <thead>
    <tr>
        <th scope="col"><input type="checkbox" v-model="selectAllUp" @change="select"></th>
        <th scope="col"></th>
        <th scope="col" v-for="column in columns" @click="updateSortColumn(column)" class="sort">
            {{ column.charAt(0).toUpperCase() + column.slice(1) }}
        <span v-if="column === this.sortFieldUp">
            <i v-if="sortOrderUp === 'asc'" class="fas fa-sort-down act"></i>
            <i v-else-if="sortOrderUp === 'desc'" class="fas fa-sort-up act"></i>
        </span>
            <i v-else class="fas fa-sort"></i>
        </th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>

</template>

<script>

export default {
    props: {
        users: {},
        selectAll: '',
        columns: {},
        sortField: '',
        sortOrder: '',
        fetchData: {},
        page: ''
    },

    data() {
        return {
        }
    },
    computed: {
        selectAllUp: {
            get() {
                return this.selectAll;
            },
            set(data) {
                this.$emit('selectAllUpdated', data)
            }
        },
        sortFieldUp: {
            get() {
                return this.sortField;
            },
            set(data) {
                this.$emit('sortFieldUpdated', data)
            }
        },
        sortOrderUp: {
            get() {
                return this.sortOrder;
            },
            set(data) {
                this.$emit('sortOrderUpdated', data)
            }
        },
    },
    methods: {
        updateSortColumn(column) {
            if (column === this.sortFieldUp) {
                this.sortOrderUp = (this.sortOrderUp === "asc") ? "desc" : "asc"
            } else {
                this.sortFieldUp = column
                this.sortOrderUp = 'asc'
            }
            this.page = 1
            this.$emit('pageUpdated', this.page)
            this.fetchData()
        },
        select() {
            if (!this.selectAllUp) {
                this.users.forEach(function (user) {
                    user.selected = true
                })
            } else {
                this.users.forEach(function (user) {
                    user.selected = false
                })
            }
        }
    }
}
</script>

<style>
.fas {
    font-size: 25px;
    color: #f1f1f1;
}

.sort {
    cursor: pointer;
}

.act {
    color: grey;
}

</style>
