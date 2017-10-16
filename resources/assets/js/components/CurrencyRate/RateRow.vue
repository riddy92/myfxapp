<template>
    <tr>
        <td v-text="rate.currency.short_name"></td>
        <td v-text="rate.buy_rate"></td>
        <td v-text="rate.sell_rate"></td>
        <td><a href="#" @click.prevent="deleteCurrency">delete</a></td>
        <td><a href="#" @click.prevent="editCurrency">edit</a></td>
    </tr>
</template>

<script>
    import axios from 'axios'
    import confirmDelete from '../../core/confirm_delete'


    export default {
        props: ['rate'],

        methods: {
            deleteCurrency() {
                confirmDelete('Rate ' + this.rate.id)
            },

            editCurrency() {
                Events.$emit('rate-modal', this.rate)
            }
        }
    }
</script>
