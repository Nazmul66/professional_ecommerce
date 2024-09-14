@extends('backend.layout.master')

@push('meta-title')
    Riho - Category Section
@endpush

@push('add-css')
     <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush


@section('body-content')

{{-- Breadcrumb section --}}
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
            <h4>Category Manage</h4>
            </div>
            
            <div class="col-6"> 
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">                                       
                            <svg style="color: #FFF;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1); "><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"></path></svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Category</li>
                </ol>
            </div>
        </div>
    </div>
</div>


{{-- Body content --}}
<div class="container-fluid">
    <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <div class="card_title">
                        <h4>All Category Tables</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_Modal">Create Category</button>
                    </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dashed" id="categoryTables">
                            <thead>
                                <tr>
                                    <th scope="col">SL. </th>
                                    <th scope="col">Category Image</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Status</th>
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
</div>


    {{-- Create Modal Form --}}
    <div class="modal fade" id="create_Modal" tabindex="-1" aria-labelledby="myExtraLargeModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Create Category</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body dark-modal"> 
                    <div class="card-body">
                        <div class="card-wrapper border rounded-3">
                            <form class="g-3" id="createForm" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="cat_name">Category Name</label>
                                            <input class="form-control" id="cat_name" name="cat_name" type="text" placeholder="Write here....">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="cat_image">Category Image</label>
                                            <input class="form-control" id="cat_image" name="cat_image" type="file">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-select btn-square digits" id="status" name="status">
                                        <option value="" disabled selected>Select your Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- Update Modal Form --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="myExtraLargeModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Update Category</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body dark-modal"> 
                    <div class="card-body">
                        <div class="card-wrapper border rounded-3">
                            <form class="g-3" id="updateForm" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="text" id="up_id" name="id" hidden>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="up_cat_name">Category Name</label>
                                            <input class="form-control" id="up_cat_name" name="cat_name" type="text" placeholder="Write here....">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="cat_image">Category Image</label>
                                            <input class="form-control" id="cat_image" name="cat_image" type="file">

                                            <div id="showImage"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="up_status">Status</label>
                                    <select class="form-select btn-square digits" id="up_status" name="status">
                                        <option value="" disabled selected>Select your Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection


@push('add-js')
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>

    <script>
    $(document).ready(function(){

    // show all data
    let categoryTables = $('#categoryTables').DataTable({
        order: [
            [0, 'asc']
        ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.get-category') }}",
        // pageLength: 30,

        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'cat_image'
            },
            {
                data: 'cat_name'
            },
            {
                data: 'status',
                orderable: false,
                searchable: false
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    //  Status updates
    $(document).on('click', '#status', function () {
        var id = $(this).data('id');
        var status = $(this).data('status');

        // console.log(id, status);

        $.ajax({
            type: "POST",
            url: "{{ route('admin.category.status') }}",
            data: {
                // '_token': token,
                id: id,
                status: status
            },
            success: function (res) {
                categoryTables.ajax.reload();

                if (res.status == 1) {
                    swal.fire(
                    {
                        title: 'Status Changed to Active',
                        icon: 'success'
                    })
                } else {
                    swal.fire(
                    {
                        title: 'Status Changed to Deactive',
                        icon: 'success'
                    })
                }
            },
            error: function (err) {
                console.log(err);
            }

        })
    })

    // Create
    $('#createForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.category.store') }}",
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res) {
                // console.log(res);
                if (res.status === true) {
                    $('#create_Modal').modal('hide');
                    $('#createForm')[0].reset();
                    categoryTables.ajax.reload();

                    swal.fire({
                        title: "Success",
                        text: `${res.message}`,
                        icon: "success"
                    })
                }
            },
            error: function (err) {
                console.error('Error:', err);
                swal.fire({
                    title: "Failed",
                    text: "Something Went Wrong !",
                    icon: "error"
                })
            }
        });
    })

    // Edit
    $(document).on("click", '#editButton', function (e) {
        let id = $(this).attr('data-id');
        // alert(id);

        $.ajax({
            type: 'GET',
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            url: "{{ url('admin/category') }}/" + id + "/edit",
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res) {
                let data = res.success;
                // console.log(data)

                $('#up_id').val(data.id);
                $('#up_cat_name').val(data.cat_name);
                $('#showImage').html('');
                $('#showImage').append(`
                    <img src={{ asset("`+ data.cat_image +`") }} alt="" style="width: 75px;">
                `);
                $('#up_status').val(data.status);
            },
            error: function (error) {
                console.log('error');
            }
        });
    })

    // Update
    $("#updateForm").submit(function (e) {
        e.preventDefault();

        let id = $('#up_id').val();
        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/category') }}/" + id,
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res) {

                swal.fire({
                    title: "Success",
                    text: "Category Edited",
                    icon: "success"
                })

                $('#editModal').modal('hide');
                $('#updateForm')[0].reset();
                categoryTables.ajax.reload();
            },
            error: function (err) {
                console.error('Error:', err);
                swal.fire({
                    title: "Failed",
                    text: "Something Went Wrong !",
                    icon: "error"
                })
            }
        });

    });

    // Delete
    $(document).on("click", "#deleteBtn", function () {
        let id = $(this).data('id')

        swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        })
        .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',

                    url: "{{ url('admin/category') }}/" + id,
                    data: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    },
                    success: function (res) {
                        Swal.fire({
                            title: "Deleted!",
                            text: `${res.message}`,
                            icon: "success"
                        });

                        categoryTables.ajax.reload();
                    },
                    error: function (err) {
                        console.log('error')
                    }
                })

            } else {
                swal.fire('Your Data is Safe');
            }
        })
    })
});

</script>

@endpush