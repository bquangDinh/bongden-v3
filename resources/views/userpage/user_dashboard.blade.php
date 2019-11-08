@extends('userpage.user_layout')

@section('title')
Dashboard
@endsection

@section('css')
@endsection

@section('content-title')
Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Bạn đã đóng góp
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ Auth::user()->achieveDetail->articleCount }} bài viết
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Bài viết trong tuần
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          0
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Số thảo luận
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          0
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Lượt follow
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          0
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="{!! Auth::user()->achieveDetail->articleCount == 0 ? 'd-none' : 'col-xl-4 col-lg-5' !!}">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Phân bố bài viết theo loại</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 mb-4">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="articleBySubjectPieChar" width="277" height="253" class="chartjs-render-monitor" style="display: block; width: 277px; height: 253px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-7">

        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Bài viết theo tháng năm 2019</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="articleCountByMonth" style="display: block; width: 413px; height: 180px;" width="413" height="180" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Cấp độ
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ Auth::user()->achieveDetail->level }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-brain fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Tổng kinh nghiệm
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ Auth::user()->achieveDetail->exp }} / {{ Auth::user()->achieveDetail->expToLevelUp(Auth::user()->achieveDetail->level) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-angle-double-right fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Nhiệm vụ đã hoàn thành
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">23/25</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Huy chương tiếp theo
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <span class="badge badge-danger">Ngôi sao mới nổi</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-star-of-david fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('js/vendor/chart.js/Chart.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/userpage/user_dashboard.js') }}" charset="utf-8"></script>
@endsection
