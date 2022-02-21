<template>
    <button class="button-add text-white d-flex flex-row align-items-center" @click="create">
        <i class="bi bi-plus-circle-fill"></i>
        <p class="btn-text">Add Contact</p>
    </button>
</template>
<script>
export default {
    props: {
        modalCreate: {},
    },

    data() {
        return {
            user: {},
        }
    },

    methods: {
        create() {
            this.modalCreate.show = !this.modalCreate.show
            this.user = {}
            this.$emit('userUpdated', this.user)
        }
    }
}
</script>

<style>
.button-add {
    background-color: #2b78e4;
}
</style>
