@extends('template.main')


@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h6 class="mb-0 text-uppercase">Suppliers Information</h6>
                <hr/>
                <a href="/supplier/create" class="btn btn-success btn-sm ms-auto mb-3">Add New Supplier</a>
                <div class="card">
                    <div class="card-body">

                        <table class="table mb-0 table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Supplier Name</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">
{{--                                    <div class="d-flex order-actions">--}}
                                        Action
{{--                                    </div>--}}
                                    </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="javascript:;" class="btn btn-info"><i class="bx bxs-edit"></i></a>
                                        <a href="javascript:;" class="btn btn-danger ms-3"><i class="bx bxs-trash"></i></a>
                                    </div> </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
