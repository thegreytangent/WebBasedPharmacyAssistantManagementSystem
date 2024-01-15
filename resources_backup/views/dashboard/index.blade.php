@extends('template.main')
@push('styles')
@endpush

@section('content')
    <div class="page-content">
        <div class="row row-cols-3 row-cols-md-3 row-cols-xl-3">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Orders</p>
                                <h4 class="my-1 text-info">{{$total_orders}}</h4>
                                <p class="mb-0 font-13">&nbsp;</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Sales</p>
                                <h4 class="my-1 text-danger">Php {{$total_sales}}</h4>
                                <p class="mb-0 font-13">&nbsp;</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                    class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Number of Suppliers</p>
                                <h4 class="my-1 text-success">{{$total_suppliers}}</h4>
                                <p class="mb-0 font-13">&nbsp;</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="col">--}}
            {{--                <div class="card radius-10 border-start border-0 border-4 border-warning">--}}
            {{--                    <div class="card-body">--}}
            {{--                        <div class="d-flex align-items-center">--}}
            {{--                            <div>--}}
            {{--                                <p class="mb-0 text-secondary">Total Customers</p>--}}
            {{--                                <h4 class="my-1 text-warning">{{$total_customers}}</h4>--}}
            {{--                                <p class="mb-0 font-13">&nbsp;</p>--}}
            {{--                            </div>--}}
            {{--                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i--}}
            {{--                                    class='bx bxs-group'></i>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div><!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Monthly Sales Overview</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                                <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                                                                    style="color: #14abef"></i>Sales</span>

                        </div>
                        <div class="chart-container-1">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Most Medicine Purchase</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                   data-bs-toggle="dropdown"><i
                                        class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>

                            </div>
                        </div>
                    </div>

                    <ul class="list-group list-group-flush">

                        @foreach($medicines as $medicine)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                            {{$medicine->name}} <span class="badge  {{$medicine->bg}} rounded-pill">{{$medicine->count}} </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><!--end row-->

    </div>
@endsection

@push('scripts')
{{--    <script src="assets/js/index.js"></script>--}}
    <script>








        var ctx = document.getElementById("chart1").getContext('2d');

        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke1.addColorStop(0, '#6078ea');
        gradientStroke1.addColorStop(1, '#17c5ea');

        var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke2.addColorStop(0, '#ff8359');
        gradientStroke2.addColorStop(1, '#ffdf40');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales',
                    data: {{json_encode($monthly_sales)}},
                    borderColor: gradientStroke1,
                    backgroundColor: gradientStroke1,
                    hoverBackgroundColor: gradientStroke1,
                    pointRadius: 0,
                    fill: false,
                    borderRadius: 20,
                    borderWidth: 0
                }]
            },

            options: {
                maintainAspectRatio: false,
                barPercentage: 0.5,
                categoryPercentage: 0.8,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush



