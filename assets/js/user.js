$(document).ready(function(){
    var base_url = $('.base_url').val();

    var table_user = $("#user_table").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0,'desc']],
        "columns":[
             {"data":"user_id"},
             {"data": "name","render":function(data, type, row, meta){
                       var str = '';
                       str += row.name;
                       return str;
                  }
             },
             {"data":"username"},
             {"data":"password"},
             {"data": "user_id","render":function(data, type, row, meta){
                       var str = '';
                       str += '<div class="btn-group">';
                              if(row.status == '1'){
                                   str += '<a href="" class="btn btn-warning btn-sm user_action_status" data-id="'+row.user_id+'" data-status="0"><i class="fa fa-lock"></i> Deactivate</a>';
                              } else{
                                   str += '<a href="" class="btn btn-success btn-sm user_action_status" data-id="'+row.user_id+'" data-status="1"><i class="fa fa-unlock"></i> Activate</a>';
                              }
                       str += '<div class="btn-group">';
                            str += '<a href="" class="btn btn-danger btn-sm delete_user_action" data-id="'+row.user_id+'"><i class="fa fa-trash"></i></a>';
                            str += '<a href="" data-toggle="modal" data-target="#addEmployee" class="btn btn-primary btn-sm user_details_action" data-id="'+row.user_id+'" data-name="'+row.name+'" data-username="'+row.username+'" data-password="'+row.password+'"><i class="fa fa-edit"></i></a>';
                       str += '</div>';
                       return str;
                  }
             },
        ],
        "ajax": {
             "url": base_url+"user/get_employees",
             "type": "POST"
        },
        "columnDefs": [
             {
                  "targets": [],
                  "orderable": false,

              },
         ],
   });

   $(document).on('click','.delete_user_action',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this brand",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#1A6519",
            confirmButtonText: "Yes",
        }).then((confirm) => {
            if (confirm.value) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  ),
                $.ajax({
                    url: base_url+'user/delete',
                    type:'post',
                    //dataType:'json',
                    data: {
                        'id': id
                    },
                    success: function(res){
                        $.toast({
                            heading: 'Successfully Deleted',
                            text: res.message,
                            position: 'top-right',
                            loaderBg: '#178472',
                            icon: res.type,
                            hideAfter: 2000,
                            stack: 6
                        })
                        table_user.ajax.reload();
                    }
                })
            }
        }); 
    });


        $(document).on('click','.user_action_status',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            Swal.fire({
                title: "Are you sure?",
                text: "This account will be deactivate",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1A6519",
                confirmButtonText: "Yes",
            }).then((confirm) => {
                    if (confirm.value) {
                        if(status == 1){
                            Swal.fire(
                                'Activated!',
                                'Your file has been active.',
                                'success'
                            )
                        }
                        if(status == 0){
                            Swal.fire(
                                'Deactivated!',
                                'Your file has been deactivate.',
                                'success'
                            )
                        }
                            $.ajax({
                                url:'user/deactivate_users',
                                type:'post',
                                //dataType:'json',
                                data: {
                                    'id': id,
                                    'status': status
                                },
                                success: function(res){
                                    $.toast({
                                        heading: 'Deactivate Successfully',
                                        text: res.message,
                                        position: 'top-right',
                                        loaderBg: '#178472',
                                        icon: res.type,
                                        hideAfter: 2000,
                                        stack: 6
                                    })
                                    table_user.ajax.reload();
                                }
                            })
                    }
            }); 
        });
        

        //if mo upload og pic using file upload e off ang content data and process data

        $(document).on('click','.user_details_action',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var username = $(this).attr('data-username');
            var password = $(this).attr('data-password');

            $('input[name="user_id"]').val(id);
            $('input[name="name"]').val(name);
            $('input[name="username"]').val(username);
            $('input[name="password"]').val(password);
            $('.modal-title').html('Update User');
            $('.action-btn').html('Update');
        });
        //Edit User
        $('#addEmployee form').on('submit', function(e){
            e.preventDefault();
            const self = $(this);
            $.ajax({
                url: base_url+'user/edit_user',
                type: 'POST',
                dataType: 'json',
                data: self.serialize(),
                success: function(res){
                    Swal.fire({
                        title: "Saved",
                        text: "Successfully Update",
                        type: "success",
                        //showCancelButton: true,
                        confirmButtonColor: "#1A6519",
                        confirmButtonText: "Yes",
                      });
                      $('#addEmployee').modal('hide');
                      table_user.ajax.reload();
                }
            });
        });

        //Add User
        $('#addUser form').on('submit', function(e){
            e.preventDefault();
            const self = $(this);
            $.ajax({
                url: base_url+'user/insertuser',
                type: 'POST',
                dataType: 'json',
                data: self.serialize(),
                success: function(res){
                    Swal.fire({
                        title: "Saved",
                        text: "Successfully Added",
                        type: "success",
                        //showCancelButton: true,
                        confirmButtonColor: "#1A6519",
                        confirmButtonText: "Yes",
                      });
                      $('#addUser').modal('hide');
                      table_user.ajax.reload();
                }
            });
        });
});