@extends('apps')


@section('section')


    <div class="pagetitle">
        <h1>User Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data</li>
            </ol>

        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <div class="row">
                            <div class="col-2">
                                <h5 class="card-title">Categories</h5>
                            </div>
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <br>
                                <button type="button" id="add_btn" class="btn btn-success">Add User</button>
                            </div>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <table id="user_tbl" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col"> Full Name</th>
                                        <th scope="col"> Company</th>
                                        <th scope="col"> Department</th>
                                        <th scope="col"> Position</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection



<div class="modal fade" id="add_user_modal" style="overflow:hidden;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <label>First Name</label>
                                <input type="text" class="form-control" id="fname">
                            </div>

                            <div class="col-6">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" id="mname">
                            </div>


                            <div class="col-6">
                                <label>Last Name</label>
                                <input type="text" class="form-control" id="lname">

                            </div>
                            <div class="col-6">
                                <label>Deparment</label>
                                <select class="form-control" id="department">

                                </select>
                            </div>

                            <div class="col-6">
                                <label>Postion</label>
                                <select class="form-control" id="position">

                                </select>
                            </div>
                            <div class="col-6">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email">

                            </div>

                            <div class="col-6">
                                <label>Username</label>
                                <input type="text" class="form-control" id="username">

                            </div>
                            <div class="col-6">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password">

                            </div>


                        </div>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn_save" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="edit_user_modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="edit_fname">
                        <input type="text" hidden class="form-control" id="edit_id">

                    </div>

                    <div class="col-6">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" id="edit_mname">
                    </div>

                    <div class="col-6">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="edit_lname">

                    </div>


                    <div class="col-6">
                        <label>Deparment</label>
                        <select class="form-control" id="edit_department">

                        </select>
                    </div>

                    <div class="col-6">
                        <label>Postion</label>
                        <select class="form-control" id="edit_position">

                        </select>
                    </div>

                    <div class="col-6">
                        <label>Email</label>
                        <input type="text" class="form-control" id="edit_email">

                    </div>

                    <div class="col-6">
                        <label>Username</label>
                        <input type="text" class="form-control" id="edit_username">

                    </div>

                    <div class="col-6">
                        <label>Password</label>
                        <input type="password" class="form-control" id="edit_password">

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn_edit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>






