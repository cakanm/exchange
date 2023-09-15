<template>
    <div>
        <h5 class="text-center mb-4">Select currency that you would like to purchase</h5>
        <div class="row mb-4">
            <div class="col-12 offset-sm-2 col-sm-4 offset-lg-4 col-lg-2 mb-4 mb-sm-0 text-end">
                <select v-model="currency_code" class="form-select">
                    <option value="">--- Select Currency ---</option>
                    <option v-for="currency in currencies" v-bind:value="currency.code">{{ currency.name + ' (' + currency.code + ')' }}</option>
                </select>
            </div>
            <div class="col-6">
                <div v-if="currency">
                    <p><b>Exchange rate:</b> {{ currency.rate }}</p>
                    <p v-if="currency.surcharge != 0"><b>Surcharge:</b> {{ currency.surcharge }}%</p>
                    <p v-if="currency.discount != 0"><b>Discount:</b> {{ currency.discount }}%</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { isProxy, toRaw } from 'vue';
    export default {
        data() {
            return {
                currency_code: '',
                currency: undefined,
                currencies: [],
            }
        },
        created() {
            let self = this;
            axios
                .get('/api/currencies')
                .then((response) => {
                    self.currencies = response.data.data;
                });
        },
        watch: {
            currency_code: function (newVal, oldVal) {
                if (newVal !== oldVal) {
                    this.currency = this.getCurrencyDetails(newVal);
                    this.$emit('selected-currency', this.currency);
                }
            }
        },
        methods: {
            getCurrencyDetails(code) {
                let raw_data = this.currencies;
                if (isProxy(this.currencies)) {
                    raw_data = toRaw(this.currencies)
                }

                return raw_data.find(item => item.code == code);
            }
        },
        name: "CurrencyDropdown",
    }
</script>
