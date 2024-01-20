
        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Report</title>
    <style>
        th, td {
            border:  1px solid black;
        }
        table {
            width: 100%;
        }
        .center {
            padding: 1px 0;
            /* border: 3px solid black; */
            text-align: center;
        }
    </style>
</head>

<body>
<h3 class="center">Digital Pharmacy Assistant Management System</h3>
<h4 class="center">Purchases Information</h4>
<table style="text-align: center">
    <thead>
    <b>
        <tr>
            <th>Date</th>
            <th>Receipt Number</th>
            <th>Total Amount</th>
        </tr>
    </b>
    </thead>
    <tbody>
    @foreach($purchases as $purchase)
    <tr>
        <td>{{$purchase->date}}</td>
        <td>{{$purchase->receipt_number}}</td>
        <td>{{$purchase->amount}}</td>
    </tr>
        @endforeach
    <tr>
        <td style="border: 0px" colspan="3">&nbsp;</td>
    </tr>
    <tr style="font-weight: bolder">
        <td colspan="2" style="text-align: right"> Total:</td>
        <td>{{ $total}} </td>
    </tr>
    </tbody>
</table>


</body>

<script>
    window.print();
    window.onafterprint = function (event) {
        window.location.href = "{{config('app.url')}}/purchase"
    };
</script>

</html>