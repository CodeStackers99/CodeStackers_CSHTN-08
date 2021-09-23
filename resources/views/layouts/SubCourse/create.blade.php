@extends('layouts.app')

@section('title', 'Add Subcourse | WebAcquire')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Add Subcourse</h2>
                </div>
                <div class="card my-card p-0 m-0 mt-3 mb-5">
                    <div class="card-body">
                        <form action="{{ route('courses.subcourses.store', $course->slug) }}"
                                method="POST"
                                id="add-subcourse-form"
                                enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <strong class="text-hblack">Name of Subcourse</strong>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control  @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <strong class="text-hblack">Subcourse Description</strong>
                                <textarea
                                    name="description"
                                    id="description"
                                    rows="6"
                                    class="form-control  @error('description') is-invalid @enderror" >{{old('description')}}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <div class="custom-file">
                                    <div class="input">
                                        <input type="file"
                                            class="custom-file-input @error('image') is-invalid @enderror"
                                            id="customFile"
                                            name="image">
                                        <label class="custom-file-label" for="customFile">Choose Image</label>
                                    </div>
                                </div>
                                @error('image')
                                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#add-subcourse-form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 40
                },
                description: {
                    required: true
                },
                image: {
                    required: true
                }
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
