@extends('apps')


@section('section')
    <div class="pagetitle">
        <h1>File Management</h1>
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
                                <h5 class="card-title">Files</h5>
                            </div>
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <br>
                                <button id="btn_add" class="btn btn-success">Add Files</button>

                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="tbl_file" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">File Name</th>
                                                <th scope="col">Uploaded By</th>
                                                <th scope="col">Categories</th>
                                                <th scope="col">Systems</th>
                                                <th scope="col">Remarks</th>


                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection





<!-- Modals -->


<div class="modal fade" id="add_file_modal" style="overflow:hidden;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <b>
                                        <label>Categories</label>
                                    </b>
                                    <select class="form-control" id="category">
                                        <!-- Options here -->
                                    </select>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <b>
                                        <label>Systems</label>
                                    </b>
                                    <select class="form-control" id="systems">
                                        <!-- Options here -->
                                    </select>
                                </div>
                            </div>
                            <br><br> <br><br>



                            <div class="col-12">
                                <b>
                                    <label>File</label>
                                </b>
                                <input type="file" id="files" name="filers[]" multiple>

                            </div>
                            <br><br> <br>

                            <div class="col-12">
                                <b>
                                    <label>Notes</label>
                                </b>
                                <textarea name="" class="form-control" id="remarks"></textarea>
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












@section('script')
    <script>
        $(document).ready(function () {
            $('#tbl_file').DataTable({

                ajax: {
                    url: "{{ route('get_files_data') }}",
                },
                columns: [
                    {
                        data: "action"
                    },

                    {
                        data: "uploader"
                    },
                    {
                        data: "get_category",
                        render: function (data, type, row) {

                            return row.get_category ? row.get_category.category : '';
                        }
                    },
                    {
                        data: "get_system",
                        render: function (data, type, row) {

                            return row.get_system ? row.get_system.system : '';
                        }
                    },
                    {
                        data: "remarks"
                    },

                ]
            });


            $('#btn_add').click(function () {
                $('#add_file_modal').modal('show');
                $('#add_file_modal').on('shown.bs.modal', function () {
                    $('#category').select2({
                        dropdownParent: $('#add_file_modal .modal-content'),
                        ajax: {
                            url: '{{ route('get_categories_data') }}',
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


                    $('#systems').select2({
                        dropdownParent: $('#add_file_modal .modal-content'),
                        ajax: {
                            url: '{{ route('get_systems_data') }}',
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
                    })

                });


                // $('#btn_save').click(function () {
                //     const category = $('#category').val();
                //     const systems = $('#systems').val();
                //     const files = $('#files')[0].files;  // Get the files array
                //     const remarks = $('#remarks').val();

                //     // Check if any required field is empty or if no files are selected
                //     if (category == null || systems == null || files.length == 0 || remarks == '') {
                //         Swal.fire({
                //             icon: "error",
                //             title: "Oops...",
                //             text: "All fields are required",
                //             confirmButtonText: "Confirm",
                //             timer: 3000,
                //             timerProgressBar: true,
                //         });
                //         return;
                //     }


                //     var forms = new FormData();
                //     const filerop = [];

                //     for (let i = 0; i < files.length; i++) {
                //         forms.append('filers[]', files[i]);
                //         filerop.push(files[i]);
                //     }


                //     forms.append('category_id', category);
                //     forms.append('system_id', systems);
                //     forms.append('remarks', remarks);


                //     $.ajax({
                //         url: "{{ route('upload_file') }}",
                //         type: "POST",
                //         processData: false,
                //         contentType: false,
                //         data: forms,
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         success: function (e) {


                //             Swal.fire({
                //                 title: "You added Files!",
                //                 text: "You added Files!",
                //                 icon: "success"
                //             });
                //             $('#add_file_modal').modal('hide');
                //             $('#tbl_file').DataTable().ajax.reload();

                //         },

                //     });
                // });





                $('#btn_save').click(function () {
                    var $btnSave = $(this);
                    $btnSave.prop('disabled', true);
                    const category = $('#category').val();
                    const systems = $('#systems').val();
                    const files = $('#files')[0].files;
                    const remarks = $('#remarks').val();
                    if (category == null || systems == null || files.length == 0 || remarks == '') {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "All fields are required",
                            confirmButtonText: "Confirm",
                            timer: 3000,
                            timerProgressBar: true,
                        });


                        $btnSave.prop('disabled', false);
                        return;
                    }


                    var forms = new FormData();
                    for (let i = 0; i < files.length; i++) {
                        forms.append('filers[]', files[i]);
                    }
                    forms.append('category_id', category);
                    forms.append('system_id', systems);
                    forms.append('remarks', remarks);


                    $.ajax({
                        url: "{{ route('upload_file') }}",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        data: forms,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function () {

                        },
                        success: function (response) {
                            Swal.fire({
                                title: "You added Files!",
                                text: "You added Files!",
                                icon: "success",
                                timer: 3000,
                                timerProgressBar: true,
                                willClose: () => {
                                    location.reload();
                                }
                            });



                        },
                        complete: function () {

                            $btnSave.prop('disabled', false);
                        }
                    });
                });




            });
        });
    </script>
@endsection