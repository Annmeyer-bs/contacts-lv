<template>

  <thead>
  <tr>
    <th scope="col"><input type="checkbox" v-model="selectAllUp" @change="select"></th>
    <th scope="col"></th>
    <th scope="col" v-for="column in columns">{{ column.charAt(0).toUpperCase() + column.slice(1) }}
      <span v-if="column === sortField">
      <i v-if="sortOrder === 'asc'" class="fas fa-sort-down act"></i>
      <i v-else-if="sortOrder === 'desc'" class="fas fa-sort-up act"></i>
                </span>
      <i v-else class="fas fa-sort"></i>

<!--      <div class="icon-group d-flex sort-icon">-->
<!--        <i class="fas fa-sort" @click="sort(column)" :class="sortedClass(column)"></i>-->
<!--      </div>-->
    </th>
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
  },

  data() {
    return {
      currentSort: '',
      currentSortDir: 'asc',
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
  },
  methods: {
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
    },
    sort(e) {
      if (e === this.currentSort) {
        this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc'
      }
      this.currentSort = e

      this.usersSort(this.users);
    },
    usersSort(users) {
      users.sort((a, b) => {
        let mod = 1
        if (this.currentSortDir === 'desc') mod = -1
        if (a[this.currentSort] < b[this.currentSort]) return -1 * mod
        if (a[this.currentSort] > b[this.currentSort]) return 1 * mod
        return 0
      });
      this.$emit('listUpdated', users)
    },
    sortedClass(key) {
      return this.currentSort === key ? `${this.currentSortDir === 'asc' ? 'fa-sort-down act' : 'fa-sort-up act'}` : '';
    }
  }
}
</script>

<style>
.fas {
  font-size: 25px;
}

.icon-group {
  display: flex;
  flex-direction: column;
  color: #f1f1f1;
  cursor: pointer;
}

.th-item {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  align-items: center;
  border: none;
}

.sort-icon {
  text-decoration: none;
  list-style-type: none;
}

.act {
  color: grey;
}

</style>
