@extends('template.main')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <h6 class="mb-0 text-uppercase">&nbsp;</h6>
        <hr/>

        <!--end breadcrumb-->
        <div class="row">
            <div class="col-3"></div>
            <div class="col-5">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title">Update Supplier</h5>
                        <hr/>
                        <div class="form-body mt-">
                            <div class="row">

                                <div class="col-lg-12">
                                    @include('template.alert')
                                    {!!  Form::open(['url' => 'supplier/'.$supplier->id, 'method' => 'PUT']) !!}
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">

                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Supplier Name:</label>
                                                {!! Form::text('name',$supplier->name, ['class' => 'form-control', 'placeholder' => 'Enter Supplier Name']); !!}
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Contact Number:</label>
                                                {!! Form::text('contact_number',$supplier->contact_number, ['class' => 'form-control', 'placeholder' => 'Enter Contact Number']); !!}
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']); !!}
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
