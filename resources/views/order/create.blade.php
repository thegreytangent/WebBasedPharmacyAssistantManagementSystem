@extends('template.main')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <h6 class="mb-0 text-uppercase">&nbsp;</h6>
{{--    <div class="d-flex order-actions">--}}
        <a href="/order" class="btn btn-secondary"><i class="bx bxs-left-arrow-circle"></i>Back</a>
{{--    </div>--}}
    <hr/>

    <!--end breadcrumb-->
    <div class="row">
        <div class="col-3"></div>
        <div class="col-4">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Medicine</h5>
                    <hr/>
                    <div class="form-body mt-">
                        <div class="row">

                            <div class="col-lg-12">
                                @include('template.alert')
                                {!!  Form::open(['url' => 'order', 'method' => 'POST']) !!}
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-12">

                                            <label for="inputProductTags" class="form-label">Order Number:</label>
                                            {!! Form::text('order_number',$order_number, ['class' => 'form-control', 'placeholder' => 'Enter Order Number']); !!}
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Date:</label>
                                            {!! Form::date('date',null, ['class' => 'form-control', 'placeholder' => 'Enter Date']); !!}
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Supplier:</label>
                                            {!! Form::select('supplier', $suppliers, null, ['class' => 'form-control', 'placeholder' => '-- Select Supplier --']); !!}
                                           </div>
                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Medicine Name:</label>
                                            {!! Form::select('medicine', $medicines, null, ['class' => 'form-control', 'placeholder' => '-- Select Category --']); !!}
                                        </div>

                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Quantity:</label>
                                            {!! Form::text('qty',null, ['class' => 'form-control', 'placeholder' => 'Enter Qty']); !!}
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                {!! Form::submit('Save', ['class' => 'btn btn-success']); !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div><!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>


@endsection