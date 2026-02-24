<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .invoice-info, .billing-info {
            width: 45%;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .totals {
            text-align: right;
            margin-top: 20px;
        }
        .totals table {
            width: 300px;
            margin-left: auto;
        }
        .totals td {
            padding: 8px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $business->name }}</h1>
            <p>{{ ucfirst($business->type) }} Business</p>
        </div>
        
        <div class="company-info">
            <strong>Invoice</strong>
        </div>
        
        <div class="invoice-details">
            <div class="invoice-info">
                <h4>Invoice Details</h4>
                <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
                <p><strong>Date:</strong> {{ $invoice->created_at->format('d M Y') }}</p>
                <p><strong>Payment Status:</strong> {{ ucfirst($invoice->payment_status) }}</p>
            </div>
            
            <div class="billing-info">
                <h4>Bill To</h4>
                <p><strong>{{ $invoice->client_name }}</strong></p>
            </div>
        </div>
        
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $business->type }} Services</td>
                    <td>1</td>
                    <td>₹{{ number_format($invoice->subtotal, 2) }}</td>
                    <td>₹{{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
            </tbody>
        </table>
        
        <div class="totals">
            <table>
                <tr>
                    <td><strong>Subtotal:</strong></td>
                    <td>₹{{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>GST ({{ $invoice->gst_percentage }}%):</strong></td>
                    <td>₹{{ number_format($invoice->gst_amount, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Total Amount:</strong></td>
                    <td><strong>₹{{ number_format($invoice->total_amount, 2) }}</strong></td>
                </tr>
            </table>
        </div>
        
        <div class="footer">
            <p>Thank you for your business!</p>
            <p>This is a computer-generated invoice and does not require a signature.</p>
        </div>
    </div>
</body>
</html>
