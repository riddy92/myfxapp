<template>
    <modal :show="show" @close="close">
        <div class="modal-header">
            <h3>{{ modalTitle }} Rate</h3>
        </div>
        <form @submit.prevent="validate">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Date
                        <el-date-picker>
                            v-model="date"
                            type="date"
                            format="dd/MM/yyyy"
                            placeholder="Pick date"
                            :change="selectDate()">
                        </el-date-picker>
                    </label>
                </div>
                
                <div class="form-group" :class="{'has-error': errors.has('currency') }">
                    <label class="form-label">Currency
                        <select name="currency" v-model="rateObj.currency_id" class="form-control" v-validate="'required'">
                            <option value="">Select Currency</option>
                            <option :value="currency.id" :key="currency.id" v-for="currency in currencies">
                                {{ currency.short_name }}
                            </option>
                        </select>
                        <span v-show="errors.has('currency')" class="text-danger">{{ errors.first('currency') }}</span>
                    </label>
                </div>

                <div class="form-group" :class="{'has-error': errors.has('buy_rate') }">
                    <label class="form-label">Buy
                        <input class="form-control" v-model="rateObj.buy_rate" name="buy_rate" v-validate="'required'">
                        <span v-show="errors.has('buy_rate')" class="text-danger">{{ errors.first('buy_rate') }}</span>
                    </label>
                </div>

                <div class="form-group" :class="{'has-error': errors.has('buy_rate') }">
                    <label class="form-label">Sell
                        <input class="form-control" v-model="rateObj.sell_rate" name="sell_rate" v-validate="'required'">
                        <span v-show="errors.has('sell_rate')" class="text-danger">{{ errors.first('sell_rate') }}</span>
                    </label>
                </div>
            </div>

            <div class="modal-footer text-right">
                <button class="modal-default-button btn btn-success">Save</button>
                <button class="modal-default-button btn btn-default" @click.prevent="cancel">
                    Cancel
                </button>
            </div>
        </form>
    </modal>
</template>

<script>
    import Datepicker from 'vuejs-datepicker'
    import moment from 'moment'

    export default {

        props: ['show', 'rate'],

        components: {
            Datepicker
        },

        data() {
            return {
                message: '',
                status: '',
                currencies: '',
                date: moment()
            }
        },

        computed: {
            rateObj() {
                return this.rate
            },

            currencyId() {
                return this.rate.currency_id !== undefined ? this.rate.currency_id : ''
            },

            modalTitle() {
                if (this.rateObj !== undefined) {
                    return 'Edit'
                } else {
                    return 'Add'
                }
            }
        },

        mounted() {
            this.getCurrencies()
        },

        created() {
            Events.$on('currency-created', () => this.getCurrencies())
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

            getCurrencies() {
                axios.get('/admin/fx/currencies')
                    .then( response =>   this.currencies = response.data.currencies)
                    .catch(error => console.log(error))
            },

            selectDate() {
                this.rateObj.date = moment(this.date)
            },

            validate() {
                this.$validator.validateAll();

                if (!this.errors.any()) {
                    if (this.rate.id !== undefined) {
                        this.saveRate()
                    } else {
                    
                        this.createRate()
                    }
                }
            },

            clearErrors() {
                this.errors.clear()
            },

            saveRate() {
                axios.patch('/admin/rates/' + this.rate.id, this.rateObj)
                    .then( response =>  {
                        if (response.data.status === 'success') {
                            this.status = response.data.status
                            this.message = response.data.message
                            this.close()
                        }
                    })
                    .catch(error => console.log(error))
            },

            createRate() {
                this.rateObj.date = moment(this.date).format('YYYY-MM-DD HH:mm:ss')

                axios.post('/admin/rates', this.rateObj)
                    .then( response =>  {
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