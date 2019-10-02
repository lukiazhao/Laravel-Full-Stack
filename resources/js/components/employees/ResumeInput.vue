<template>
    <div class="ml-4">
        <div>
            <div class="row" v-if="resume_path">
                <div class="col-md-12">
                    <div v-if="resume_path.slice(-3) === 'pdf'">
                        <embed :src="resume_path" type="application/pdf" :alt="resume_path" width="800px" height="800px" class="mb-2">
                    </div>
                    <div v-else>
                        <img :src="resume_path" :alt="resume_path" class="mb-2 img-fluid">
                    </div>
                </div>
            </div>
            
            <button
            id="edit-resume-btn"
            type="button"
            class="btn btn-outline-primary"
            @click="onUpload"
            ><span v-if="resume_path">Edit</span><span v-else>Upload</span></button>
        </div>
    
        <div v-show="edit" class="form-group">
            <div class="input-group mb-0">
                <div class="custom-file">
                    <input type="file" ref="file" name="resume" class="custom-file-input" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" @change="fileSelected">
                    <label class="custom-file-label" for="resumeImage">{{ fileName }}</label>
                </div>
            </div>
            <small id="imageHelp" class="form-text text-muted">Please choose a jpeg/png/gif image file and the max size allowed is 5MB.</small>
            <button type="button" class="btn btn-secondary" @click="cancel">Cancel</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
 
    export default {
        data: function() {
            return {
                edit: false,   
                fileName: 'Choose file', 
                file: '',
                resume_path: window.resume_path,
            };
        },
        methods: {
            onUpload() {
                this.edit = true;
            },
            cancel() {
                this.edit = false;
            },
            fileSelected: function(event) {
                if (event.target.files.length > 0) {
                    this.fileName = event.target.files[0].name;
                    this.file = this.$refs.file.files[0];
                } else {
                    this.fileName = 'Choose file'
                }

                // upload to storage/db
                let formData = new FormData();
                formData.append('resume', this.file);

                axios.post( '/me/profile/resume', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response) => {
                        this.$emit('resume-updated', response.data);
                        this.resume_path = response.data.resume_path;
                        this.edit = false;
                    }).catch((error) => {
                        let message = 'Cannot edit resume. Error: ';
                        alert(message + error.message) 
                    });
            }
        },
    };
</script>