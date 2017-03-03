@extends('layouts.app')
@section('content')

<h3 class="col-xs-12 no-padding"><?php echo $i_id == ''?'Thêm tác vụ mới':'Sửa tác vụ'?></h3>
<div class="alert alert-danger hide"></div>
<form class="form-horizontal" method="post" action="">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <input type="hidden" id="id" value="<?php echo $i_id?>">
    <input type="hidden" id="tbl" value="jobs">
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 no-padding">
            <label for="name" class="col-xs-12 col-sm-3 control-label text-left">Tiêu đề</label>
            <div class="col-xs-12 col-sm-9 no-padding">
                <input id="title" name="title" field-name="Tên" <?php echo $i_id == 0 ? '' : 'old_val="'.$a_Jobs->name.'"'?> type="text" value="<?php echo isset($a_Jobs->name)?$a_Jobs->name:"" ?>" class="form-control check-duplicate" placeholder="Tiêu đề" required />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 no-padding">
            <label for="description" class="col-xs-12 col-sm-3 control-label text-left">Ghi chú</label>
            <div class="col-xs-12 col-sm-6 no-padding">
                <textarea class="form-control" rows="5" id="description" name="description" placeholder="Nhập ghi chú"></textarea>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 no-padding">
            <label for="projects" class="col-xs-12 col-sm-3 control-label text-left">Chọn Dự Án</label>
            <div class="col-xs-12 col-sm-6 no-padding">
                <select class="form-control input-sm " id="projects" name="projects">
                    <option value="">Chọn Dự Án</option>
                    <option value="2">làm thêm tính tăng ca</option>                        
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 col-sm-6 no-padding">
            <label for="channel" class="col-xs-12 col-sm-3 control-label text-left">Chọn Kênh</label>
            <div class="col-xs-12 col-sm-6 no-padding">
                <select class="form-control input-sm " id="channel" name="channel">
                    <option value="">Chọn Kênh</option>
                    <option value="1">làm thêm cộng phép nghỉ bù</option>
                    <option value="2">làm thêm tính tăng ca</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 no-padding">
            <label for="job_type" class="col-xs-12 col-sm-3 control-label text-left">Chọn Loại tác vụ</label>
            <div class="col-xs-12 col-sm-6 no-padding">
                <select class="form-control input-sm " id="job_type" name="job_type">
                    <option>Chọn Loại tác vụ</option>
                    <option value="0">Tác vụ trả trước</option>
                    <option value="2">Tác vụ trả sau</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-3 no-padding">
            <label for="date_finish" class="col-xs-6 control-label text-left">Ngày hoàn thành</label>
            <div class="col-xs-12 col-sm-6 no-padding">
                <input type="text" class="form-control datepicker" id="date_finish" name="date_finish" placeholder="Chọn ngày hoàn thành tác vụ">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 col-sm-3 no-padding">
            <label for="status" class="col-xs-6 control-label text-left">Trạng thái hiển thị</label>
            <div class="col-xs-6 no-left-padding">
                <input id="status" name="status" type="checkbox" class="form-control" <?php if (!isset($a_Jobs->status) || $a_Jobs->status == 1): ?>checked<?php endif ?>>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-xs-6 col-sm-3 no-padding">
            <button type="reset" class="btn btn-default">Nhập lại</button>
            <input type="button" name="submit" VALUE="Cập nhật" class="btn btn-primary btn-sm " onclick="GLOBAL_JS.v_fSubmitProjectValidate()"/>
            <input type="submit" name="submit" class="btn btn-primary btn-sm hide submit">
        </div>
    </div>
</form>

@endsection
