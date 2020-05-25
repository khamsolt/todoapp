<template>
    <div class="custom-control custom-checkbox d-flex">
        <input type="checkbox"
               class="custom-control-input"
               :disabled="isDisabled"
               :checked="isChecked"
               :id="inputId"
               @change="onChangeHandler">
        <label :class="labelClasses" :for="inputId">
            {{ content }}
        </label>
        <slot/>
    </div>
</template>
<script>
    import {CLOSED, OPENED} from "../mixin";

    export default {
        props: {
            content: {
                type: String,
                required: true,
                default: ""
            },
            isChecked: {
                type: Boolean,
                default: false
            },
            isDisabled: {
                type: Boolean,
                default: false,
                required: true,
            },
            id: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                checked: this.isChecked,
                classes: "custom-control-label flex-grow-1"
            };
        },
        computed: {
            inputId() {
                return "note_" + this.id;
            },
            labelClasses() {
                if (this.checked) {
                    return this.classes + " text-line-through";
                }
                return this.classes;
            },
            onChange() {
                return {};
            }
        },
        methods: {
            onChangeHandler(event) {
                this.checked = event.target.checked;
                this.$emit("change", {
                    status: this.checked ? CLOSED : OPENED,
                    url: `/home/note/${this.id}`
                });
            }
        }
    }
</script>
<style lang="scss" scoped>
    .text-line-through {
        text-decoration: line-through;
    }
</style>
