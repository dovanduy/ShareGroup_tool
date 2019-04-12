// Ajax về phần đăng k

$(document).ready(function(){

	$('button#btn_change').click(function(event) {
		var id_user = $(this).attr('id_user');
		$('#ModalEdit').modal();
		$('#myModalLabel').text('SỬA THÔNG TIN NGƯỜI DÙNG');
		$('button#update').text('CẬP NHẬT');
		$('#myModalLabel').attr('up_add', 'up');
		$.ajax({
			url: 'include/option.php',
			type:'POST',
			dataType: 'html',
			data:{
				id: id_user,
				type: 'up'
			},

			success: function(data){
				$('#noidungsua').html(data);
			}
		});
	});

    $('#update').click(function(){
        var data = $('#myModalLabel').attr('up_add');
        $.post(
            "include/process_user_DB.php",
            {
                option: data,
                id: $('#id_user').val(),
                user: $('#user').val(),
                pass: $('#pass').val(),
                name: $('#name').val(),
                ip_address: $('#ip_address').val(),
                // tag: $('#tag').val(),
                // tagNoFr: $('#tagNoFr').val(),
                // getToken: $('#getToken').val(),
                // postPasG: $('#postPasG').val(),
                // postP: $('#postP').val(),
                // joinG: $('#joinG').val(),
                // postG: $('#postG').val()
            },
            function(data, status){
                location.reload();
            }
        );
    });

	$('button#btn_del').click(function(event) {
		var id_user = $(this).attr('id_user');
		swal({
			title: "Bạn có chắc muốn xoá người dùng này ?",
			icon: 'warning',
			buttons: {
                confirm: {
                    text: "Đồng ý",
                    value: true,
                    visible: true,
                    // className: "btn btn-success",
                },
                cancel: {
                    text: "Huỷ",
                    value: false,
                    visible: true,
                    // className: "btn btn-danger m-l-10",
                    closeModal: true,
                },
            },
			// showCancelButton: true,
			// confirmButtonText: 'Đồng ý',
			// cancelButtonText: 'Huỷ',
			// confirmButtonClass: 'btn btn-success',
			// cancelButtonClass: 'btn btn-danger m-l-10',
			// buttonsStyling: false
		}).then(function(){
			$.post(
				"include/process_user_DB.php",
				{
                    option: 'del',
					id: id_user
				},
				function(data, status){
					location.reload();
				}
			)
		});
	});


	$('#btn_add').click(function(){
		$('#ModalEdit').modal();
		$('#myModalLabel').text('THÊM NGƯỜI DÙNG');
		$('button#update').text('THÊM NGƯỜI DÙNG');
		$('#myModalLabel').attr('up_add', 'add');
		$.post(
			"include/option.php",
			{
				type: 'add'
			},
			function(data, status){
				$('#noidungsua').html(data);
			}
		);


	});

	//============================== Proxy ==================================

    $('button#btn_change_proxy').click(function(event) {
        var id = $(this).attr('id_proxy');
        $('#ModalEditProxy').modal();
        $('#myModalLabel').text('SỬA THÔNG TIN PROXY');
        $('button#update').text('CẬP NHẬT');
        $('#myModalLabel').attr('up_add', 'up');
        $.ajax({
            url: 'include/option_proxy.php',
            type:'POST',
            dataType: 'html',
            data:{
                id: id,
                type: 'up'
            },

            success: function(data){
                $('#noidungsua').html(data);
            }
        });
    });

    $('#update_proxy').click(function(){
        var data = $('#myModalLabel').attr('up_add');
        $.post(
            "include/process_proxy_DB.php",
            {
                option: data,
                id: $('#id').val(),
                proxy: $('#proxy').val(),
            },
            function(data, status){
                location.reload();
            }
        );
    });

    $('button#btn_del_proxy').click(function(event) {
        var id = $(this).attr('id_proxy');
        swal({
            title: "Bạn có chắc muốn xoá Proxy này ?",
            icon: 'warning',
            buttons: {
                confirm: {
                    text: "Đồng ý",
                    value: true,
                    visible: true,
                    // className: "btn btn-success",
                },
                cancel: {
                    text: "Huỷ",
                    value: false,
                    visible: true,
                    // className: "btn btn-danger m-l-10",
                    closeModal: true,
                },
            },
        }).then(function(){
            $.post(
                "include/process_proxy_DB.php",
                {
                    option: 'del',
                    id: id
                },
                function(data, status){
                    location.reload();
                }
            )
        });
    });


    $('#btn_add_proxy').click(function(){
        $('#ModalEditProxy').modal();
        $('#myModalLabel').text('THÊM PROXY');
        $('button#update').text('THÊM PROXY');
        $('#myModalLabel').attr('up_add', 'add');
        $.post(
            "include/option_proxy.php",
            {
                type: 'add'
            },
            function(data, status){
                $('#noidungsua').html(data);
            }
        );


    });


});


function toolTag(){
	$('#change').load('tool/tag.php');
}

function toolTagNoFr(){
	$('#change').load('tool/tagNoFr.php');
}

function toolGetTokenIns(){
	$('#change').load('tool/getTokenIns.php');
}

function toolPostProfile(){
	$('#change').load('tool/postProfile.php');
}

function toolPostGroup(){
	$('#change').load('tool/postGroup.php');
}

function toolPostProfileAsGroup(){
	$('#change').load('tool/postProfileAsGroup.php');
}

function toolJoinGroup(){
	$('#change').load('tool/toolJoinGroup.php');
}