<template>
    <div class="ml-4">
        <div v-show="!edit">
            <p v-if="summary" class="card-text">{{ summary }}</p>
            <p v-else class="card-text">Not set</p>
            <button
            type="button"
            class="btn btn-outline-primary"
            @click="editSummary"
            >Edit</button>
        </div>
        
        
        <div v-show="edit" class="form-group">
            <input type="text" class="form-control mb-4" v-model="new_summary">
            <button type="button" class="btn btn-primary" @click="save">Save</button>
            <button type="button" class="btn btn-secondary" @click="cancel">Cancel</button>

        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data: function() {
            return {
                summary: window.profile.summary,
                edit: false,    
                new_summary: null,            
            };
        },
        methods: {
            editSummary() {
                this.edit = true;
                this.new_summary = this.summary;
            },
            cancel() {
                this.edit = false;
            },
            save() {
                if (this.new_summary) {
                    axios.post('/me/profile/summary', {
                        text: this.new_summary
                    }).then((response) => {
                        this.$emit('sumary-updated', response.data);
                        this.summary = response.data.summary;
                        this.edit = false;
                    }).catch((error) => {
                        let message = 'Cannot edit summary. Error: ';
                        alert(message + error.message) 
                    })
                } else {

                }
            }
        },
    };
</script>