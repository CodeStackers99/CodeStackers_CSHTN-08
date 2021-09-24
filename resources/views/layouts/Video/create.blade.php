@extends('layouts.app')

@section('title', 'Add Video to ' . $playlist->title. ' | WebAcquire')

@section('content')
    <div class="container">
        <div class="justify-content-center section">
            <div class="col-md-10">
                <div class="d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Add Video to {{$playlist->title}} Playlist</h2>
                </div>
                <div class="card my-card p-0 m-0 mt-3 mb-5">
                        <div class="card-body">
                            <form action="{{ route('courses.subcourses.playlists.videos.store', [$course->slug , $subCourse->slug, $playlist->slug]) }}" method="POST" id="create-playlist-form" enctype="multipart/form-data">
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
                                <div class="form-group ">
                                    <strong class="text-hblack">Poster Image</strong>
                                    <div class="custom-file">
                                        <input type="file"
                                                class="custom-file-input @error('display_image') is-invalid @enderror"
                                                id="customFile"
                                                name="display_image">
                                        <label class="custom-file-label" for="customFile">Choose image</label>
                                    </div>
                                    @error('display_image')
                                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    <strong class="text-hblack">Add Video</strong>
                                    <div class="custom-file">
                                        <input type="file"
                                                class="custom-file-input @error('video') is-invalid @enderror"
                                                id="customFile"
                                                name="video">
                                        <label class="custom-file-label" for="customFile">Choose Video</label>
                                    </div>
                                    @error('video')
                                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Tags">Tags</label>
                                    <select name="tags[]" id="tags" class="form-control select2" multiple>
                                        <option></option>
                                        @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}"
                                                {{ (old('tags') && (in_array($tag->id, old('tags'))) ? 'selected' : '')}}>{{$tag->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tags')
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
                video: {
                    required: true,
                },
                display_image: {
                    required:true
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

        $('.select2').select2({
            placeholder: 'Select an option',
            allowClear: true
        });
    </script>

@endsection
