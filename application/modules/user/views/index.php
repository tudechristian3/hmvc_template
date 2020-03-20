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
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus-circle"></i> Create New</button>
                    </div>
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                    </div>
                </div>
            
                
                        <div class="card">
                            <div class="card-body">
                                    <table class="table" id="user_table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                            </div>
                        </div>        

            <!-- Modal -->
            <div id="addEmployee" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered animated bounceIn">
                    <div class="modal-content">
                        <form action="<?php base_url('user/user') ?>" method="post" novalidate>
                            <input type="hidden" class="form-control" name="user_id" value="">
                            <div class="modal-header">
                                <h4 class="modal-title" id="vcenter">Add New Employee</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <p class="m-0">Name</p>
                                    <input type="text" class="form-control m-t-5" name="name" data-validation-required-message="This field is required" required>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <p class="m-0">Username</p>
                                    <input type="text" class="form-control m-t-5" name="username" data-validation-required-message="This field is required" required>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <p class="m-0">Password</p>
                                    <input type="password" class="form-control m-t-5" name="password" data-validation-required-message="This field is required" required>
                                    <div class="help-block"></div>
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
             <div id="addUser" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered animated bounceIn">
                    <div class="modal-content">
                        <form action="<?php base_url('user/insertuser') ?>" method="post" novalidate>
                            <input type="hidden" class="form-control" name="user_id" value="">
                            <div class="modal-header">
                                <h4 class="modal-title" id="vcenter">Add New Employee</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <p class="m-0">Name</p>
                                    <input type="text" class="form-control m-t-5" name="name" data-validation-required-message="This field is required" required>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <p class="m-0">Username</p>
                                    <input type="text" class="form-control m-t-5" name="username" data-validation-required-message="This field is required" required>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <p class="m-0">Password</p>
                                    <input type="password" class="form-control m-t-5" name="password" data-validation-required-message="This field is required" required>
                                    <div class="help-block"></div>
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