@extends('template.main')


@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h6 class="mb-0 text-uppercase">List of your purchases</h6>
                <hr/>

                <div class="card">
                    <div class="card-body">

                        @include('template.alert')

                        <table class="table mb-0 table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Receipt Number</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{$purchase->date}}</td>
                                    <td>{{$purchase->receipt_number}}</td>
                                    <td>{{$purchase->total_amount}}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="/customer/{{$purchase->id}}" class="btn btn-info"><i
                                                        class="bx bxs-edit"></i></a>
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
                                                        {!! $paginate !!}
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
                        url: `customer/${id}`,
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
