<template>
    <tr>
        <td v-text="currency.name"></td>
        <td v-text="currency.short_name"></td>
        <td v-text="currency.country"></td>
        <td><a href="#" @click.prevent="deleteCurrency">delete</a></td>
        <td><a href="#" @click.prevent="editCurrency">edit</a></td>
    </tr>
</template>

<script>
    import axios from 'axios'
    import confirmDelete from '../../core/confirm_delete'


    export default {
        props: ['currency'],

        methods: {
            deleteCurrency() {
                confirmDelete('Currency ' + this.currency.name).then(() => {
                    axios.delete(`/admin/currencies/delete/${this.currency.id}`)
                        .then(() => {
                            Events.$emit('currency-deleted')
                            
                        }).catch((error) => console.log(error))
                    })
            },
            editCurrency() {
                Events.$emit('currency-modal', this.currency)
            }
        }
    }
</script>
