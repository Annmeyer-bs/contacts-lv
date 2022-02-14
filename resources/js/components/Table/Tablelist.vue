<template>
  <tbody class="">
  <tr v-if="users.length === 0">Users not found</tr>
     <tr class="" v-for="(user, index) in users" :key="index">
    <th scope="row">
      <input type="checkbox" :value="index" v-model="user.selected">
    </th>
    <td class="td-img"><img src=""></td>
    <td>{{ user.name }}</td>
    <td>{{ user.email }}</td>
    <td>{{ user.adress }}</td>
    <td>{{ user.created_at }}</td>
    <td>
      <dropdown>
        <template v-slot:trigger>
          <button type="button" class="btn" id="dropdownMenuOffset">
            <i class="bi bi-three-dots-vertical"></i>
          </button>
        </template>

        <li @click="editUser(user,index)"><a
            class="dropdown-item px-2 text-xs block hover:bg-gray-900"
            href="#"><i
            class="bi bi-list"></i> View</a>
        </li>
        <li @click="removeUser(index)"><a
            class="dropdown-item px-2 text-xs block border-top border-dark border-2 hover:bg-gray-900" href="#"><i
            class="bi bi-x-lg red">
        </i> Delete</a></li>

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
  props: ['users', 'user', 'modalView'],
  components: {Dropdown},

  data() {
    return {
      isActive: false
    }
  },

  computed: {
    selectUser: {
      get() {
        return this.user.select;
      },
      set(data) {
        this.$emit('selectUserUp', data)
      }
    }
  },
  methods: {
    removeUser(index) {
      this.users.splice(index, 1);
    },
    editUser(user, index) {
      this.modalView.show = !this.modalView.show
      this.$emit('userUpdated', user, index)
    }
  }
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
