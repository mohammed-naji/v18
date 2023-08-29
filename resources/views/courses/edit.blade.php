<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

</head>
<body>

    <div class="container my-5">

        <h1 class="text-center mb-4">Edit Course</h1>

        <a href="{{ route('courses.index') }}" class="btn btn-primary mb-3
            "><i class="fas fa-laptop"></i> All Courses</a>
        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $course->name) }}">
                @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
                <img width="100" src="{{ asset('images/'.$course->image) }}" alt="">
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="4">{{ old('content', $course->content) }}</textarea>
                @error('content')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $course->price) }}">
                @error('price')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Hours</label>
                <input type="number" name="hours" class="form-control @error('hours') is-invalid @enderror" value="{{ old('hours', $course->hours) }}">
                @error('hours')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-info px-4"><i class="fas fa-save"></i> Update</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
