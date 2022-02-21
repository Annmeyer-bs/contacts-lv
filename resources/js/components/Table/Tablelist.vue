<template>
    <tbody class="">
    <tr v-if="usersUp.length === 0">Users not found</tr>
    <tr v-else class="" v-for="(user, index) in usersUp" :key="index">
        <th scope="row">
            <input type="checkbox" :value="user.id" v-model="selectedUp">
        </th>
        <td class="td-img"><img src="storage/img/img-not-found.png"></td>
        <td v-for="column in columns">{{ user[column] }}</td>
        <td>
            <dropdown>
                <template v-slot:trigger>
                    <button type="button" class="btn" id="dropdownMenuOffset">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                </template>

                <li @click="editUser(user)"><a
                    class="dropdown-item px-2 text-xs block hover:bg-gray-900"
                    href="#"><i
                    class="bi bi-list"></i> View</a>
                </li>
                <li @click="removeUser(user)">
                    <a class="dropdown-item px-2 text-xs block border-top border-dark border-2 hover:bg-gray-900"
                       href="#">
                        <i class="bi bi-x-lg red"></i> Delete</a>
                </li>
            </dropdown>
        </td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    </tbody>
</template>
<script>
import Dropdown from './Dropdown'


export default {
    props: ['users', 'user', 'modalView', 'columns', 'fetchData', 'selected'],
    components: {Dropdown},

    data() {
        return {
            isActive: false
        }
    },

    computed: {
        selectedUp: {
            get() {
                return this.selected;
            },
            set(data) {
                this.$emit('selectedUpdate', data)
            }
        },
        usersUp: {
            get() {
                return this.users;
            },
            set(data) {
                this.$emit('usersUpdated', data)
            }
        },

    },
    methods: {
        async removeUser(user) {
            if (!window.confirm(`Are you sure? ${user.name}`)) {
                return;
            }
            try {
                await axios.delete(`api/users/${user.id}`)
                this.fetchData()
            } catch (error) {
                console.error(error)
            }
        },
        editUser(user) {
            this.modalView.show = !this.modalView.show
            this.$emit('userUpdated', user)
        },
    },
}
</script>

<style>
.down-right {
    text-align: start;
    width: 150px;
    text-decoration: none;
    list-style-type: none;
    background-color: white;
    position: absolute;
    left: 60%;
    top: -26px;
    border: solid 2px black;
}

td {
    max-width: 250px;
    max-height: 10px;
}

tr {
    max-height: 10px;
}

.td-img {
    width: 3%;
}

td img {
    max-width: 80%;
}

#menu div {
    padding: 1em;
    cursor: pointer;
    position: fixed;
    left: -180px;
    top: 0;
    bottom: 0;
    width: 200px;
    background-color: white;
}

menu div .active {
    left: 0px;
    transition: all 0.3s;
}

.red {
    color: red;
}
</style>
