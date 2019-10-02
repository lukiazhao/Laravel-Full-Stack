<template>
    <div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input salary-range" id="customCheck1" name="use_range" v-model="useRange">
            <label class="custom-control-label" for="customCheck1">Use Range</label>
        </div>

        <!-- {{-- Use Range --}} -->
        <div class="form-group form-inline" id="salary-dropdown-use-range" v-if="useRange">
            <select class="custom-select" name="salary" id="range_salary" v-bind:class="{'is-invalid': errors_salary}" v-model="range_salary">
                <option value="">-- Please Select --</option>
                <option 
                    v-for="n in salaryRange" :key="n" :value="'$' + n + ' - $' + (n + range_step)"
                    >${{ n }} - ${{ n + range_step }}</option>
                <option value=">120,000">>120,000</option>
            </select>
            <label for="year">/Year</label>
        </div>
        
        <!-- {{-- Not Use Range --}} -->
        <div class="input-group form-inline" id="salary-dropdown-not-use-range" v-else>
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="number" step="1" placeholder="0.00" id="period_salary" class="form-control" name="salary" v-bind:class="{'is-invalid': errors_salary}" v-model="period_salary">
            <label for="/">&nbsp;/&nbsp;</label>
            <select class="custom-select" name="payment_period" id="payment_period" v-bind:class="{'is-invalid': errors_period}" v-model="payment_period">
                <option value="">-- Please Select --</option>
                <option value="hour">Hour</option>
                <option value="day">Day</option>
                <option value="month">Month</option>
                <option value="year">Year</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            errors_salary: String,
            errors_period: String,
            job: null,
        },
        data: function () {
            return {
                range_step: 20000,
                salary_max: 100000,
                useRange: false,
                period_salary: 0,
                range_salary: "",
                payment_period: "",
            }
        },
        computed: {
            salaryRange() {
                var range = [];
                for(let i = 0; i <= this.salary_max; i+=this.range_step){
                    range.push(i);
                }
                return range;
            },
              
        },
        mounted() {
            if (this.job) {
                let jobObject = JSON.parse(this.job);
                this.useRange = jobObject.use_range === 1;
                
                if (!this.useRange) {
                    this.period_salary = parseInt(jobObject.salary.split('/')[0]);
                    this.payment_period = jobObject.salary.split("/")[1];
                } else {
                    this.range_salary = jobObject.salary;
                }
            }
        },
    }
</script>
