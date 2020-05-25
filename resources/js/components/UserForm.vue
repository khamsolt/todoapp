<template>
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Name</label>
                    <input name="name"
                           type="text"
                           v-model="name"
                           class="form-control"
                           id="validationDefault01"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault02">Email</label>
                    <input name="email"
                           type="email"
                           v-model="email"
                           class="form-control"
                           id="validationDefault02"
                           required>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button :disabled="isDisabled"
                    @click="onSubmitHandler"
                    class="btn btn-primary"
                    type="submit">
                Change
            </button>
        </div>
    </div>
</template>
<script>
    import mixin from "../mixin";

    export default {
        mixins: [mixin],
        props: {
            user: {
                type: Object,
                required: true
            },
            token: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                name: this.user.name,
                email: this.user.email,
            }
        },
        computed: {
            isDataChanged() {
                return (this.name !== this.user.name || this.email !== this.user.email);
            },
            nameValidate() {
                return this.name.length > 0;
            },
            emailValidate() {
                return this.email.length > 0 && this.emailValidation(this.email);
            },
            isDisabled() {
                return !(this.isDataChanged && this.nameValidate && this.emailValidate);
            }
        },
        methods: {
            onSubmitHandler(event) {
                this.httpRequest('/home/user', {
                    email: this.email,
                    name: this.name,
                    _token: this.token
                }, 'post');
            },
        }
    }
</script>
