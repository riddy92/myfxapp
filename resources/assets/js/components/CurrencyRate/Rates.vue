<template>
    <div class="currency-table">
        <notifications group="notify" />
        <div class="rates-panel-heading">
            Today's Rates
            <span class="pull-right">
                <a href="#" @click.prevent="add">Add Rate</a>
            </span>
        </div>
        <table class="dash-rates-table">
            <thead>
            <tr>
                <th>Currency</th>
                <th>Buy</th>
                <th>Sell</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody v-if="rates.length">
            <rate-row :key="rate.id" :rate="rate" v-for="rate in rates"></rate-row>
            </tbody>

            <tbody v-else>
            <tr>
                <td colspan="6">No rates added for today.</td>
            </tr>
            </tbody>
        </table>

        <rate-modal :show="show" :rate="rate" @show="show" @close="closeModal"></rate-modal>
    </div>
</template>

<script>
    import RateRow from './RateRow.vue'
    import RateModal from './RateModal.vue'

    export default {
        data() {
            return {
                show: false,
                rates: [],
                rate: {}
            }
        },

        components: {
            RateRow, RateModal
        },

        methods: {
            getRates() {
                axios.get('/admin/rates')
                    .then( response =>  {
                        if (response.data.status === 'success') {
                            this.rates = response.data.rates
                        }
                    })
                    .catch(error => console.log(error))
            },

            closeModal(status, message) {
                this.show = false;
                this.rate = {}

                if (message.length > 0) {
                    this.$notify({
                        group: 'notify',
                        title: status,
                        type: 'success',
                        text: message
                    });
                }

                this.getRates()
            },

            add() {
                Events.$emit('rate-modal', this.rate)
            }
        },

        created() {
            this.getRates()
        },

        mounted() {
            Events.$on('rate-modal', rate => {
                this.rate = rate
                this.show = true
            })
        }
    }
</script>
