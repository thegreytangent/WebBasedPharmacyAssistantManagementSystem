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
                        <h5 class="card-title">Update Customer</h5>
                        <hr/>
                        <div class="form-body mt-">
                            <div class="row">

                                <div class="col-lg-12">
                                    @include('template.alert')
                                    {!!  Form::open(['url' => 'customer/' . $customer->id, 'method' => 'PUT']) !!}
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">

                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Username:</label>
                                                {!! Form::text('username',$customer->username, ['class' => 'form-control', 'placeholder' => 'Username']); !!}
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Password:</label>
                                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']); !!}
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Firstname:</label>
                                                {!! Form::text('firstname',$customer->firstname, ['class' => 'form-control', 'placeholder' => 'Firstname']); !!}
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Lastname:</label>
                                                {!! Form::text('lastname',$customer->lastname, ['class' => 'form-control', 'placeholder' => 'Lastname']); !!}
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Birthdate:</label>
                                                {!! Form::date('birthdate',$customer->birthdate, ['class' => 'form-control']); !!}
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Address:</label>
                                                {!! Form::textarea('address',$customer->address, [
	                                                    'class' => 'form-control',
	                                                    'placeholder' => 'Enter Address',
	                                                    'rows' => '4'
	                                                    ]); !!}
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