@section('script')
    <script>
        $(document).ready(function () {
            $('#add_btn').click(function () {
                $('#add_user_modal').modal('show')
            });


            $('#add_user_modal').on('shown.bs.modal', function () {
                $('#department').select2({
                    dropdownParent: $('#add_user_modal .modal-content'),
                    ajax: {
                        url: '{{ route('get_department') }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                searchTerm: params.term
                            };
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                });

                $('#position').select2({
                    dropdownParent: $('#add_user_modal .modal-content'),
                    ajax: {
                        url: '{{ route('get_position') }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                searchTerm: params.term
                            };
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                });
            });


            $('#user_tbl').DataTable({
                ajax: {
                    url: "{{ route('get_users') }}",
                },
                columns: [
                    {
                        data: "full_name"
                    },
                    {
                        data: "get_position",
                        render: function (data, type, row) {

                            return row.company.company;
                        }
                    },
                    {
                        data: "get_department",
                        render: function (data, type, row) {

                            return row.get_department.department;
                        }
                    },
                    {
                        data: "get_position",
                        render: function (data, type, row) {
                            return row.get_position.position;
                        }
                    },
                    {
                        data: "action"
                    }
                ]
            });


            $('#btn_save').click(function () {
                const fname = $('#fname').val();
                const mname = $('#mname').val();
                const lname = $('#lname').val();
                const department = $('#department').val();
                const position = $('#position').val();
                const email = $('#email').val();
                const username = $('#username').val();
                const password = $('#password').val();
                if (fname == '' || mname == '' || lname == '' || department == '' ||
                    position == '' || email == '' || username == '' || password == ''
                    || department == null || position == null
                ) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "All fields is required",
                        confirmButtonText: "Confirm",
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('add_users') }}",
                    type: "POST",
                    data: {
                        fname: fname, mname: mname, lname: lname,
                        dept_id: department, pos_id: position, email: email,
                        username: username, password: password
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (e) {
                        var json = JSON.parse(e);
                        if (json.status == 1) {
                            Swal.fire({
                                title: "You added User!",
                                text: "You added User!",
                                icon: "success"
                            });
                            $('#add_user_modal').modal('hide');
                            $('#user_tbl').DataTable().ajax.reload();
                            $('#fname').val('');
                            $('#mname').val('');
                            $('#lname').val('');
                            $('#department').val('');
                            $('#position').val('');
                            $('#email').val('');
                            $('#username').val('');
                            $('#password').val('');
                        }
                        else {
                            Swal.fire({
                                title: json.message,
                                text: json.message,
                                icon: "error"
                            });

                        }
                    }
                })



            })


            $('#edit_user_modal').on('shown.bs.modal', function () {

                $('#edit_department').select2({
                    dropdownParent: $('#edit_user_modal .modal-content'),
                    ajax: {
                        url: '{{ route('get_department') }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                searchTerm: params.term
                            };
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                });


                $('#edit_position').select2({
                    dropdownParent: $('#edit_user_modal .modal-content'),
                    ajax: {
                        url: '{{ route('get_position') }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                searchTerm: params.term
                            };
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                });
            });


            $(document).on('click', '.btn_edit', function () {
                const data_id = $(this).data('id');
                $('#edit_user_modal').modal('show');

                $.ajax({
                    url: "/retrieve_user/" + data_id,
                    type: 'GET',
                    success: function (e) {
                        json = JSON.parse(e);
                        const edit_position_data = [
                            {
                                id: json['get_position']['id'],
                                text: json['get_position']['position']
                            }
                        ];
                        const edit_department = [
                            {
                                id: json['get_department']['id'],
                                text: json['get_department']['department']
                            }
                        ];
                        $('#edit_fname').val(json['fname']);
                        $('#edit_mname').val(json['mname']);
                        $('#edit_lname').val(json['lname']);
                        $('#edit_email').val(json['email']);
                        $('#edit_username').val(json['username']);
                        $('#edit_password').val(json['orig_pass']);
                        $('#edit_id').val(data_id);
                        $('#edit_position').empty().select2({
                            data: edit_position_data,
                            placeholder: "Select a position",
                            allowClear: true,
                        }).val(json['get_position']['id']).trigger('change');
                        $('#edit_department').empty().select2({
                            data: edit_department,
                            placeholder: "Select a position",
                            allowClear: true,
                        }).val(json['get_department']['id']).trigger('change');


                    }



                })


            });


            $(document).on('click', '.btn_delete', function () {
                const delete_id = $(this).data('id');

                Swal.fire({
                    title: "Are you sure you want to delete this ?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "/delete_user/" + delete_id,
                            type: "GET",
                            success: function (e) {
                                $('#user_tbl').DataTable().ajax.reload();
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your user has been deleted.",
                                    icon: "success"
                                });
                            }
                        })
                    }
                });
            })


            $('#btn_edit').click(function () {
                const edit_fname = $('#edit_fname').val();
                const edit_mname = $('#edit_mname').val();
                const edit_lname = $('edit_lname').val();
                const edit_department = $('#edit_department').val();
                const edit_position = $('#edit_position').val();
                const edit_email = $('#edit_email').val();
                const edit_username = $('#edit_username').val();
                const edit_password = $('#edit_password').val();
                const edit_id = $('#edit_id').val();

                if (edit_fname == '' || edit_mname == '' || edit_lname == '' ||
                    edit_department == '' || edit_department == null || edit_position == '' ||
                    edit_position == null || edit_email == '' || edit_username == '' || edit_password == '') {

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "All fields is required",
                        confirmButtonText: "Confirm",
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    return;

                }

                $.ajax({
                    url: "{{ route('edit_users') }}",
                    type: "POST",
                    data: {
                        fname: edit_fname, mname: edit_mname, lname: edit_lname,
                        dept_id: edit_department, pos_id: edit_position, email: edit_email,
                        username: edit_username, password: edit_password, id: edit_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (e) {
                        var json = JSON.parse(e);
                        if (json.status == 1) {
                            $('#edit_user_modal').modal('hide');
                            $('#user_tbl').DataTable().ajax.reload();
                            Swal.fire({
                                title: "You Edit User!",
                                text: "You Edit User!",
                                icon: "success"
                            });
                        }
                        else {
                            Swal.fire({
                                title: json.message,
                                text: json.message,
                                icon: "error"
                            });
                        }
                    }
                })




            });


        })
    </script>

@endsection
<!-- validation sa password 8minimum and letters and numbers and back end front endsection -->