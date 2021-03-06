@extends('layouts.app')

@section('main_container')
    <div class="right_col">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>NC数据报表</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>需用计划查询 <small>jzpm_mt_cplan_b</small></h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="invcode" class="col-sm-2 control-label">物资编码</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="code" class="form-control" value="{{ $q['code'] }}" placeholder="请输入查询的物资编码">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="invname" class="col-sm-2 control-label">物资名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" value="{{ $q['name'] }}" placeholder="请输入查询的物资名称">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-sm-2 control-label">起始时间</label>
                                        <div class="col-sm-10">
                                            <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                <span></span> <b class="caret"></b>
                                            </div>
                                            <input id="startDate" type="hidden" name="start" value="{{ $q['start'] }}">
                                            <input id="endDate" type="hidden" name="end" value="{{ $q['end'] }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <div class="pull-right col-sm-5">
                                            <button id="searchBtn" type="button" class="btn btn-default">
                                                <span class="glyphicon glyphicon-search"></span> 查询
                                            </button>
                                            <button id="exportBtn" type="button" class="btn btn-default" @if($warning) disabled @endif>
                                                <span class="glyphicon glyphicon-export"></span> 导出
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <p> @if($tips)
                                    <span>{{ $tips }}</span>
                                @endif
                                @if ($warning)
                                    <span style="color: #a94442" class="control-label"><span class="glyphicon glyphicon-info-sign"></span>{{ $warning['msg'] }}</span>
                                @endif
                            </p>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        {{--<th>No</th>--}}
                                        <th>编码</th>
                                        <th>名称(规格)</th>
                                        <th>申报数量</th>
                                        <th>单价</th>
                                        <th>添加剂</th>
                                        <th>供应商</th>
                                        <th>核定时间</th>
                                        {{--<th>备注</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($rows as $row)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            {{--<th>{{ $row->pk_mt_cplan }}</th>--}}
                                            <th>{{ $row->invcode }}</th>
                                            <th>{{ $row->invname }}<br><span class="small" style="font-weight:normal;">{{ $row->invspec }}</span></th>
                                            <th>{{ $row->nnum }}</th>
                                            <th>{{ $row->nprice }}</th>
                                            <th>{{ $row->vdef1 }}</th>
                                            <th>{{ $row->custname }}</th>
                                            <th>{{ $row->tbilltime }}</th>
                                        {{--<th>{{ $row->vdef3 }}</th>--}}
                                        <tr>
                                    @empty
                                        <tr>
                                            <th colspan="9" style="text-align: center">没有数据</th>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if($rows)
                                {{ $rows->appends($q)->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $("#searchBtn").on('click', function(){
        $(this).closest('form').attr("action", "{{ route('report.xyjh') }}").submit();
    });

    $("#exportBtn").on('click', function(){
        $(this).closest('form').attr("action", "{{ route('export.xyjh') }}" ).submit();
    });
</script>
@endpush
