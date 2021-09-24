<div class="section row justify-content-center reveal" id="comment-now">
    <div class="col-md-12">
        <div class="d-flex flex-column align-items-center col-md-8">
            <span class="my-underline-2"></span>
            <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Comment Now</h2>
        </div>
        <div class="section card p-0 m-0 shadow-lg col-md-8">
                <div class="card-body">
                    <form action="{{ $video->url}}" method="POST" id="create-comment-form">
                        @csrf
                        <div class="form-group">
                            <strong class="sub-heading" style="font-size: 25px;">Enter Comment</strong>
                            <textarea
                                    name="description"
                                    id="description"
                                    rows="3"
                                    class="form-control  @error('description') is-invalid @enderror" >{{old('description')}}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            @error('body')
                                <div class="text-danger">{{ $message }}</div>
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

@section('scripts')
    <script>
        $("#create-comment-form").validate({
            rules: {
                description: {
                    required: true,
                    maxlength:120
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

        new MySmoothScroll(".scroll-to-comment-now");
        new RevealScroll($(".reveal"), "60%");
    </script>
@endsection
