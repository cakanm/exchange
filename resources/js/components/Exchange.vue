<template>
    <div>
        <currency-dropdown v-on:selected-currency="getCurrency"></currency-dropdown>
        <exchange-amount v-if="currency !== undefined" :currency="currency"></exchange-amount>
    </div>
</template>

<script>
    import CurrencyDropdown from "./CurrencyDropdown";
    import ExchangeAmount from "./ExchangeAmount";

    export default {
        components: {
            "currency-dropdown": CurrencyDropdown,
            "exchange-amount": ExchangeAmount,
        },
        data() {
            return {
                currency: undefined,
            }
        },
        methods: {
            getCurrency(currency) {
                this.currency = currency;
            }
        },
        name: "Exchange"
    }
</script>

<style scoped>

</style>
