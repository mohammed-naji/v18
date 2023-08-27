<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trashed Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

</head>
<body>

    <div class="container my-5">

        <h1 class="text-center mb-4">Trashed Courses</h1>

        <a href="{{ route('courses.index') }}" class="btn btn-primary mb-3
            "><i class="fas fa-laptop"></i> All Courses</a>

        <table class="table table-bordered table-hover table-striped">
            <tr class="table-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Deleted At</th>
                <th>Actions</th>
            </tr>

            @forelse ($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>

                <td>{{ $course->name }}</td>
                {{-- <td>{{ $course->created_at->format('M d, Y') }}</td> --}}
                <td>{{ $course->deleted_at->diffForHumans() }}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('courses.restore', $course->id) }}"><i class="fas fa-undo"></i></a>
                    <form class="d-inline" action="{{ route('courses.forcedelete', $course->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Are you sure (you can\'t rollback) ?!')" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button></form>
                </td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="4">No Trashed Courses</td>
            </tr>
            @endforelse

            {{-- @if ($courses->count() > 0)
                @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>

                    <td>{{ $course->name }}</td>
                    <td>{{ $course->deleted_at->diffForHumans() }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('courses.restore', $course->id) }}"><i class="fas fa-undo"></i></a>
                        <form class="d-inline" action="{{ route('courses.forcedelete', $course->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Are you sure (you can\'t rollback) ?!')" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button></form>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="4">No Trashed Courses</td>
                </tr>
            @endif --}}

        </table>

        {{ $courses->appends($_GET)->links() }}

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
