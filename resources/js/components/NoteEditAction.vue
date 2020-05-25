<template>
    <button :disabled="isDisabled" @click="onClickHandler" class="dropdown-item" type="button">
        {{message}}
    </button>
</template>
<script>
    import mixin from "../mixin";

    export default {
        mixins: [mixin],
        props: {
            id: {
                type: Number,
                required: true
            },
            token: {
                type: String,
                required: true
            },
            message: {
                type: String,
                required: true
            },
            content: {
                type: String,
                required: true
            },
            isDisabled: Boolean
        },
        methods: {
            onClickHandler(event) {
                const data = {
                    url: `/home/note/${this.id}`,
                    params: {
                        _token: this.token,
                        id: this.id,
                        content: this.content
                    }
                };
                this.$emit("click", data);
            }
        }
    };
</script>
