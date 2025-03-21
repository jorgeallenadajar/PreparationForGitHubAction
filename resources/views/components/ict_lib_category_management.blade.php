@extends('apps')


@section('section')
    <div class="pagetitle">
        <h1>Categories Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data</li>
            </ol>

        </nav>
    </div>
    <!-- End Page Title -->
    <!-- <style>
            .alert-small {
                font-size: 12px;
                padding: 2px 6px;
            }
        </style> -->

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
                                <button type="button" id="add_btn" class="btn btn-success">Add Category</button>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="cat_tbl" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Category Name</th>
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



<div class="modal fade" id="add_category_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Category</label>
                        <input class="form-control" id="category" name="category" type="text">
                        <div class="alert alert-danger alert-small" hidden id="error_category">

                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <label for="">Sample</label>
                        <input class="form-control" id="sample" name="sample" type="text">
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn_save" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="edit_category_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Category</label>
                        <input class="form-control" id="edit_category" type="text">
                        <input class="form-control" hidden id="edit_id" type="text">

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
            $('#cat_tbl').DataTable(
                {
                    // pageLength: 1,
                    // language: {
                    //     oPaginate: {
                    //         sNext: '<i class="bi bi-arrow-right"></i>',
                    //         sPrevious: '<i class="bi bi-arrow-left"></i>',
                    //         sFirst: '<i class="bi bi-arrow-left"></i>',
                    //         sLast: '<i class="bi bi-arrow-right"></i>'
                    //     }
                    // },

                    ajax: {
                        url: "{{ route('categories_data') }}"
                    },
                    columns: [
                        {
                            data: "category"
                        },
                        {
                            data: "action"
                        }
                    ]
                }
            );


            $('#add_btn').click(function () {
                $('#add_category_modal').modal('show');
            });

            $('#btn_save').click(function () {
                const category = $('#category').val();
                $.ajax({
                    url: "{{ route('add_category') }}",
                    type: "POST",
                    data: {
                        category,
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (e) {
                        // var firstKey = Object.keys(e.errors)[0];
                        // var firstErrorMessage = e.errors[firstKey][0];
                        // console.log("First error field (key):", firstKey);
                        // console.log("First error message:", firstErrorMessage);
                        // console.log("First error field (key):", firstKey);
                        // console.log("First error message:", firstErrorMessage);
                        //     $.each(e['errors'], function (key, value) {
                        //         $('#' + key).addClass('is-invalid').val(value);
                        //     });
                        //     return false;
                        // }
                        if (e['errors']) {
                            var key_object = Object.keys(e.errors)[0];
                            var message = e.errors[key_object][0];
                            console.log(key_object)
                            // $('#error_' + key_object).attr('hidden', false).text(message);
                            // $('#' + key_object).addClass('is-invalid').val(message)
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: message,
                                confirmButtonText: "Confirm",
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            return false;
                        }


                        Swal.fire({
                            title: e['success'],
                            text: e['success'],
                            icon: "success"
                        });

                        $('#add_category_modal').modal('hide');
                        $('#cat_tbl').DataTable().ajax.reload();
                        $('#category').val('');

                    },
                })
            })


            $(document).on('click', '.btn_edit', function () {
                $('#edit_category_modal').modal('show')
                $('#edit_id').val($(this).data('id'))
                $('#edit_category').val($(this).data('category'))

            })

            $('#btn_edit').click(function () {
                const update_category = $('#edit_category').val();
                const edit_id = $('#edit_id').val();
                if (category == '') {
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
                    url: "{{ route('edit_category') }}",
                    type: "POST",
                    data: {
                        category: update_category,
                        id: edit_id
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (e) {
                        if (e['errors']) {
                            var key_object = Object.keys(e.errors)[0];
                            var message = e.errors[key_object][0];
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: message,
                                confirmButtonText: "Confirm",
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            return false;
                        }

                        $('#edit_category_modal').modal('hide');
                        $('#cat_tbl').DataTable().ajax.reload();
                        Swal.fire({
                            title: e['success'],
                            text: e['success'],
                            icon: "success"
                        });
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
                            url: 'delete_category/' + delete_id,
                            type: 'GET',
                            success: function (e) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                $('#cat_tbl').DataTable().ajax.reload();
                            }
                        })
                    }
                });

            })



            // try natin mag server side sa data ng category para kahit 3million yung data kaya mabilis sya magloading
        })
    </script>
@endsection