<template>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Cool Project Name - {{ localeDate }}</a>
      <div class="dropdown">
        <button @click="toggle" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i><p>Your name</p>
        </button>
        <ul v-if="active" v-bind:class="{active}" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#">Registration</a></li>
          <li><a class="dropdown-item" href="#">Authorization</a></li>
        </ul>
      </div>
    </div>
    <hr align="center" width="99%" size="3" color="#dddddd" />
  </nav>
</template>

<script>
import localeDateMixin from "./localeDateMixin";

export default {
  mixins: [localeDateMixin],
  data() {
    return {date: new Date(),
    active: false,
    interval: null};
  },
  methods: {
    toggle() {
      this.active = !this.active;
    }
  },

  mounted() {
    this.interval = setInterval(() => {
      this.date = new Date()
    },1000)
  },
  beforeDestroy() {
    clearInterval(this.interval)
  }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.navbar-light{
  display: block;
  background: #ff9900;
}
.navbar-brand, .nav-item, p{
  color: white;
  margin: 0 0 0 10px;
}

.dropdown-toggle{
  display: flex;
  align-items: center;
  background: #7f4c00;
}
a {
  color: white;
}
.dropdown-toggle::after {
  margin-left: 10px;
}
hr {
  margin: .75rem .15rem .10rem .20rem;
  background-color: white;
  opacity: 1;
  align-items: center;
}
.active{
  display: block;
  background: #7f4c00;
  padding: 0 10px;
  min-width: 0;
}

</style>
