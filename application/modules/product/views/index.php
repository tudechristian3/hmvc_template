<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Dashboard 1</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard 1</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center text-right d-none d-md-block">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addProduct"><i class="fa fa-plus-circle"></i> Create New</button>
                    </div>
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                    </div>
                </div>
            
                
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="product_table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                   
            </div>

            <!--Modal-->
            <div id="EditProduct" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered animated bounceIn">
                    <div class="modal-content">
                        <form id="editForm" method="post" enctype="multipart/form-data" novalidate>
                            <input type="hidden" class="form-control" name="product_id" value="">
                            <div class="modal-header">
                                <h4 class="modal-title" id="vcenter">Add New Product</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12"> 
                                <center class="m-t-30 append_img">
                                    <!-- <img src="" class="img-circle" name="imagefile" width="150" /> -->
                                </center>    
                                </div>
                                <div class="col-md-12">  
                                    <div class="form-group">
                                        <p class="m-0">Product Name</p>
                                        <input type="text" class="form-control m-t-5" name="product_name" data-validation-required-message="This field is required" required>
                                        <div class="help-block"></div>
                                    </div>
                                </div>    
                                <div class="col-md-12">  
                                    <div class="form-group">
                                        <p class="m-0">Product Price</p>
                                        <input type="text" class="form-control m-t-5" name="product_price" data-validation-required-message="This field is required" required>
                                        <div class="help-block"></div>
                                    </div>
                                </div>    
                                <div class="m-t-30 text-right">
                                    <button type="submit" class="btn btn-info waves-effect action-btn">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div id="addProduct" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered animated bounceIn">
                    <div class="modal-content">
                        <form id="addForm" method="post" enctype="multipart/form-data" novalidate>
                            <input type="hidden" class="form-control" name="employee_id" value="">
                            <div class="modal-header">
                                <h4 class="modal-title" id="vcenter">Add New Product</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file" id="input-file-now" name="imagefile" class="dropify" />
                                    </div>
                                </div>
                                <div class="col-md-12">  
                                    <div class="form-group">
                                        <p class="m-0">Product Name</p>
                                        <input type="text" class="form-control m-t-5" name="product_name" data-validation-required-message="This field is required" required>
                                        <div class="help-block"></div>
                                    </div>
                                </div>    
                                <div class="col-md-12">  
                                    <div class="form-group">
                                        <p class="m-0">Product Price</p>
                                        <input type="text" class="form-control m-t-5" name="product_price" data-validation-required-message="This field is required" required>
                                        <div class="help-block"></div>
                                    </div>
                                </div>    
                                <div class="m-t-30 text-right">
                                    <button type="submit" class="btn btn-info waves-effect action-btn">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
            <footer class="footer">
                © 2019 Admin Wrap Admin by themedesigner.in
            </footer>
    </div>