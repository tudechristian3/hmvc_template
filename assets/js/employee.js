$(document).ready(function(){
    var base_url = $('.base_url').val();

    var table_user = $("#employee_table").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0,'desc']],
        "columns":[
             {"data":"employee_id"},
             {"data": "employee_id","render":function(data, type, row, meta){
                       var str = '';
                       str += row.employee_lname + ", " + row.employee_fname;
                       return str;
                  }
             },
             {"data":"employee_birthdate"},
             {"data":"employee_age"},
             {"data":"employee_address"},
             {"data":"employee_gender"},
             {"data": "employee_id","render":function(data, type, row, meta){
                       var str = '';
                       str += '<div class="btn-group">';
                              if(row.status == '1'){
                                   str += '<a href="" class="btn btn-warning btn-sm employee_action_status" data-id="'+row.employee_id+'" data-status="0"><i class="fa fa-lock"></i> Deactivate</a>';
                              } else{
                                   str += '<a href="" class="btn btn-success btn-sm employee_action_status" data-id="'+row.employee_id+'" data-status="1"><i class="fa fa-unlock"></i> Activate</a>';
                              }
                       str += '<div class="btn-group">';
                            str += '<a href="" class="btn btn-danger btn-sm delete_employee_action" data-id="'+row.employee_id+'"><i class="fa fa-trash"></i></a>';
                            str += '<a href="" data-toggle="modal" data-target="#EditEmployee" class="btn btn-primary btn-sm employee_details_action" data-id="'+row.employee_id+'" data-employee_fname="'+row.employee_fname+'" data-employee_lname="'+row.employee_lname+'" data-birthdate="'+row.employee_birthdate+'" data-age="'+row.employee_age+'" data-address="'+row.employee_address+'" data-gender="'+row.employee_gender+'"><i class="fa fa-edit"></i></a>';   
                            str += '<a href="" class="btn btn-primary btn-sm employee_certificate_action" data-id="'+row.employee_id+'" data-employee_fname="'+row.employee_fname+'" data-employee_lname="'+row.employee_lname+'" data-birthdate="'+row.employee_birthdate+'" data-age="'+row.employee_age+'" data-address="'+row.employee_address+'" data-gender="'+row.employee_gender+'"><i class="fa fa-print"></i></a>';   
                       str += '</div>';
                       return str;
                  }
             },
        ],
        "ajax": {
             "url": base_url+"employee/get_employees",
             "type": "POST"
        },
        "columnDefs": [
             {
                  "targets": [],
                  "orderable": false,

              },
         ],
   });

   $(document).on('click','.delete_employee_action',function(e){
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
                    url:base_url+'employee/delete',
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


        $(document).on('click','.employee_action_status',function(e){
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
                                url:base_url+'employee/deactivate_users',
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
        //getting data
        $(document).on('click','.employee_details_action',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var fname = $(this).attr('data-employee_fname');
            var lname = $(this).attr('data-employee_lname');
            var birthdate = $(this).attr('data-birthdate');
            var age = $(this).attr('data-age');
            var address = $(this).attr('data-address');

            $('input[name="employee_id"]').val(id);
            $('input[name="fname"]').val(fname);
            $('input[name="lname"]').val(lname);
            $('input[name="birthdate"]').val(birthdate);
            $('input[name="age"]').val(age);
            $('input[name="address"]').val(address);
            $('.modal-title').html('Update Employee');
            $('.action-btn').html('Update');
        });
        //Edit Employee
        $('#EditEmployee form').on('submit', function(e){
            e.preventDefault();
            const self = $(this);
            $.ajax({
                url: base_url+'employee/edit_employee',
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
                      $('#EditEmployee').modal('hide');
                      table_user.ajax.reload();
                }
            })
        })

        //Add Employee
        $('#addEmployee form').on('submit', function(e){
            e.preventDefault();
            const self = $(this);
            //var user_id = $('.user_id').val();
            $.ajax({
                url: base_url+'employee/insertuser',
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
                      $('#addUser').modal('hide');
                      table_user.ajax.reload();
                }
            })
        })


        $(document).on('click','.employee_certificate_action',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
           
            let formdata = {id : id};
            $.ajax({
                url:base_url+'employee/add_certificate',
                method:'POST',
                data: formdata,
                success: function(res){
                    console.log(res);
                    //window.open(base_url+'upload/test.pdf');
                    // window.location.href = base_url+'employee/add_certificate';
                }
            }) 
           
        });
});