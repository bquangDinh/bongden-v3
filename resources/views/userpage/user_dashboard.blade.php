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
    <div class="col-xl-6 col-md-12 mb-4">
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
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Số thảo luận
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ Auth::user()->achieveDetail->discussionCount }} thảo luận
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-comments fa-2x text-gray-300"></i>
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
    @if($next_medal)
    <div class="col-xl-9 col-md-12 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Huy chương tiếp theo
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <span class="badge badge-danger">{{ $next_medal->name }}</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-star-of-david fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="row">
  <div class="col-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tổng quan về kinh nghiệm</h6>
      </div>
      <div class="card-body">
        <h4 class="small font-weight-bold">Tổng kinh nghiệm
          <span style="float:right">{{ Auth::user()->achieveDetail->exp }} / {{ $exp_to_next_level }}</span>
        </h4>
        <div class="progress mb-4 tooltip-o" data-tooltip-message="Bạn cần {{ $exp_to_next_level }} điểm để lên cấp tiếp theo">
          <div class="progress-bar" role="progressbar" style="width: {{ intval(Auth::user()->achieveDetail->exp * 100 / $exp_to_next_level) }}%" aria-valuenow="{{ intval(Auth::user()->achieveDetail->exp * 100 / $exp_to_next_level) }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4 shadow">
            <a href="#collapseCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                <h6 class="m-0 font-weight-bold text-primary">
                  Huy chương đã đạt được <i class="fas fa-medal" style="color: #f1c40f"></i> <i class="fas fa-medal" style="color: #f1c40f"></i> <i class="fas fa-medal" style="color: #f1c40f"></i>
                </h6>
            </a>
            <div class="collapse show" id="collapseCard" style="">
                <div class="card-body">
                    @foreach(Auth::user()->achievements as $achieved)
                    <div class="card border-left-info shadow h-100 py-2 mb-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ $achieved->achievement->name }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      <span class="badge badge-danger">{{ $achieved->achievement->description }}</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-star-of-david fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('js/vendor/chart.js/Chart.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/vendor/randomColor.min.js') }}" charset="utf-8"></script>
<!--Receive data from server-->
<script type="text/javascript">
  var article_count_statistics = {!! json_encode($article_count_statistics) !!};
  var article_count_by_subject_statistics = {!! json_encode($article_count_by_subject_statistics) !!};
  var article_subject_colors = randomColor({
    count: Object.keys(article_count_by_subject_statistics).length,
    format:'rgba',
    luminosity:'dark'
  });
</script>
<script src="{{ URL::asset('js/userpage/user_dashboard.js') }}" charset="utf-8"></script>
@endsection
