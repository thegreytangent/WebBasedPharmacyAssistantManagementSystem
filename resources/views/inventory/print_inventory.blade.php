<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Report</title>
    <style>
        th, td {
            border: 1px solid black;
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
<h4 class="center">Inventory Report</h4>


<table style="text-align: center">
    <thead>
    <b>
        <tr>
            <th scope="col">Medicine</th>
            <th scope="col">Type</th>
            <th scope="col">UOM</th>
            <th scope="col">Quantity</th>
            <th scope="col">Balance</th>
          </tr>
    </b>
    </thead>
    <tbody>
    @foreach($inventories as $inventory)
        <tr>
            <td>{{$inventory->medicine_name}}</td>
            <td>{{$inventory->type}}</td>
            <td>{{$inventory->uom}}</td>
            <td>{{$inventory->in}}</td>
            <td>{{$inventory->balance}}</td>
        </tr>
    @endforeach
    <tr>
        <td style="border: 0px" colspan="3">&nbsp;</td>
    </tr>

    </tbody>
</table>


</body>

{{--<script>--}}
{{--    window.print();--}}
{{--    window.onafterprint = function (event) {--}}
{{--        window.location.href = "{{config('app.url')}}/inventory"--}}
{{--    };--}}
{{--</script>--}}

</html>