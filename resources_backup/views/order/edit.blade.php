@extends('template.main')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <h6 class="mb-0 text-uppercase">&nbsp;</h6>
        <hr/>

        <!--end breadcrumb-->
        <div class="row">
            <div class="col-3"></div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title">Update Medicine</h5>
                        <hr/>
                        <div class="form-body mt-">
                            <div class="row">

                                <div class="col-lg-12">
                                    @include('template.alert')
                                    {!!  Form::open(['url' => 'medicine/' . $medicine->id , 'method' => 'PUT']) !!}
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Supplier:</label>
                                                {!! Form::select('supplier', $suppliers, $supplier_id, ['class' => 'form-control', 'placeholder' => '-- Select Supplier --']); !!}
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Category:</label>
                                                {!! Form::select('category', $categories, $category_id, ['class' => 'form-control', 'placeholder' => '-- Select Category --']); !!}
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Medicine Name:</label>
                                                {!! Form::text('medicine_name',$medicine->medicine_name, ['class' => 'form-control', 'placeholder' => 'Enter Medicine Name']); !!}
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Medicine Price:</label>
                                                {!! Form::text('price',$medicine->price, ['class' => 'form-control', 'placeholder' => 'Enter Price']); !!}
                                            </div>

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    {!! Form::submit('Update', ['class' => 'btn btn-primary']); !!}
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
