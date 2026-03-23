<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background: #333; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .status-badge { display: inline-block; padding: 5px 15px; background: #e5e7eb; color: #374151; border-radius: 999px; font-weight: bold; text-transform: uppercase; font-size: 14px; }
        .footer { font-size: 12px; color: #888; text-align: center; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background: #d32f2f; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ORDER STATUS UPDATE</h1>
        </div>
        <div class="content">
            <h2>Hello, {{ $order->first_name }}!</h2>
            <p>Your order <strong>#{{ $order->order_number }}</strong> has been updated.</p>
            
            <p><strong>New Status:</strong> <span class="status-badge">{{ $order->status }}</span></p>
            
            @if($order->status == 'Shipped')
                <p>Great news! Your premium components are on their way to you. You should receive them shortly.</p>
            @elseif($order->status == 'Delivered')
                <p>Your order has been delivered! We hope you enjoy your new high-performance parts.</p>
            @elseif($order->status == 'Cancelled')
                <p>Your order has been cancelled. If you have any questions, please contact our concierge support.</p>
            @endif

            <p>You can track your order status anytime by clicking the button below:</p>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('orders.show', $order->id) }}" class="btn">Track Order</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} AutoParts Hub (VIP Division). All rights reserved.</p>
        </div>
    </div>
</body>
</html>
