import "./bootstrap";
import Vue from "vue";
import NoteItemList from "./components/NoteItemList";
import UserForm from "./components/UserForm";

const app = new Vue({
    components: {
        "note-item-list": NoteItemList,
        "user-form": UserForm
    },
    el: "#app",
});
