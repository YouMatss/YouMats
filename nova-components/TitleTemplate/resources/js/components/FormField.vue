<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field" v-for="(item, index) in template">
            <input
                :id="field.name"
                type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                :value="item"
            />
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
            template: {}
        }
    },
    mounted() {
        this.getTemplate()
    },
    methods: {
        /*
        * Set the initial, internal value for the field.
        */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        getTemplate() {
            axios.get(this.field.endpoint)
                .then(response => {
                    if(response.data.template != null) {
                        this.template = response.data.template;
                    }
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
