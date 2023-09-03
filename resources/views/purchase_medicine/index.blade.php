@extends('template.main')


@section('content')
    <div class="page-content">
        <div class="row mb-3">
            <div class="col-lg-3">
                <a href="/purchase" class="btn btn-primary"><i class="bx bxs-left-arrow"></i>Back</a>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
            <h6 class="mb-3 text-uppercase">Date: <b>{{ $purchase->date }}</b></h6>
            <h6 class="mb-3 text-uppercase">Customer Name: <b>{{ $purchase->customer_name }}</b> </h6>
            </div>
            <div class="col-md-6">
                <h6 class="mb-3 text-uppercase">Receipt Number: <b>{{ $purchase->receipt_number }}</b></h6>
                <h6 class="mb-3 text-uppercase">Amount: <b>{{ $purchase->total_amount }}</b> </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
<hr/>

                <div class="card">
                    <div class="card-body">

                        @include('template.alert')

                        <table class="table mb-0 table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Medicine Name</th>
                                <th scope="col">Price</th>
{{--                                <th scope="col"> Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchase_medicines as $pm)
                                <tr>
                                    <td>{{$pm->category_name}}</td>
                                    <td>{{$pm->medicine_name}}</td>
                                    <td>{{$pm->price}}</td>
{{--                                    <td>--}}
{{--                                        <div class="d-flex order-actions">--}}
{{--                                            <a href="/supplier/{{$pm->id}}" class="btn btn-info"><i--}}
{{--                                                    class="bx bxs-edit"></i></a>--}}
{{--                                            <a href="#" id="{{$pm->id}}" class="btn btn-danger ms-3 button_delete"><i--}}
{{--                                                    class="bx bxs-trash"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
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
                        url: `supplier/${id}`,
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
