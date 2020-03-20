$(document).ready(function(){
    var base_url = $('.base_url').val();
    var table_user = $("#product_table").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0,'desc']],
        "columns":[
             {"data":"product_id"},
             {"data": "product_name","render":function(data, type, row, meta){
                       var str = '';
                       str += row.product_name;
                       return str;
                  }
             },
             {"data":"product_price"},
             {"data": "uploaded_file","render":function(data, type, row, meta){
                var str = '';
                str += '<img src="'+base_url+'upload/'+row.date_added+'/'+row.uploaded_file+'" height="50" width="50">';
                return str;
                }
             },    
             {"data": "product_id","render":function(data, type, row, meta){
                var str = '';
                str += '<div class="btn-group">';
                       if(row.status == '1'){
                            str += '<a href="" class="btn btn-warning btn-sm user_action_status" data-id="'+row.product_id+'" data-status="0"><i class="fa fa-lock"></i> Deactivate</a>';
                       } else{
                            str += '<a href="" class="btn btn-success btn-sm user_action_status" data-id="'+row.product_id+'" data-status="1"><i class="fa fa-unlock"></i> Activate</a>';
                       }
                str += '<div class="btn-group">';
                     str += '<a href="" class="btn btn-danger btn-sm delete_product_action" data-id="'+row.product_id+'"><i class="fa fa-trash"></i></a>';
                     str += '<a href="" data-toggle="modal" data-target="#EditProduct" class="btn btn-primary btn-sm product_details_action" img-url="'+row.date_added+'|'+row.uploaded_file+'" data-id="'+row.product_id+'" data-product_name="'+row.product_name+'" data-product_price="'+row.product_price+'" data-product_image="'+row.uploaded_file+'"><i class="fa fa-edit"></i></a>';
                str += '</div>';
                return str;
           }
      },
        ],
        "ajax": {
             "url": base_url+"product/get_products",
             "type": "POST"
        },
        "columnDefs": [
             {
                  "targets": [],
                  "orderable": false,

              },
         ],
   });
   //<img src="<?php echo base_url().'uploads/'.$news_item['post_image'] ?>" class="img-responsive">

   $(document).on('click','.delete_product_action',function(e){
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
                    url:base_url+'product/delete',
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


     //    $(document).on('click','.user_action_status',function(e){
     //        e.preventDefault();
     //        var id = $(this).attr('data-id');
     //        var status = $(this).attr('data-status');
     //        Swal.fire({
     //            title: "Are you sure?",
     //            text: "This account will be deactivate",
     //            type: "warning",
     //            showCancelButton: true,
     //            confirmButtonColor: "#1A6519",
     //            confirmButtonText: "Yes",
     //        }).then((confirm) => {
     //                if (confirm.value) {
     //                    if(status == 1){
     //                        Swal.fire(
     //                            'Activated!',
     //                            'Your file has been active.',
     //                            'success'
     //                        )
     //                    }
     //                    if(status == 0){
     //                        Swal.fire(
     //                            'Deactivated!',
     //                            'Your file has been deactivate.',
     //                            'success'
     //                        )
     //                    }
     //                        $.ajax({
     //                            url:'user/deactivate_users',
     //                            type:'post',
     //                            //dataType:'json',
     //                            data: {
     //                                'id': id,
     //                                'status': status
     //                            },
     //                            success: function(res){
     //                                $.toast({
     //                                    heading: 'Deactivate Successfully',
     //                                    text: res.message,
     //                                    position: 'top-right',
     //                                    loaderBg: '#178472',
     //                                    icon: res.type,
     //                                    hideAfter: 2000,
     //                                    stack: 6
     //                                })
     //                                table_user.ajax.reload();
     //                            }
     //                        })
     //                }
     //        }); 
     //    });
        

        //if mo upload og pic using file upload e off ang content data and process data

        $(document).on('click','.product_details_action',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-product_name');
            var price = $(this).attr('data-product_price');
            var img_url = $(this).attr('img-url');
            let img = img_url.split('|');
            console.log(img);
            let img_html = `<img src="${base_url+'upload/'+img[0]+'/'+img[1]}" class="img-circle" height="75" width="75" />`;
            $('.append_img').html(img_html);
          //  var img_url = 
     

            $('input[name="product_id"]').val(id);
            $('input[name="product_name"]').val(name);
            $('input[name="product_price"]').val(price);
            $('.modal-title').html('Update User');
            $('.action-btn').html('Update');
        });
        //Edit User
        $('#EditProduct form').on('submit', function(e){
            e.preventDefault();
            const self = $(this);
            $.ajax({
                url: base_url+'product/edit_products',
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
                      $('#EditProduct').modal('hide');
                      table_user.ajax.reload();
                }
            });
        });

        //Add User
        $(document).on('submit', '#addForm' , function(e){
            e.preventDefault();
            //console.log(e);
            let formdata = new FormData($('#addForm')[0]);
           
            const self = $(this);
            $.ajax({
                url: base_url+'product/add_product',
                type: 'POST',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: formdata,
                success: function(res){
                    Swal.fire({
                        title: "Saved",
                        text: "Successfully Added",
                        type: "success",
                        //showCancelButton: true,
                        confirmButtonColor: "#1A6519",
                        confirmButtonText: "Yes",
                      });
                      $('#addProduct').modal('hide');
                      table_user.ajax.reload();
                }
            });
        });
});