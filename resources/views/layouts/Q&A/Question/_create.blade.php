<div class="section row justify-content-center reveal" id="ask-question">
    <div class="col-md-12">
        <div class="d-flex flex-column align-items-center">
            <span class="my-underline-2"></span>
            <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Ask Question</h2>
        </div>
        <div class="section card my-card p-0 m-0 mb-5">
            <div class=""></div>
                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="POST" id="create-question-form">
                        @csrf
                        <div class="form-group">
                            <strong class="sub-heading" style="font-size: 25px;">Title</strong>
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
                            <strong class="sub-heading" style="font-size: 25px;">Enter Question</strong>
                            <input
                                type="hidden"
                                id="body"
                                name="body"
                                value="{{ old('body') }}">

                            <trix-editor
                                input="body"
                                class="form-control  @error('body') is-invalid @enderror " >
                            </trix-editor>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $("#create-question-form").validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 60
                },
                body: {
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
        window.addEventListener("trix-file-accept", function(event) {
        event.preventDefault()
        alert("File attachment not supported!")
    })
        let trixHeadingTag = $('.trix-button--icon-heading-1');
        trixHeadingTag.attr('data-trix-attribute', '');
        trixHeadingTag.attr('title', 'disabled');
        trixHeadingTag.attr('id', 'not-allowed');

    </script>
    <script>
        new MySmoothScroll("#scroll-to-ask-question");
        new RevealScroll($(".reveal"), "60%");
     </script>

    <script>
            function displayModalToDeleteQuestion(questionId) {
                console.log(questionId);
                var url = "/qna/questions/" + questionId;
                $("#deleteQuestionForm").attr('action', url);
            }
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
