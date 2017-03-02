var GLOBAL_JS = {
    go_on_business : 'Phiếu công tác',
    tbl: $('#tbl').val(),
    /**
     * Auth: Dienct
     * Des: delete record
     * Since: 31/12/2015
     * */
    b_fValidateEmpty : function(e) {
		var t=/^ *$/;
		if(e==""||t.test(e)) {
			return true;
		}
		return false;
	},
    b_fCheckEmail : function(e) {
            var t = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            return t.test(e)
    },
    b_fCheckEmailDXMB : function(sz_Email) {
        var sz_check = sz_Email.substr(sz_Email.indexOf("@") + 1);
        if(sz_check != 'dxmb.vn') return false;
        else return true;
    },
    b_fCheckMinLength : function(e, the_i_Length) {
		if (e.length < the_i_Length) {
			return false;
		}
		return true;
	},
    b_fCheckMaxLength : function(e, the_i_Length) {
            if (e.length > the_i_Length) {
                    return false;
            }
            return true;
    },
    b_fCheckConfirmPwd : function(e, t) {
            if (e == t) {
                    return true;
            }
            return false;
	},
    v_fDelRow : function(id,type) {
        var sz_confirm = type == 1 ? "Bạn có muốn cho vào thùng rác?" : "Xóa vĩnh viễn tài khoản trên Izi. Bạn có muốn tiếp tục?";
		if(confirm(sz_confirm)) {
                    var o_data = {
                        id: id,
                        type:type,
                        func:'delete-row',
                        tbl: GLOBAL_JS.sz_Tbl,
                    };
			$.ajax({
                            url: GLOBAL_JS.sz_CurrentHost+'/ajax',
                            type: 'POST',
                            data: o_data,
                            dataType: 'json',
                            success: function (data) {
                                alert(data.success);
                                location.reload();
                            }
                        });
		}
	},
    /**
     * Auth: Dienct
     * Des: recover record
     * Since: 31/12/2015
     * */
    v_fRecoverRow : function(id) {

        var o_data = {
            id: id,
            func:'recover-row',
            tbl: GLOBAL_JS.sz_Tbl,
        };
        $.ajax({
            url: GLOBAL_JS.sz_CurrentHost+'/ajax',
            type: 'POST',
            data: o_data,
            dataType: 'json',
            success: function (data) {
                alert(data.success);
                location.reload();
            }
        });
    },       
    v_fUpdateStatus : function(id,type) {
        var sz_confirm = type == 1 ? "Bạn có muốn cho vào thùng rác?" : "Bạn có muốn xóa đơn này?";
		if(confirm(sz_confirm)) {
                    var o_data = {
                        id: id,
                        type:type,
                        func:'update-status',
                        tbl: GLOBAL_JS.sz_Tbl,
                    };
			$.ajax({
                            url: GLOBAL_JS.sz_CurrentHost+'/ajax',
                            type: 'POST',
                            data: o_data,
                            dataType: 'json',
                            success: function (data) {
                                alert(data.success);
                                location.reload();
                            }
                        });
		}
	},
        /**
     * Auth: Dienct
     * Des: 
     * Since: 02/003/2017
     * */
    v_fSubmitProjectValidate : function()
    {
        var sz_name = $('#name').val();
        if(GLOBAL_JS.b_fValidateEmpty(sz_name)){
           $('.required_name').remove();
           $('.alert-danger').append('<p><strong class="required_name">Bạn cần nhập tên phòng</strong></p>');
           $('.alert-danger').removeClass('hide');
           $('#name').focus();
           return false;
        }
        if($('.alert-danger').text() != '') return false;
        $('.submit').click();
    }
        
};

$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var t = $(location).attr("href");
    GLOBAL_JS.sz_CurrentHost = t.split("/")[0] + "//" + t.split("/")[2];
    GLOBAL_JS.sz_Tbl = $('#tbl').val();

});
