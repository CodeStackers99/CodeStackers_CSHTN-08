@extends('layouts.app')

@section('title', 'Add Playlist | WebAcquire')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Add Playlist</h2>
                </div>
                <div class="card my-card p-0 m-0 mt-3 mb-5">
                        <div class="card-body">
                            <form action="{{ route('courses.subcourses.playlists.store', [$course->slug , $subCourse->slug]) }}" method="POST" id="create-playlist-form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <strong class="text-hblack">Title</strong>
                                    <input
                                        type="text"
                                        id="title"
                                        name="title"
                                        value="{{ old('title') }}"
                                        class="form-control  @error('title') is-invalid @enderror">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <strong class="text-hblack">Description</strong>
                                    <textarea
                                        name="description"
                                        id="description"
                                        rows="6"
                                        class="form-control  @error('description') is-invalid @enderror" >{{old('description')}}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <strong class="text-hblack">No. of hours</strong>
                                    <input
                                        type="number"
                                        name="hours"
                                        id="hours"
                                        rows="6"
                                        class="form-control  @error('hours') is-invalid @enderror"
                                        value="{{old('hours')}}" >
                                    @error('hours')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <strong class="text-hblack">Poster Image</strong>
                                    <div class="custom-file">
                                        <input type="file"
                                                class="custom-file-input @error('display_image') is-invalid @enderror"
                                                id="customFile"
                                                name="display_image">
                                        <label class="custom-file-label" for="customFile">Choose Image</label>
                                    </div>
                                    @error('display_image')
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
        $("#create-playlist-form").validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 40
                },
                description: {
                    required: true
                },
                hours: {
                    required:true,
                    number: true
                },
                display_image: {
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
