<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background: #d32f2f; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .order-table { w-full; border-collapse: collapse; margin: 20px 0; }
        .order-table th, .order-table td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
        .footer { font-size: 12px; color: #888; text-align: center; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background: #d32f2f; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>VIP ORDER CONFIRMED</h1>
        </div>
        <div class="content">
            <h2>Hello, {{ $order->customer_name }}!</h2>
            <p>Thank you for choosing <strong>AutoParts Hub</strong>. Your order has been successfully placed and is now being processed by our concierge team.</p>
            
            <p><strong>Order Number:</strong> #{{ $order->order_number }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            
            <table class="order-table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p>We will notify you once your premium components have shipped.</p>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ url('/') }}" class="btn">Return to Store</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} AutoParts Hub (VIP Division). All rights reserved.</p>
            <p>123 Platinum Street, Automotive City</p>
        </div>
    </div>
</body>
</html>
