@extends('layouts.app')

@section('title', 'Edit Course | WebAcquire')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="p-0 m-0 ml-2">Edit Course</h1>
                <div class="card my-card p-0 m-0 mt-3 mb-5">
                        <div class="card-body">
                            <form action="{{ route('courses.update', $course->slug) }}" method="POST" id="edit-course-form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name of Course</label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $course->name) }}"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <strong style="font-size: 25px;">Course Description</strong>
                                    <textarea
                                        name="description"
                                        id="description"
                                        rows="6"
                                        class="form-control  @error('description') is-invalid @enderror" >{{old('description', $course->description)}}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group d-flex flex-row-reverse align-items-center ">
                                    <div class="custom-file m-2">
                                        <div class="input">
                                            <input type="file"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                id="customFile"
                                                name="image">
                                            <label class="custom-file-label" for="customFile">Choose Image</label>
                                        </div>
                                    </div>
                                    <div class="img m-2">
                                        <label for="image">Image</label>
                                        <img src="{{asset($course->image_path)}}"
                                             alt="course-image"
                                             width="220px"
                                             height="150px"
                                             class="shadow"
                                             id="image-preview">
                                    </div>
                                    @error('image')
                                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning" >Edit Changes</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
               </div>
         </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#edit-course-form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 40
                },
                description: {
                    required: true
                },
            },
            errorElement: 'p',
            errorPlacement: function(error, element) {
                if (error) {
                    error.insertAfter(element);
                    error.addClass('text-danger');
                }
            }
        });

    </script>
     <script>
        $(".custom-file-input").on("change", function() {
            var imageName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(imageName);
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFile").change(function(){
            readURL(this);
        });
    </script>
@endsection
