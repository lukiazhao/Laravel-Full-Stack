<template>
    <div class="ml-4">
        <div v-show="!showForm" v-for="(work, index) in works" :key="work.id">
            <p class="card-text"><strong>{{ work.position }}</strong> @ {{ work.company }}</p>
            <small class="text-muted"><span v-if="work.startDate">{{ work.startDate }}</span><span v-else>Unknown</span> - <span v-if="work.endDate">{{ work.endDate }}</span><span v-else>Current</span></small>
            <p>{{ work.job_duties }}</p>
            <button type="button" class="btn btn-outline-primary" @click="onEdit(work)">Edit</button>
            <button type="button" class="btn btn-outline-danger" @click="onRemove(work, index)">Remove</button>
            <hr>
        </div>
     
        <div v-show="showForm">
            <ExperienceForm ref="edit_work_experience" @work-experience-updated="updateWorkExperience"></ExperienceForm>
        </div>
        <button type="button" class="btn btn-info btn-block mt-2" style="width:100%" @click="showWorkForm">Add Work Experience</button>

    </div>
</template>

<script>
    import ExperienceForm from './ExperienceForm.vue';

    export default {
        components: {   
            ExperienceForm,
        },
        data: function() {
            return {
                works: window.profile.work_experiences,
                showForm: false, 
            };
        },
        methods: {
            showWorkForm() {
                this.showForm = true;
            },
            onEdit(work) {
                this.showForm = true;
                this.$refs.edit_work_experience.loadData(work);
            },
            updateWorkExperience(data) {
                if(!this.works) {
                    this.works = [];
                }
                if(data.isNew) {
                    this.works.push(data);
                } else {
                    this.works.forEach(element => {
                        if (element.id === data.id) {
                            var index = this.works.indexOf(element);
                            if (index != -1) {
                                this.works.splice(index, 1, data);
                            }
                        }
                    });
                }
            },
            onRemove(work, index) {
                axios.delete('/me/profile/work-experience/' + work.id)
                .then((response) => {
                    if(response.status == 200) {
                        this.works.splice(index, 1)
                    }
                }).catch((error) => {
                    let message = 'Cannot remove work experience. Error: ';
                    alert(message + error.message)
                })
            }
        },

    };
</script>