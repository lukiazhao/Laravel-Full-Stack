<template>
    <div>
        <label for="logo">Company Logo</label>
        <div class="row" v-if="logo_path">
            <div class="col-md-12">
                <img :src="logo_path" :alt="logo_path" class="mb-2 img-fluid">
            </div>
        </div>
        <div class="input-group mb-0">
            <div class="custom-file">
                <input type="file" name="company_logo" class="custom-file-input" accept="image/png, image/jpeg, image/gif" @change="fileSelected">
                <label class="custom-file-label" for="coverImage">{{ fileName }}</label>
            </div>
        </div>
        <small id="imageHelp" class="form-text text-muted">Submit to save the new logo.</small>
    </div>
</template>

<script>
    export default {
        props: {
       
        },
        data: function () {
            return {
                logo_path: window.employer.company_logo,
                fileName: 'Choose file',
                file: '',
            }
        },
        methods: {
            fileSelected: function(event) {
                if (event.target.files.length > 0) {
                    this.fileName = event.target.files[0].name;
                } else {
                    this.fileName = 'Choose file'
                }
            },
        }
    }
</script>
