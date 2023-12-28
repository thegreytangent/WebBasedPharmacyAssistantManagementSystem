
@extends('template.main')


@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h6 class="mb-0 text-uppercase">Supplier Orders Information</h6>
                <hr/>
                <a href="/order/create" class="btn btn-success btn-sm ms-auto mb-3">
                    <i class="bx bx-add-to-queue"> </i>Add Orders</a>
                <div class="card">
                    <div class="card-body">

                        @include('template.alert')

                        <table class="table mb-0 table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">Supplier Name</th>
                                <th scope="col">Medicine</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Expiration Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->supplier_name}}</td>
                                <td>{{$order->medicine_name}}</td>
                                <td>{{$order->qty}}</td>
                                <td>{{$order->expiration_date}}</td>
                                <td> <span class="badge {{$order->label}}">{{$order->label_message}}</span> </td>
                                <td>
                                    <a href="/medicine?supplier_id={{$order->supplier_id}}" class="btn btn-info btn-sm">
                                            <i class="bx bxs-book-open"></i> View Records
                                        </a>
                                </td>

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
                        url: `medicine/${id}`,
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
