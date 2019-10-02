<template>
    <div>
        <div class="form-group">
            <strong class="col-form-label" for="inputDefault">Position</strong>
            <input type="text" class="form-control" id="inputDefault" v-model="position" required>
        </div>
        <div class="form-group">
            <strong class="col-form-label" for="inputDefault">Company</strong>
            <input type="text" class="form-control" id="inputDefault" v-model="company">
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
                <strong class="col-form-label" for="inputDefault">Start Date:</strong>
                <vuejs-datepicker v-model="startDate" format='yyyy-MM-dd'></vuejs-datepicker>
            </div>
            <div class="col-sm-4">
                <strong class="col-form-label" for="inputDefault">End Date:</strong>
                <div v-if="!toCurrent">
                    <vuejs-datepicker v-model="endDate" format='yyyy-MM-dd'></vuejs-datepicker>
                </div>
                <div v-else>
                    <input type="text" placeholder=" to Current" disabled>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="custom-control custom-checkbox mt-2">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" v-model="inPosition" @click="isInPosition">
                    <label class="custom-control-label" for="customCheck1">In Position</label>
                </div>
            </div>
        </div>
        
           
        <div class="form-group">
            <strong class="control-label required">Job Duties</strong>
            <textarea name="duties" rows="10" class="form-control" v-model="job_duties"></textarea>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary" @click="save">Save</button>
            <button type="button" class="btn btn-secondary" @click="cancel">Cancel</button>
        </div>
      
        <!-- <button type="button" class="btn btn-info btn-block mt-2" style="width:100%" @click="showWorkForm">Add Work Experience</button> -->

    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        components: {   
            vuejsDatepicker,
        },
        props: {
            
        },
        data: function() {
            return {
                position: null,
                company: null,
                startDate: null,
                endDate: null,
                inPosition: false,
                job_duties: null,

                toCurrent: false,
                work_experience_id: null,
            };
        },
        methods: {
            cancel() {
                this.$parent.showForm = false;
                this.eraseData();
            },
            save() {
                if(this.position) {
                    axios.post('/me/profile/work-experience', {
                        position: this.position,
                        company: this.company,
                        startDate: moment(this.startDate).format('YYYY-MM-DD'),
                        endDate: this.endDate ? moment(this.endDate).format('YYYY-MM-DD') : null,
                        job_duties: this.job_duties,
                        work_experience_id: this.work_experience_id,
                    }).then((response) => {
                        this.$emit('work-experience-updated', response.data);
                        this.eraseData();
                        this.$parent.showForm = false;
                    }).catch((error) => {
                        let message = 'Cannot add work experience. Error: ';
                        alert(message + error.message) 
                    })
                }
            },
            isInPosition() {
                this.toCurrent = !this.inPosition;
                this.endDate = null;
            },
            loadData(work) {
                this.work_experience_id = work.id;
                this.position = work.position;
                this.company = work.company;
                this.startDate = work.startDate;
                this.inPosition = work.endDate ? false : true;
                this.endDate = this.inPosition ? null : work.endDate;
                this.toCurrent = this.inPosition;
                this.job_duties = work.job_duties;
            },
            eraseData() {
                this.work_experience_id = null;
                this.position = null;
                this.company = null;
                this.startDate = null;
                this.inPosition = false;
                this.job_duties = null;
                this.toCurrent = false;
                this.endDate = null;
            }
        },
    };
</script>