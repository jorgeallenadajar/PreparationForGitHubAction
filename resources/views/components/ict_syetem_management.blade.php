@extends('apps')


@section('section')
    <div class="pagetitle">
        <h1>Systems Management</h1>
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
                                <h5 class="card-title">Systems</h5>
                            </div>
                            <div class="col-8">
                            </div>
                            <div class="col-2">
                                <br>
                                <button type="button" id="add_btn" class="btn btn-success">Add System</button>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="sys_tbl" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Systems Name</th>
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



<div class="modal fade" id="add_system_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add System</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">System</label>
                        <input class="form-control" id="system" type="text">
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



<div class="modal fade" id="edit_system_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit System</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Category</label>
                        <input class="form-control" id="edit_system" type="text">
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

            $('#sys_tbl').DataTable({
                ajax: {
                    url: "{{ route('get_system_data') }}",
                },
                columns: [{
                    data: "system"
                },
                {
                    data: "action"
                }]


            });





            $('#add_btn').click(function () {
                $('#add_system_modal').modal('show');
            });

            $('#btn_save').click(function () {
                const system = $('#system').val();


                if (system == '') {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "All fields is required",
                        confirmButtonText: "Confirm",
                        timer: 3000,
                        timerProgressBar: true,
                        // willClose: () => {

                        //     // console.log("Hehe");
                        // }
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('add_system') }}",
                    type: "POST",
                    data: {
                        system: system
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

                    success: function (e) {
                        $('#system').val('');
                        Swal.fire({
                            title: "You added System!",
                            text: "You added System!",
                            icon: "success"
                        });
                        $('#add_system_modal').modal('hide');
                        $('#sys_tbl').DataTable().ajax.reload();
                    }
                })
            })


            $(document).on('click', '.btn_edit', function () {


                $('#edit_system_modal').modal('show');
                $('#edit_system').val($(this).data('system'));
                $('#edit_id').val($(this).data('id'))

            });
            $('#btn_edit').click(function () {
                const edit_system = $('#edit_system').val();
                const edit_id = $('#edit_id').val()

                if (edit_system == "") {
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
                    url: "{{ route('edit_system') }}",
                    type: "POST",
                    data: {
                        id: edit_id, system: edit_system,
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (e) {
                        Swal.fire({
                            title: "You Edited System!",
                            text: "You Edited System!",
                            icon: "success"
                        });
                        $('#edit_system_modal').modal('hide');
                        $('#sys_tbl').DataTable().ajax.reload();
                    }
                })
            });

            $(document).on('click', '.btn_delete', function () {
                const delete_id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure you want to delete this?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'delete_system/' + delete_id,
                            type: 'get',
                            success: function (e) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                $('#sys_tbl').DataTable().ajax.reload();

                            }
                        })

                    }
                });

            })




            //             {
            //     data: "get_systems",
            //     render: function(data, type, row) {
            //         // 'data' is the value for the current column (in this case, it's the 'get_systems' array)
            //         // 'type' is usually 'display' for rendering the content
            //         // 'row' is the entire object for the current row (in this case, it's the user object)

            //         return row.get_systems.map(system => system.system).join(", ");
            //     }
            // }


            // $('#example').DataTable({
            //     data: yourData, // assuming 'yourData' contains the JSON array
            //     columns: [
            //         {
            //             data: "id"
            //         },
            //         {
            //             data: "get_position",
            //             render: function (data, type, row) {
            //                 return row.get_position.position; // Access the 'position' from 'get_position'
            //             }
            //         }
            //     ]
            // });




        })



    </script>
@endsection