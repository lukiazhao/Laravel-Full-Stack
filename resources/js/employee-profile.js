import Vue from "vue";
import PhoneInput from "./components/employees/PhoneInput.vue";
import SummaryInput from "./components/employees/SummaryInput.vue";
import WorkExpInput from "./components/employees/WorkExpInput.vue";
import ResumeInput from "./components/employees/ResumeInput.vue";

new Vue({
    el: "#profile",
    data: {
        profile: window.profile,
        resume_path: window.resume_path,
    },
    components: {
        "phone-input": PhoneInput,
        "summary-input": SummaryInput,
        "work-input": WorkExpInput,
        "resume-input": ResumeInput,
    },
    methods: {
        updatePhoneNumber(data) {
            this.profile.phone_number = data.phone_number;
        },
        updateSummary(data) {
            this.profile.summary = data.summary;
        },
        updateResume(data) {
            this.resume_path = data.resume_path;
        }
    }
});
