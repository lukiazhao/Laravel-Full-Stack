import Vue from "vue";
import SalaryForm from "./components/employers/SalaryForm.vue";

new Vue({
    el: "#salary",
    components: {   
        "salary-form": SalaryForm,
    },
});