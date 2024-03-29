@extends('template.main')


@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h6 class="mb-0 text-uppercase">Inventory Informations</h6>
                <hr/>

                <div class="card">
                    <div class="card-body">

                        <a href="{{config('app.url')}}/inventory-print" class="btn btn-warning" style="float: right">
                           <i class="d-print-block"></i> Print
                        </a>

                        @include('template.alert')

                        <table class="table mb-0 table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">Medicine</th>
                                <th scope="col">Type</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Balance</th>
                                <th scope="col"></th>


                            </tr>
                            </thead>
                            <tbody>

                            @foreach($inventories as $inventory)
                                <tr>
                                    <td>{{$inventory->medicine_name}}</td>
                                    <td>{{$inventory->type}}</td>
                                    <td>{{$inventory->uom}}</td>
                                    <td>{{$inventory->in}}</td>
                                    <td>{{$inventory->balance}}</td>
                                    <td><a href="{{config('app.url')}}/order?medicine_id={{$inventory->id}}" class="btn btn-sm btn-info">Show
                                            Expiration</a></td>

                                </tr>
                            @endforeach
                            </tbody>


                        </table>
                        <div class="row mt-3">
                            {!! $pagination !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function () {

            $(".button_delete").click(function () {
                if (confirm("Are you sure you want to delete this?")) {
                    let id = $(this).attr("id");
                    $.ajax({
                        url: `{{config('app.url')}}/medicine/${id}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (result) {
                            location.reload();
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    </script>
@endpush
