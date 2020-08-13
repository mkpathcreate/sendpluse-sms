<template>
    <div>
        <ValidationObserver ref="sendSmsFormObserver">
            <form :action="action" method="post" ref="sendSmsForm" @submit.prevent="submitSendSmsForm">

                <slot name="form"></slot>

                <div class="form-group row">
                    <div class="col-sm-4"><label>* Sender</label></div>
                    <div class="col-sm-8">
                        <ValidationProvider rules="required|max:11" v-slot="{errors}" name="Sender">
                            <input type="text" name="sender" class="form-control" v-model="sender"
                                maxlength="11">
                            <div class="invalid-feedback d-block" v-if="errors[0]">{{errors[0]}}</div>
                        </ValidationProvider>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-4"><label>* Sms Text</label></div>
                    <div class="col-sm-8">
                        <ValidationProvider rules="required|max:160" v-slot="{errors}" name="Sms text">
                            <textarea class="form-control" rows="8" name="sms_text" v-model="sms_text"
                                maxlength="160"></textarea>
                            <div class="text-right">left {{160 - sms_text.length}} character</div>
                            <div class="invalid-feedback d-block" v-if="errors[0]">{{errors[0]}}</div>
                        </ValidationProvider>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4"><label>* Mailing List</label></div>
                    <div class="col-sm-8">
                        <ValidationProvider rules="required|integer" v-slot="{errors}" name="Mailing LIst">
                            <select class="form-control" name="mailing_list_id" v-model="mailing_list_id"
                                :disabled="!mailing_list.length"
                            >
                                <option value=""></option>
                                <option v-for="item in mailing_list" :key="'mailing-list-id-' + item.id" 
                                    :value="item.id">{{item.name}}</option>
                            </select>
                            <div class="invalid-feedback d-block" v-if="errors[0]">{{errors[0]}}</div>
                        </ValidationProvider>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4"><label>Schedule Sending Time</label></div>
                    <div class="col-sm-8">
                        <div>
                            <p-check color="primary" name="send_now" v-model="send_now" value="1">Send now</p-check>
                        </div>
                        <div v-if="!send_now">
                            <VueCtkDateTimePicker v-model="date" />
                            <ValidationProvider rules="required|isDate|dateGreaterThanNow" v-slot="{errors}" name="Date">
                                <input type="hidden" name="date" v-model="date">
                                <div class="invalid-feedback d-block" v-if="errors[0]">{{errors[0]}}</div>
                            </ValidationProvider>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-primary" :disabled="sendSmsButtonDisabled">
                        Submit {{sendSmsButtonDisabled ? '...' : ''}}</button>
                </div>
            </form>
        </ValidationObserver>
    </div>
</template>

<script>
import PrettyCheck from 'pretty-checkbox-vue/check';
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate';
import { Validator } from 'vee-validate';
import { setInteractionMode } from 'vee-validate';
import en from 'vee-validate/dist/locale/en';
import * as rules from 'vee-validate/dist/rules';
setInteractionMode('eager');
for (let rule in rules) {
    extend(rule, {
        ...rules[rule], // add the rule
        message:  en.messages[rule] // add its message
    });
}
// date
extend('isDate', {
    validate: value => {
        if(value)
            return (new Date(value) !== "Invalid Date") && !isNaN(new Date(value));
        return false;
    },
    message: 'The {_field_} must be date'
});
// dateGreaterThanNow
extend('dateGreaterThanNow', {
    validate: value => {
        var now = new Date();
        var date = new Date(value);
        return date.getTime() > now.getTime();
    },
    message: 'date must be future date'
})

export default {
    components: {
        ValidationProvider, 
        ValidationObserver,
        'p-check': PrettyCheck,
        VueCtkDateTimePicker,
    },
    props: [
        'action'
    ],
    data(){
        return {
            mailing_list: [],

            sender: 'ADFX',
            sms_text: '',
            mailing_list_id: '',
            send_now: false,
            date: '',

            sendSmsButtonDisabled: false,
        };
    },
    mounted(){
        this.fetchMailingList();
    },
    methods: {
        fetchMailingList(){
            axios.get('/api/mailing-list').then(resp => this.mailing_list = resp.data);
        },
        async submitSendSmsForm(){
            this.sendSmsButtonDisabled = false;

            // validate values
            var isValid = await this.$refs.sendSmsFormObserver.validate(true);

            // submit form
            if(isValid){
                this.sendSmsButtonDisabled = true;
                this.$refs.sendSmsForm.submit();
            }
        },
    }
}
</script>

