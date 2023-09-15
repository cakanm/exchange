<div>
    <h3>Order #{{ $order->id }}</h3>

    <div><i>{{ date('d.m.Y. H:i', strtotime($order->created_at)) }}</i></div>

    <div>Purchased <b>{{ $order->currency_amount }} {{ $order->currency_code }}</b></div>
    <div>Amount: {{ $order->source_currency_amount }} USD</div>

    @if ($order->surcharge_percent > 0)
    <div>Surcharge ({{ $order->surcharge_percent }}%): {{ $order->surcharge_amount }} USD</div>
    @endif

    @if ($order->discount_percent > 0)
    <div>Discount ({{ $order->discount_percent }}%): {{ $order->discount_amount }} USD</div>
    @endif

    <div><h5>TOTAL: {{ $order->source_total }} USD</h5></div>

</div>
