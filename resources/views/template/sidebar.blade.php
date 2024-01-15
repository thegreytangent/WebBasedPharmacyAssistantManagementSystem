<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            {{--            <img src="{{asset('assets/images/logo-img.png')}}" alt="logo-icon" />--}}
            {{--            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">--}}
        </div>
        <div>
            {{--            <h4 class="logo-text">Pharmacy Assistant Management System</h4>--}}
        </div>
        {{--        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>--}}
        {{--        </div>--}}
    </div>
    <!--navigation-->

    <ul class="metismenu" id="menu">

        @if(session('role') == 'admin')
            @include('template.sidebar_admin')
        @else
            @include('template.sidebar_customer')
        @endif

    </ul>
    <!--end navigation-->
</div>
