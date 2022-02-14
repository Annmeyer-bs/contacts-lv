<template>


    <div class="container">
        <div class="d-flex flex-row justify-content-between ">
            <p class="m-3">Contacts</p>
            <div class="button d-flex">
                <buttonadd class="m-2 " :modalCreate="modalCreate" @userUpdated="userUpdated"></buttonadd>
                <buttondelete class="m-2 " @click="deleteUsers"></buttondelete>
            </div>
        </div>
        <div><p class="msg">{{ this.msg }}</p></div>
        <table class="table " id="sortable">
            <tableheader :users='users' :selectAll="selectAll" :columns="columns" sortOrder="sortOrder" sortField="sortField"

                         @selectUserUp="selectUserUp" @selectAllUpdated="selectAllUpdated"
                         @listUpdated="listUpdated"></tableheader>
            <tablelist :users='users' :user="user"
                       @userUpdated="userUpdated" @selectUserUp="selectUserUp"
                       :modalView="modalView"></tablelist>
        </table>
        <modal modalTitle="Create" @listUpdated="listUpdated" v-if="modalCreate.show" @close="modalCreate.show = false"
               :users="users" :user="user" @userUpdated="userUpdated"
        ></modal>
        <modal modalTitle="View" @listUpdated="listUpdated" @userUpdated="userUpdated" v-if="modalView.show"
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
import {computed} from "vue";


export default {
    components: {Modal, Buttonadd, Buttondelete, Tableheader, Tablelist},
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
            users: [ ],
            msg: '',
            selectAll: false,
            index: '',
            user: {},
            sortField: '',
            sortOrder: 'asc'
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
                }
                const { data } = await axios.get(this.url, { params })
                this.users = data.data
            } catch (e) {
                console.log(e)
                alert('Is error')
            }

        },
        show() {
            this.isActive = true;
        },
        hide() {
            this.isActive = false;
        },
        listUpdated(users) {
            this.users = users;
        },
        userUpdated(user, index) {
            this.user = user;
            this.index = index;
        },
        selectUserUp(selected) {
            this.user.select = selected;
        },
        selectAllUpdated(selectAll) {
            this.selectAll = selectAll;
        },
        //todo почитать области видимости
        //найти топ самых используемых методов в js и знать их, в том числе работа с массивами и обьектами
        deleteUsers() {
            this.users = this.users.filter(user => {
                if (user.selected === false) {
                    return user;
                }
            });
        }

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
