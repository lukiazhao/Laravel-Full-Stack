<template>
    <div class="ml-4">
        <div v-show="!edit">
            <p v-if="phone_number" class="card-text">{{ phone_number }}</p>
            <p v-else class="card-text">Not set</p>
            <button
            id="edit-phone-btn"
            type="button"
            class="btn btn-outline-primary"
            @click="editPhoneNumber"
            >Edit</button>
        </div>
        
        
        <div v-show="edit" class="form-group">
            <input type="text" class="form-control mb-4" v-model="new_phoneNumber">
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
                phone_number: window.profile.phone_number,      
                edit: false,    
                new_phoneNumber: null,            
            };
        },
        methods: {
            editPhoneNumber() {
                this.edit = true;
                this.new_phoneNumber = this.phone_number;
            },
            cancel() {
                this.edit = false;
            },
            save() {
                if (this.new_phoneNumber) {
                    axios.post('/me/profile/phone-number', {
                        text: this.new_phoneNumber
                    }).then((response) => {
                        this.$emit('phone-number-updated', response.data);  // to update window.profile.phone_number
                        this.phone_number = response.data.phone_number;     // update data in vue
                        this.edit = false;
                    }).catch((error) => {
                        let message = 'Cannot edit phone number. Error: ';
                        alert(message + error.message) 
                    })
                } else {

                }
            }
        },
    };
</script>