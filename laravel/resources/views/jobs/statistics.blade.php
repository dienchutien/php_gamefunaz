@extends('layouts.app')
@section('content')

<h3 class="col-xs-12 no-padding">Danh sách tác vụ</h3>
<div class="alert alert-danger hide"></div>
<form method="get" action="" id="frmFilter" name="frmFilter"  class="form-inline">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    </br></br>
    <div class="form-group">
        <input type="text" class="form-control datepicker input-sm" id="from_date" name="from_date" placeholder="Từ ngày" value="<?php echo isset($a_search['from_date'])?$a_search['from_date']:''?>"> <span class="glyphicon glyphicon-minus"></span>
        <input type="text" class="form-control datepicker input-sm" id="to_date" name="to_date" placeholder="Tới ngày" value="<?php echo isset($a_search['to_date'])?$a_search['to_date']:''?>">
    </div>
    <div class="form-group">
        <select id="filter_by" name="filter_by" class="form-control input-sm">
            <option value="">Lọc theo</option>
            <option value="channel_id" <?php echo isset($a_search['filter_by']) && $a_search['filter_by'] == 'channel_id' ? 'selected':''?>>Kênh</option>
            <option value="project_id" <?php echo isset($a_search['filter_by']) && $a_search['filter_by'] == 'project_id' ? 'selected':''?>>Dự Án</option>
            <option value="branch_id" <?php echo isset($a_search['filter_by']) && $a_search['filter_by'] == 'branch_id' ? 'selected':''?>>Chi Nhánh</option>
        </select>
    </div>
    
    <div class="form-group">
        <input type="button" name="submit" class="btn btn-success btn-sm" value="Tìm kiếm" onclick="GLOBAL_JS.v_fSearchSubmitStatistics()">
        <input type="submit" name="submit" class="btn btn-success btn-sm submit hide">
    </div>
</form>
    <div class="">
        <table class="table table-responsive table-hover table-striped table-bordered">
            <tr>
                <td class="bg-success"><strong>STT</strong></td>
                <td class="bg-success"><strong>Tên</strong></td>
                <td class="bg-success"><strong>Tổng Chi Phí</strong></td>
                <td class="bg-success"><strong>Thời gian</strong></td>
            </tr>
            @if(isset($a_Jobs))
                @foreach($a_Jobs as $o_Job)
            <tr>
                <td> {{ $o_Job->stt }}</td>
                <td> {{ $o_Job->name }}</td>
                <td> {{ number_format($o_Job->total_money) }} VNĐ</td>
                <td> {{ $o_Job->time }}</td>
            </tr>
                @endforeach
            @endif
        </table>
        <div class="form-group">
            <div class="col-xs-12 col-sm-2 no-padding">
                <a class="btn btn-primary btn-sm" href="/export_Jobs_Statistics" target="_blank">Export Excel</a>
            </div>
        </div>
    </div>

<!--Hidden input-->
<input type="hidden" name="tbl" id="tbl" value="jobs">
<?php  if(count($a_Jobs) > 0 ){
    echo (empty($a_search))?$a_Jobs->render(): $a_Jobs->appends($a_search)->render();
}?>

@endsection