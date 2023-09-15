<template>
    <div>
        <h5 class="text-center mb-4">How much {{ currency.code }} would you like to purchase?</h5>
        <div class="row text-center justify-content-center mb-4">
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="input-group">
                    <input type="number" min="0" step="0.1" v-model="amount" @change="calculateAmount" class="form-control">
                    <div class="input-group-text">{{ currency.code }}</div>
                </div>
            </div>
        </div>
        <div class="row text-center justify-content-center mb-4">
            <div class="col-12">
                <button type="button" @click="calculateAmount" class="btn btn-outline-primary">Calculate</button>
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-4">
                <div class="row">
                    <div class="col-6 text-end fw-bold">Amount:</div>
                    <div class="col-6">{{ source_amount.toLocaleString('en-US', { maximumFractionDigits: 6 }) }} USD</div>
                </div>
                <div class="row" v-if="currency.surcharge > 0">
                    <div class="col-6 text-end fw-bold">Surcharge ({{ currency.surcharge }}%):</div>
                    <div class="col-6">{{ surcharge_amount.toLocaleString('en-US', { maximumFractionDigits: 6 }) }} USD</div>
                </div>
                <div class="row" v-if="currency.discount > 0">
                    <div class="col-6 text-end fw-bold">Discount ({{ currency.discount }}%):</div>
                    <div class="col-6">-{{ discount_amount.toLocaleString('en-US', { maximumFractionDigits: 6 }) }} USD</div>
                </div>
                <div class="row total">
                    <div class="col-6 text-end fw-bold">TOTAL:</div>
                    <div class="col-6 fw-bold">{{ total.toLocaleString('en-US', { maximumFractionDigits: 6 }) }} USD</div>
                </div>
            </div>
        </div>
        <div class="row text-center justify-content-center mb-4">
            <div class="col-12">
                <button type="submit" disabled class="btn btn-primary" v-if="purchasing">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Purchasing...
                </button>
                <button type="submit" @click="createOrder" class="btn btn-primary" v-else :disabled="amount==0">Purchase</button>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "currency"
        ],
        data() {
            return {
                purchasing: false,
                source_amount: 0,
                amount: 0,
                surcharge_amount: 0,
                discount_amount: 0,
                total: 0,
            }
        },
        watch: {
            currency: {
                immediate: true,
                handler (newVal, oldVal) {
                    this.calculateAmount();
                }
            },
        },
        methods: {
            calculateAmount() {
                this.source_amount = this.roundNumber(this.amount / this.currency.rate, 2);
                this.surcharge_amount = this.roundNumber(this.source_amount * (this.currency.surcharge / 100), 2);
                this.total = this.source_amount + this.surcharge_amount;
                if (this.currency.discount > 0) {
                    this.discount_amount = this.roundNumber(this.total * (this.currency.discount / 100), 2);
                    this.total = this.total - this.discount_amount;
                }
            },
            roundNumber(number, digits) {
                let pow = Math.pow(10, digits);
                return Math.round(number * pow) / pow;
            },
            createOrder() {
                this.calculateAmount();

                if (!confirm('Are you sure you want to purchase ' + this.roundNumber(this.amount, 2) + ' ' + this.currency.code + ' for ' + this.roundNumber(this.total, 2) + ' USD?')) {
                    return false;
                }

                this.purchasing = true;
                let order = {
                    'source_currency_code': 'USD',
                    'currency_code': this.currency.code,
                    'exchange_rate': this.currency.rate,
                    'surcharge_percent': this.currency.surcharge,
                    'surcharge_amount': this.surcharge_amount,
                    'discount_percent': this.currency.discount,
                    'discount_amount': this.discount_amount,
                    'source_currency_amount': this.source_amount,
                    'currency_amount': this.amount,
                    'source_total': this.total,
                };

                axios
                    .post('/api/order', order)
                    .then((response) => {
                        this.amount = 0;
                        this.calculateAmount();
                        this.purchasing = false;
                        alert('Your order #' + response.data.data.id + ' is successfully created.');
                    });
            }
        },
        name: "ExchangeAmount"
    }
</script>

<style scoped>

</style>
