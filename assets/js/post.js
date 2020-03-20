$(document).ready(function(){
    var base_url = $('.base_url').val();

    var table_user = $("#comment_table").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0,'desc']],
        "columns":[
             {"data":"post_id"},
             {"data": "post"},
             {"data": "post_id","render":function(data, type, row, meta){
                       var str = '';
                       str += '<div class="btn-group">';
                            str += '<a href="" class="btn btn-danger btn-sm delete_post_action" data-id="'+row.post_id+'"><i class="fa fa-trash"></i></a>';
                            str += '<a href="" data-toggle="modal" data-target="#editPost" class="btn btn-primary btn-sm post_details_action" data-id="'+row.post_id+'" data-post="'+row.post+'"><i class="fa fa-edit"></i></a>';
                       str += '</div>';
                       return str;
                  }
             },
        ],
        "ajax": {
             "url": base_url+"comment/get_comments",
             "type": "POST"
        },
        "columnDefs": [
             {
                  "targets": [],
                  "orderable": false,

              },
         ],
   });

   $(document).on('click','.delete_post_action',function(e){
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
                    url: base_url+'comment/delete',
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

        //if mo upload og pic using file upload e off ang content data and process data

        $(document).on('click','.post_details_action',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-post');

            $('input[name="post_id"]').val(id);
            $('input[name="comment"]').val(name);
            $('.modal-title').html('Update Post');
            $('.action-btn').html('Update');
        });
        //Edit User
        $('#editPost form').on('submit', function(e){
            e.preventDefault();
            const self = $(this);
            $.ajax({
                url: base_url+'comment/edit_post',
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
        $('#addPost form').on('submit', function(e){
            e.preventDefault();
            const self = $(this);
            $.ajax({
                url: base_url+'comment/insertpost',
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

        $('#sendEmail form').on('submit', function(e){
            e.preventDefault();
            const self = $(this);
            $.ajax({
                url: base_url+'comment/send_email',
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
                      $('#sendEmail').modal('hide');
                      table_user.ajax.reload();
                }
            });
        });
});