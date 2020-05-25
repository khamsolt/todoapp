<template>
    <div class="card border-secondary">
        <div class="card-body">
            <note-item
                v-if="notes.length > 0"
                v-for="note in notes"
                :key="note.id" :content="note.content"
                :id="note.id"
                :is-disabled="isDisabled"
                :is-checked="note.status === 'closed'"
                @change="onCheckedHandler">
                <note-dropdown>
                    <note-delete-action
                        message="Delete"
                        :is-disabled="isDisabled"
                        :id="note.id"
                        :token="token"
                        @delete="onDeleteHandler"/>
                    <note-edit-action
                        @click="onEditHandler"
                        message="Edit"
                        :is-disabled="isDisabled"
                        :content="note.content"
                        :id="note.id"
                        :token="token"/>
                </note-dropdown>
            </note-item>
        </div>
        <div class="card-footer">
            <note-text-field
                v-model="value"
                :is-updated="isUpdated"
                :token="token"
                :is-disabled="isDisabled"
                @close="onCloseHandler"
                @submit="onSubmitHandler"/>
        </div>
    </div>
</template>
<script>
    import NoteItem from "./NoteItem";
    import NoteDropdown from "./NoteDropdown";
    import NoteTextField from "./NoteTextField";
    import NoteDeleteAction from "./NoteDeleteAction";
    import NoteEditAction from "./NoteEditAction";
    import mixin from "../mixin";

    export default {
        mixins: [mixin],
        components: {
            "note-item": NoteItem,
            "note-dropdown": NoteDropdown,
            "note-text-field": NoteTextField,
            "note-delete-action": NoteDeleteAction,
            "note-edit-action": NoteEditAction
        },
        props: {
            notes: {
                type: Array,
                required: true,
                default: []
            },
            token: String,
        },
        data() {
            return {
                list: [].concat(this.notes),
                isUpdated: false,
                isDisabled: false,
                changedData: {},
                value: ""
            }
        },
        computed: {
            getNotes() {
                return this.list;
            }
        },
        methods: {
            onCheckedHandler(data) {
                this.isDisabled = true;
                this.httpRequest(data.url, {'status': data.status});
            },
            onEditHandler(data) {
                this.value = data.params.content;
                this.changedData = data;
                this.isUpdated = true;
            },
            onCloseHandler(event) {
                this.isUpdated = false;
                this.value = "";
            },
            onSubmitHandler(event) {
                this.isDisabled = true;
                const data = {
                    "_token": this.token,
                    "content": this.value
                };
                if (this.isUpdated) {
                    this.httpRequest(this.changedData.url, data, "post");
                    return true;
                }
                this.httpRequest("/home/note", data, "post");
            },
            onDeleteHandler(data) {
                this.httpRequest(data.url, {
                    _token: this.token,
                    _method: 'delete',
                }, 'post');
            }
        }
    }
</script>
