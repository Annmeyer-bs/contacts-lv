<template>


    <div class="container">
        <div class="d-flex flex-row justify-content-between ">
            <p class="m-3">Contacts</p>
            <div class="button d-flex">
                <buttonadd class="m-2 " :modalCreate="modalCreate" :user="user" @userUpdated="userUpdated"></buttonadd>
                <buttondelete class="m-2 " @click="removeUsers"></buttondelete>
            </div>
        </div>
        <div><p v-if="selected.length > 0"> With Checked {{ this.selected.length }}</p></div>
        <perpage :fetch-data="fetchData" @perPageUpdated="perPageUpdated"
                 :perPage="perPage" :page="page" @pageUpdated="pageUpdated"></perpage>
        <div><p class="msg">{{ this.msg }}</p></div>
        <table class="table " id="sortable  table-hover">
            <tableheader :users='users' :selectAll="selectAll" :selectPage="selectPage" :selected="selected"
                         :columns="columns" :sortOrder="sortOrder"
                         :sortField="sortField" @sortOrderUpdated="sortOrderUpdated"
                         :page="page" @pageUpdated="pageUpdated"
                         @sortFieldUpdated="sortFieldUpdated" :fetch-data="fetchData"
                         @selectedUpdate="selectedUpdate"></tableheader>
            <tablelist :users='users' :user="user" :columns="columns" :fetch-data="fetchData" :selected="selected"
                       @usersUpdated="usersUpdated" @userUpdated="userUpdated"
                       @selectedUpdate="selectedUpdate"
                       :modalView="modalView"></tablelist>
        </table>
        <pagination v-if="users.length > 0" :pagination="pagination" @pageChanged="pageChanged"
                    :totalItems="users.length">
        </pagination>
        <modal modalTitle="Create" @userUpdated="userUpdated" v-if="modalCreate.show" @close="modalCreate.show = false"
               :users="users" :user="user" :fetch-data="fetchData">

        </modal>
        <modal modalTitle="View" @userUpdated="userUpdated"  v-if="modalView.show" :fetch-data="fetchData"
               @close="modalView.show = false"
               :users="users" :user="user"
               :index="index"
               :modalView="modalView.show">
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
        url: {type: String, required: true},
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
            selectAll: false,
            selectPage: false,
            selected: [],
            index: '',
            user: {},
            sortField: this.columns[0],
            sortOrder: 'asc',
            perPage: 5,
            page: 1,
            pagination: { to: 1, from: 1}
        }
    },

    created() {
        this.fetchData();
    },

    methods: {
        async fetchData() {
            try {
                const params = {
                    sort_field: this.sortField,
                    sort_order: this.sortOrder,
                    per_page: this.perPage,
                    page: this.page
                }
                const {data} = await axios.get(this.url, {params})
                console.log(data)
                console.log(data.data)
                this.users = data.data
                this.pagination = data.meta
            } catch (e) {
                console.log(e)
                alert('Is error')
            }

        },
        async removeUsers() {
            if (this.selected.length !== 0) {
                try {
                    await axios.delete(`api/users/any/` + this.selected)
                    this.selected = []
                    this.fetchData()
                } catch (error) {

                }
            } else {
                this.msg = 'Check User for removing';
            }
        },
        selectAllUsers() {
            axios.get(`api/users/all`)
            .then(response => {
                this.selected = response.data;
                this.selectAll = true;
                this.selectPage = true;
            })

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
        },
        fetchDataUpdated(fetchData) {
            this.fetchData = fetchData;
        },
        perPageUpdated(perPage) {
          this.perPage = perPage
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
