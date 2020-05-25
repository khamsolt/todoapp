<template>
    <div class="input-group">
        <input type="text"
               :value="value"
               @input="$emit('input', $event.target.value)"
               class="form-control"
               placeholder="Write note"
               aria-label="Write note"
               aria-describedby="button-addon2">
        <div class="input-group-append">
            <button
                @click="$emit('close', $event)"
                v-if="isUpdated"
                class="btn btn-outline-success"
                type="button">
                <i class="fas fa-times"></i>
            </button>
            <button
                @click="$emit('submit', $event)"
                :class="buttonClasses"
                :disabled="value.length === 0"
                type="button"
                id="button-addon2">
                {{buttonName}}
            </button>
        </div>
    </div>
</template>
<script>
    import mixin from "../mixin";

    export default {
        mixins: [mixin],
        props: {
            value: String,
            isUpdated: Boolean,
            isDisabled: Boolean
        },
        computed: {
            buttonName() {
                return this.isUpdated ? "Update" : "Create";
            },
            buttonClasses() {
                return this.isUpdated ? "btn btn-outline-success" : "btn btn-outline-primary";
            },
        },
    };
</script>
