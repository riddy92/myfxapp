<template>
   <modal :show="show" @close="close">
       <div class="modal-header">
           <h3>{{ modalTitle }} Currency</h3>
       </div>
       <form @submit.prevent="validate">
           <div class="modal-body">
               <div class="form-group" :class="{'has-error': errors.has('name') }" >
               <label class="form-label">
                   Name
                   <input class="form-control" v-model="currencyObj.name" v-validate="'required'" name="name">
                   <span v-show="errors.has('name')" class="text-danger">{{ errors.first('name') }}</span>
               </label>
               </div>

                <div class="form-group" :class="{'has-error': errors.has('short_name') }" >
               <label class="form-label">
                   Short Name
                   <input class="form-control" v-model="currencyObj.short_name" v-validate="'required'" name="short_name">
                   <span v-show="errors.has('short_name')" class="text-danger">{{ errors.first('short_name') }}</span>
               </label>
                </div>

              <div class="form-group" :class="{'has-error': errors.has('country') }" >
               <label class="form-label">
                   Country
                   <input class="form-control" v-model="currencyObj.country" v-validate="'required'" name="country">
                   <span v-show="errors.has('country')" class="text-danger">{{ errors.first('country') }}</span>
               </label>
                 </div>
           </div>

           <div class="modal-footer text-right">
               <button class="modal-default-button btn btn-success" type="submit">
                   Save
               </button>
               <button class="modal-default-button btn btn-default" @click.prevent="cancel">
                   Cancel
               </button>
           </div>
       </form>
   </modal>
</template>

<script>
    export default {

        props: ['show', 'currency'],

        data() {
            return {
                message: '',
                status: '',
                url: ''
            }
        },

        computed: {
            currencyObj() {
                return this.currency
            },

            modalTitle() {
                if (this.currency.name !== undefined) {
                    return 'Edit'
                    
                } else {
                    return 'Add'
                }
            }
        },

        methods: {
            close: function () {
                this.clearErrors()
                this.$emit('close', this.status, this.message);
            },

            cancel() {
                this.message = ''
                this.status = ''
                this.close()    
            },

            validate() {
                this.$validator.validateAll();

                if (!this.errors.any()) {
                    if (this.currency.id !== undefined) {
                        this.saveCurrency()
                    } else {
                        this.createCurrency()
                    }
                }
            },

            clearErrors() {
                this.errors.clear()
            },

            saveCurrency() {
                axios.patch('/admin/currencies/' + this.currency.id, this.currencyObj)
                    .then( response =>  {
                    
                        if (response.data.status === 'success') {
                            this.status = response.data.status
                            this.message = response.data.message
                            this.close()
                        }
                    })
                    .catch(error => console.log(error))
            },

            createCurrency() {
                axios.post('/admin/currencies', this.currencyObj)
                    .then( response =>  {
                        // Emit global event that currency is created
                        Events.$emit('currency-created')
                        if (response.data.status === 'success') {

                            this.status = response.data.status
                            this.message = response.data.message
                            this.close()
                        }
                    })
                    .catch(error => console.log(error))
            }
        }
    }
</script>