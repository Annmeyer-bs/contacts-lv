<template>

    <thead>
    <tr>
        <th scope="col"><input type="checkbox" v-model="selectPage"></th>
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
        selectAll: {},
        selectPage: {},
        selected: {},
        columns: {},
        sortField: '',
        sortOrder: '',
        fetchData: {},
        page: ''
    },

    data() {
        return {}
    },
    watch: {
        selectPage(value) {
            if (value) {
                this.selectedUp.splice(0, this.users.length);
                this.users.forEach(user => {
                    this.selectedUp.push(user.id);
                });
            } else {
                if (this.selectedUp.length === this.users.length) {
                    this.selectedUp.splice(0, this.users.length);
                }
            }
        }
    },
    computed: {
        selectedUp: {
            get() {
                return this.selected;
            },
            set(data) {
                this.$emit('selectedUpdated', data)
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
        updateSortColumn(column) {
            if (column === this.sortFieldUp) {
                this.sortOrderUp = (this.sortOrderUp === "asc") ? "desc" : "asc"
            } else {
                this.sortFieldUp = column
                this.sortOrderUp = 'asc'
            }
            this.pageUp = 1
            this.fetchData()
        },
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
