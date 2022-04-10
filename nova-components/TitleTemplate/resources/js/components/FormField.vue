<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">
            <div v-for="locale in locales" :style="[locale == 'ar' ? {'border-bottom': '2px solid #7c858e', direction: 'rtl'} : {}]">
                <input v-if="template == null"
                       type="text" class="my-2 w-full form-control form-input form-input-bordered" :class="errorClasses"
                       :placeholder="field.name" v-model="withoutTemplateValue[locale]" />
                <div v-else v-for="(item, index) in template" class="my-2 inline-block">
                    <div v-if="item.word[locale].split('')[0] == '+'">
                        <input type="text" class="form-control form-input form-input-bordered inline-block w-auto mx-1 mb-1" :class="errorClasses"
                               :placeholder="item.word[locale].substr(1)"
                                v-model="tempName[locale][index]" />
                    </div>
                    <div v-else-if="item.word[locale].split('')[0] == '-'">
                        <select v-model="tempName[locale][index]" class="form-control form-input form-input-bordered inline-block w-auto mx-1 mb-1" :class="errorClasses">
                            <option value="null" disabled>{{item.word[locale].substr(1).split('-')[0]}}</option>
                            <option v-for="optionItem in item.word[locale].substr(1).split('-').slice(1)" :value="optionItem">{{optionItem}}</option>
                        </select>
                    </div>
                    <div v-else-if="item.word[locale].split('')[0] != null">
                        <input
                            type="text"
                            class="form-control form-input form-input-bordered inline-block w-auto mx-1 mb-1"
                            readonly
                            v-model="tempName[locale][index] = item.word[locale]" />
                    </div>
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
            withoutTemplateValue: null,
            template: null,
            tempName: null,
            locales: ['ar', 'en']
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
                    this.withoutTemplateValue = response.data.name;
                    if(response.data.template != null && response.data.template != '') {
                        this.template = JSON.parse(response.data.template);
                        this.tempName = {
                            'ar': new Array(this.template.length).fill(null),
                            'en': new Array(this.template.length).fill(null)
                        }
                        if(response.data.temp_name) {
                            this.tempName = {
                                'ar': response.data.temp_name.ar.split('-'),
                                'en': response.data.temp_name.en.split('-')
                            }
                        }
                    }
                })
        },

        /**
        * Fill the given FormData object with the field's internal value.
        */
        fill(formData) {
            if(this.tempName)
                formData.append(this.field.attribute, JSON.stringify(this.tempName) || '')
            else
                formData.append(this.field.attribute, JSON.stringify(this.withoutTemplateValue) || '')
        },
    }
}
</script>
