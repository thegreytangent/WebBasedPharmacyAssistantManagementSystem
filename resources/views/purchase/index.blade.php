@extends('template.main')


@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h6 class="mb-0 text-uppercase">Purchase Information</h6>
                <hr/>
                <a href="/purchase-pharmacy" class="btn btn-success btn-sm ms-auto mb-3">
                    <i class="bx bx-add-to-queue"> </i>Add New Purchase</a>
                <div class="card">
                    <div class="card-body">

                        @include('template.alert')

                        <table class="table mb-0 table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Receipt Number</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchases as $purchase)

                                <tr>
                                    <td>{{$purchase->date}}</td>
                                    <td>{{$purchase->receipt_number}}</td>
                                    <td> {{$purchase->customer_name }}</td>
                                    <td> {{$purchase->amount }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="/purchase-medicine?purchase_id={{$purchase->id}}"
                                               class="btn btn-success"><i
                                                    class="bx bxs-show"></i></a>
                                            <a href="#" id="{{$purchase->id}}"
                                               class="btn btn-danger ms-3 button_delete"><i
                                                    class="bx bxs-trash"></i></a>
                                        </div>
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
                        url: `purchase/${id}`,
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
