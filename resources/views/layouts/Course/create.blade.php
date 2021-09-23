@extends('layouts.app')

@section('title', 'Add Course | WebAcquire')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="p-0 m-0 ml-2">Add Course</h1>
                <div class="card my-card p-0 m-0 mt-3 mb-5">
                        <div class="card-body">
                            <form action="{{ route('courses.store') }}" method="POST" id="create-course-form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name of Course</label>

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
                                    <strong style="font-size: 25px;">Course Description</strong>
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
                                    <label for="name">Image</label>
                                    <div class="custom-file">
                                        <input type="file"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                id="customFile"
                                                name="image">
                                        <label class="custom-file-label" for="customFile">Choose Image</label>
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
    </div>
@endsection

@section('scripts')
    <script>
        $("#create-course-form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 40
                },
                description: {
                    required: true
                },
                image: {
                    required: true,
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
@endsection
