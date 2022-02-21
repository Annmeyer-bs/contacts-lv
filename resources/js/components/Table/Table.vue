<template>
    <div class="container">
        <div class="d-flex flex-row justify-content-between ">
            <p class="m-3">Contacts</p>
            <div class="button d-flex">
                <buttonadd class="m-2"
                           :modalCreate="modalCreate"
                           @userUpdated="userUpdated">
                </buttonadd>
                <buttondelete class="m-2"
                              @click="removeUsers">
                </buttondelete>
            </div>
        </div>
        <div>
            <p v-if="selected.length > 0"> With Checked {{ this.selected.length }}</p>
        </div>
        <perpage
            :page="page"
            :perPage="perPage"
            @pageUpdated="pageUpdated"
            @perPageUpdated="perPageUpdated">
        </perpage>
        <div>
            <p class="msg">{{ this.msg }}</p>
        </div>
        <table class="table " id="sortable  table-hover">
            <tableheader
                :columns="columns"
                :page="page"
                :selected="selected"
                :sortOrder="sortOrder"
                :sortField="sortField"
                :users='users'
                @pageUpdated="pageUpdated"
                @sortOrderUpdated="sortOrderUpdated"
                @sortFieldUpdated="sortFieldUpdated"
                @selectedUpdate="selectedUpdate">
            </tableheader>
            <tablelist
                :columns="columns"
                :fetch-data="fetchData"
                :modalView="modalView"
                :selected="selected"
                :user="user"
                :users='users'
                @selectedUpdate="selectedUpdate"
                @userUpdated="userUpdated"
                @usersUpdated="usersUpdated">
            </tablelist>
        </table>
        <pagination v-if="users.length > 0"
                    :pagination="pagination"
                    :totalItems="users.length"
                    @pageChanged="pageChanged">
        </pagination>
        <modal modalTitle="Create" v-if="modalCreate.show"
               :user="user"
               @userUpdated="userUpdated"
               @close="modalCreate.show = false">
        </modal>
        <modal modalTitle="View" v-if="modalView.show"
               :user="user"
               :fetch-data="fetchData"
               @userUpdated="userUpdated"
               @close="modalView.show = false">
        </modal>
    </div>
</template>

<script>
import Buttonadd from "./Buttonadd";
import Buttondelete from "./Buttondelete";
import Tableheader from "./Tableheader";
import Tablelist from "./Tablelist";
import Modal from "./Modal";
import Perpage from "./Perpage";
import Pagination from "./Pagination";


export default {
    components: {Pagination, Perpage, Modal, Buttonadd, Buttondelete, Tableheader, Tablelist},
    props: {
        url: {
            type: String,
            required: true
        },
        columns: {}
    },
    data() {
        return {
            isActive: true,
            modalCreate: {
                show: false
            },
            modalView: {
                show: false
            },
            users: [],
            msg: '',
            selected: [],
            user: {},
            sortField: this.columns[0],
            sortOrder: 'asc',
            perPage: 5,
            page: 1,
            pagination: {
                to: 1,
                from: 1
            }
        }
    },

    created() {
        this.fetchData();
    },

    methods: {
        async fetchData() {
            try {
                let params = {
                    sort_field: this.sortField,
                    sort_order: this.sortOrder,
                    per_page: this.perPage,
                    page: this.page
                }
                let {data} = await axios.get(this.url, {params})
                this.users = data.data
                this.pagination = data.meta
            } catch (error) {
                console.error(error)
                alert('Is error')
            }

        },
        async removeUsers() {
            if (this.selected.length !== 0) {
                try {
                    await axios.delete(`api/users/batch/` + this.selected)
                    this.selected = []
                    this.fetchData()
                } catch (error) {
                    console.error(error);
                }
            } else {
                this.msg = 'Check User for removing';
            }
        },
        usersUpdated(users) {
            this.users = users;
        },
        userUpdated(user) {
            this.user = user;
        },
        selectedUpdate(selected) {
            this.selected = selected;
        },
        sortFieldUpdated(sortField) {
            this.sortField = sortField;
        },
        sortOrderUpdated(sortOrder) {
            this.sortOrder = sortOrder;
            this.fetchData()
        },
        perPageUpdated(perPage) {
            this.perPage = perPage
            this.fetchData()
        },
        pageChanged(pageNumber) {
            this.page = pageNumber
            this.fetchData()
        },
        pageUpdated(page) {
            this.page = page
        },
    }
}
</script>

<style>

.container {
    border: solid 2px black;
    padding: 10px;
    margin: 40px auto;
    min-height: 400px;
}

.btn-text {
    margin-bottom: 0;
}

p {
    margin: 0 10px;
}

.table {
    width: 100%;
    border-collapse: unset;
}

.table > :not(caption) > * > * {
    padding: 0;
    vertical-align: middle;
    text-align: center;
}

</style>
