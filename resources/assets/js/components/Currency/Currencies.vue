<template>
    <div class="currency-table">

        <notifications group="notify" />

        <div class="panel-heading">
            Currencies
            <span class="pull-right">
                <a href="#" @click.prevent="add">Add Currency</a>
            </span>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Short name</th>
                    <th>Country</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody v-if="currencies.length">
                <currency-row :key="currency.id" :currency="currency" v-for="currency in currencies"></currency-row>
            </tbody>

            <tbody v-else>
                <tr>
                    <td colspan="6">No currencies created yet.</td>
                </tr>
            </tbody>
        </table>

        <currency-modal :show="show" :currency="currency" @show="show" @close="closeModal"></currency-modal>
    </div>
</template>

<script>
    import CurrencyRow from './CurrencyRow'
    import CurrencyModal from './CurrencyModal'

    export default {

        data() {
            return {
                show: false,
                currencies: [],
                currency: {}
            }
        },

        components: {
            CurrencyRow, CurrencyModal
        },

        methods: {
            getCurrencies() {
                console.log('get currencies')
                axios.get('/admin/currencies')
                    .then( response =>  {
                        if (response.data.status === 'success') {
                            this.currencies = response.data.currencies
                        }
                    })
                    .catch(error => console.log(error))
            },

            closeModal(status, message) {
                this.show = false;
                this.currency = {}

                if (message.length > 0) {
                    this.$notify({
                        group: 'notify',
                        title: status,
                        type: 'success',
                        text: message
                    });
                }

                this.getCurrencies()
            },

            add() {
                Events.$emit('currency-modal', this.currency)
            }
        },

        created() {
           this.getCurrencies()
        },

        mounted() {
            Events.$on('currency-modal', currency => {
                this.currency = currency
                this.show = true
            })

            Events.$on('currency-deleted', () => {
                console.log('event caught')
                this.getCurrencies()
            })
        }
    }
</script>
