<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">
            <input v-if="template == null"
                   type="text"
                   class="w-full form-control form-input form-input-bordered"
                   :class="errorClasses"
                   :placeholder="field.name"
                   :value="value"
            />
            <div v-else v-for="(item, index) in template" class="inline-block">
                <div v-if="item.word.en.split('')[0] == '+'">
                    <input
                        type="text"
                        class="form-control form-input form-input-bordered inline-block w-auto mx-1"
                        :class="errorClasses"
                        :placeholder="item.word.en.substr(1)"
                        :value="tempName[index]"
                    />
                </div>
                <div v-else-if="item.word.en.split('')[0] == '-'">
                    <select v-model="tempName[index]" class="form-control form-input form-input-bordered inline-block w-auto mx-1" :class="errorClasses">
                        <option value="" selected disabled>{{item.word.en.substr(1).split('-')[0]}}</option>
                        <option v-for="optionItem in item.word.en.substr(1).split('-').slice(1)" :value="optionItem">{{optionItem}}</option>
                    </select>
                </div>
                <div v-else>
                    <input type="hidden" :value="item.word.en">
                    <label class="mx-1">{{item.word.en}}</label>
                </div>
            </div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            fields: [],
            template: null,
            tempName: null
        }
    },
    mounted() {
        this.loadData()
    },
    methods: {
        /*
        * Set the initial, internal value for the field.
        */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        loadData() {
            axios.get(this.field.endpoint)
                .then(response => {
                    if(response.data.template != null && response.data.template != '')
                        this.template = JSON.parse(response.data.template);
                    if(response.data.temp_name)
                        this.tempName = response.data.temp_name.en.split('-');
                });
        },

        /**
        * Fill the given FormData object with the field's internal value.
        */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },
    },
    computed: {}
}
</script>
