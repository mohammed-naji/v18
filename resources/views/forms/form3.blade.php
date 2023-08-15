<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* .btn-wrapper {
            position: relative;
        }

        .btn-send {
            position: absolute;
            right: 10px;
            bottom: 10px;
            opacity: .7;
        } */
    </style>
  </head>
  <body>

    <div class="container my-5">
        <h1>Full Form</h1>
        {{-- @dump($errors->any()) --}}
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <form action="{{ route('form3_data') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" placeholder="Name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" placeholder="Email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="no" value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                @error('dob')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Gender</label> <br>
                <input @checked(old('gender') == 'Male') type="radio" name="gender" id="male" value="Male">
                <label for="male">Male</label> <br>
                <label><input {{ old('gender') == 'Female' ? 'checked' : '' }} type="radio" name="gender" value="Female"> Female</label>
                @error('name')
                    <br><small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Education Level</label>
                <select class="form-select @error('education_level') is-invalid @enderror" name="education_level">
                    <option value="School" @selected(old('education_level') == 'School') >School</option>
                    <option value="Diploma" @selected(old('education_level') == 'Diploma') >Diploma</option>
                    <option value="Bachelor" @selected(old('education_level') == 'Bachelor') >Bachelor</option>
                    <option value="Master" @selected(old('education_level') == 'Master') >Master</option>
                    <option value="PhD" @selected(old('education_level') == 'PhD') >PhD</option>
                </select>
                @error('education_level')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- @dump(old('hobbies')??[]) --}}
            <div class="mb-3">
                <label>Hobbies</label> <br>
                <label><input type="checkbox" @checked(in_array('Codding', old('hobbies')??[])) name="hobbies[]" value="Codding"> Codding</label> <br>
                <label><input type="checkbox" @checked(in_array('Swimming', old('hobbies')??[])) name="hobbies[]" value="Swimming"> Swimming</label> <br>
                <label><input type="checkbox" @checked(in_array('Reading', old('hobbies')??[])) name="hobbies[]" value="Reading"> Reading</label> <br>
                <label><input type="checkbox" @checked(in_array('Dancing', old('hobbies')??[])) name="hobbies[]" value="Dancing"> Dancing</label> <br>
                @error('hobbies')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 btn-wrapper">
                <label>Bio</label>
                <textarea placeholder="Bio" name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4">{{ old('bio') }}</textarea>

                @error('bio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-success px-4 btn-send">Send</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
