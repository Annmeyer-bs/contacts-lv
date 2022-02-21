<template>
    <button class="button-delete text-white d-flex flex-row align-items-center" @click="$emit('click')">
        <i class="bi bi-plus-circle-fill"></i>
        <p class="btn-text">Delete Contact</p>
    </button>
</template>
<script>
export default {
    data() {
        return {}
    },
}
</script>

<style>
.button-delete {
    background-color: red;
}
</style>
