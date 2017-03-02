@extends('layouts.app')
@section('content')

<h3 class="col-xs-12 no-padding">Danh sách dự án</h3>
    <div class="">
        <table class="table table-responsive table-hover table-striped table-bordered">
            <tr>
                <td><strong>STT</strong></td>
                <td><strong>Tên dự án</strong></td>
                <td><strong>Trạng thái</strong></td>
                <td><strong>Ngày tạo</strong></td>
                <td><strong>Ngày sửa</strong></td>
                <td><strong>Action</strong></td>
            </tr>
        @foreach ($a_Data as $a_val)
            <tr>
                <td>    {{ $a_val->stt }}</td>
                <td>    {{ $a_val->name }}</td>
                <th class="text-center"> <input id="status_<?= $a_val->id;?>" name="status_<?=$a_val->id;?>" type="checkbox" class="" value="1" <?php if($a_val->status == 1) echo "checked"?> disabled/></th>
                <td>    {{ $a_val->created_at }}</td>
                <td>    {{ $a_val->updated_at }}</td>
                <td>                    
                    <a title="Edit" href="<?php echo Request::root().'/department/addedit?id='.$a_val->id;?>" title="Edit" class="not-underline">
                        <i class="fa fa-edit fw"></i>
                    </a>                    
                    <a id="trash_switch_" href="javascript:GLOBAL_JS.v_fDelRow({{ $a_val->id }},2)" title="Xóa" class="not-underline">
                        <i class="fa fa-trash-o fa-fw text-danger"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </table>
    </div>

<!--Hidden input-->
<input type="hidden" name="tbl" id="tbl" value="departments">

@endsection