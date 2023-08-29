<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <style>
        .search-wrapper {
            position: relative;
        }

        .search-wrapper i {
            position: absolute;
            right: 25px;
            top: 11px;
            color: #b2b2b2
        }
    </style>
</head>
<body>

    <div class="container my-5">

        {{-- fas = fa-solid => solid
        far fa-regular => regular
        fab fa-brand => brand

        fa-heart --}}
        {{-- <i class="fa-solid fa-trash"></i>
        <i style="color: red" class="fas fa-heart"></i>
        <i class="far fa-heart"></i> --}}

        {{-- <i class="fab fa-twitter"></i> --}}

        <h1 class="text-center mb-4">All Courses</h1>

        @if (session('msg'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show">
            {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <div class="d-flex justify-content-between">
            <a href="{{ route('courses.trash') }}" class="btn btn-danger mb-3"><i class="fas fa-trash"></i> Trashed Courses</a>
            <a href="{{ route('courses.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add new Course</a>
        </div>

            <form class="mx-2" action="{{ route('courses.index') }}" method="GET">
                @if (request()->has('page'))
                    <input type="hidden" name="page" value="{{ request()->page }}">
                @endif

                <div class="row">
                    <div class="col-8 search-wrapper">
                        <input type="text" name="q" class="form-control" placeholder="Search About Any Course.." value="{{ request()->q }}">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="col-3">
                        <div class="d-flex align-items-center mb-2">
                            <select name="column" class="form-select w-50">
                                <option @selected(request()->column == 'id') value="id">ID</option>
                                <option @selected(request()->column == 'name') value="name">Name</option>
                                <option @selected(request()->column == 'price') value="price">Price</option>
                                <option @selected(request()->column == 'created_at') value="created_at">Created At</option>
                            </select>
                            <select name="type" class="form-select w-50 mx-2">
                                <option @selected(request()->type == 'asc') value="asc">ASC</option>
                                <option @selected(request()->type == 'desc') value="desc">DESC</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>


            </form>


        <table class="table table-bordered table-hover table-striped">
            <tr class="table-dark">
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Hours</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            @foreach ($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td><img width="100" src="{{ asset('images/'.$course->image) }}" alt=""></td>
                <td>{{ $course->name }}</td>
                <td>${{ $course->price }}</td>
                <td>{{ $course->hours }}</td>
                <td>{!! $course->status ? '<span class="badge bg-success">Open</span>' : '<span class="badge bg-danger">Closed</span>' !!}</td>
                <td>{{ $course->created_at->format('M d, Y') }}</td>
                <td>{{ $course->updated_at->diffForHumans() }}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('courses.edit', $course->id) }}"><i class="fas fa-edit"></i></a>
                    {{-- <a class="btn btn-sm btn-danger" href="{{ route('courses.destroy', $course->id) }}"><i class="fas fa-trash"></i></a> --}}
                    <form class="d-inline" action="{{ route('courses.destroy', $course->id) }}" method="post">
                        @csrf
                        @method('delete')
                        {{-- <button onclick="return confirm('Are you sure?!')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button> --}}
                        <button type="button" onclick="deleteCourse(event)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        {{ $courses->appends($_GET)->links() }}

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if (session('msg'))
            Toast.fire({
            icon: '{{ session("type") }}',
            title: '{{ session("msg") }}'
            })
        @endif


        if($('.alert').length != 0) {
            setTimeout(() => {
                // $('.alert').slideUp();
                console.log('Done');
                $('.alert').fadeOut();
            }, 3000);
        }


    </script>



    <script>
        function deleteCourse(e) {
            // console.log(hamada.target.parentElement);
            // console.log(e.target.closest('form'));
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )
                }
            })
        }
    </script>
</body>
</html>
