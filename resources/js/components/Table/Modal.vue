<template>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-mask">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ modalTitle }}</h5>
                        <button type="button" @click="$emit('close')" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="onSubmit">
                        <div class="modal-body">
                            <slot name="body">
                                <div class="modal-text">
                                    <div class="modal-text-name">
                                        <label>Name</label>
                                        <input type="text" v-model="userInEdit.name"
                                               placeholder="Please enter your name" maxlength="30">
                                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
                                    </div>
                                    <div class="modal-text-email">
                                        <label>Email</label>
                                        <input type="text" v-model="userInEdit.email"
                                               placeholder="Please enter your email" maxlength="30">
                                        <div class="invalid-feedback" v-if="errors.email">{{ errors.email[0] }}</div>
                                    </div>
                                    <div class="modal-text-adress">
                                        <label>Adress</label>
                                        <input type="text" v-model="userInEdit.adress"
                                               placeholder="Please enter your adress" maxlength="30">
                                        <div class="invalid-feedback" v-if="errors.adress">{{ errors.adress[0] }}</div>
                                    </div>
                                </div>
                                <div class="modal-img">
                                    <img src="storage/img/img-not-found.png">
                                </div>
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                <button @click="$emit('close')" type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">CLOSE
                                </button>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> SAVE
                                    CHANGES
                                </button>
                            </slot>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import localeDateMixin from "../localeDateMixin";

export default {
    mixins: [localeDateMixin],

    props: {
        fetchData: {},
        modalView: {},
        modalCreate: {},
        index: {},
        user: {},
        users: {},
        modalTitle: {
            type: String,
            required: true,
        },
    },

    data() {
        return {
            errors: {}
        }
    },

    computed: {
        userInEdit: {
            get() {
                return this.user;
            },
            set(data) {
                this.$emit('userUpdated', data)
            }
        }
    },

    methods: {
        onSubmit() {
            if (this.modalTitle === 'View') {
                this.editUser()
            } else {
                this.createUser()
            }
        },
        async createUser() {
            try {
                let response = await axios.post(`api/users`, {
                    name: this.userInEdit.name,
                    email: this.userInEdit.email,
                    adress: this.userInEdit.adress
                })
                this.fetchData()
                this.$emit('close')
            } catch (error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        alert('Some error')
                        break;
                }
            }
        },
        async editUser() {
            console.log()
            try {
                let response = await axios.put(`api/users/${this.userInEdit.id}`, {
                    id: this.userInEdit.id,
                    name: this.userInEdit.name,
                    email: this.userInEdit.email,
                    adress: this.userInEdit.adress
                })
                this.fetchData()
                this.$emit('close')
            } catch (error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        alert('Some error')
                        break;
                }
            }
        }
    },

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
p {
    margin: 0 10px;
}

.modal-content {
    margin: 10% 30%;
    position: relative;
    display: flex;
    flex-direction: column;
    max-width: 700px;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: 0.3rem;
    outline: 0;
}

.modal-mask {
    transition: opacity .3s ease;
    background-color: rgba(00, 00, 00, .43);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    width: 100vw;
    height: 100vh;
}

.modal-dialog {
    max-width: 1400px;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1055;
    width: 100%;
    height: 100%;
    outline: 0;
}

.modal-header, .modal-footer {
    border: none;
}

.modal-body {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-text {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.modal-img {
    width: 140px;
    height: 140px;
}

img {
    max-width: 100%;
}

td img {
    max-width: 80%;
}

input {
    margin: 20px;
}

.invalid-feedback {
    display: inline-block;
}
</style>
