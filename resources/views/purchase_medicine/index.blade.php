@extends('template.main')


@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h6 class="mb-0 text-uppercase">Suppliers Information</h6>
                <hr/>
                <a href="/supplier/create" class="btn btn-success btn-sm ms-auto mb-3">
                    <i class="bx bx-add-to-queue"> </i>Add New Supplier</a>
                <div class="card">
                    <div class="card-body">

                        @include('template.alert')

                        <table class="table mb-0 table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Medicine Name</th>
                                <th scope="col">Price</th>
                                <th scope="col"> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchase_medicines as $pm)
                                <tr>
                                    <td>{{$pm->category_name}}</td>
                                    <td>{{$pm->medicine_name}}</td>
                                    <td>{{$pm->price}}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="/supplier/{{$pm->id}}" class="btn btn-info"><i
                                                    class="bx bxs-edit"></i></a>
                                            <a href="#" id="{{$pm->id}}" class="btn btn-danger ms-3 button_delete"><i
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