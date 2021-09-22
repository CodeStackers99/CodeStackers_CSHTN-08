<div class="row justify-content-center reveal" id="answer-question">
    <div class="col-md-12">
        <div class="d-flex flex-column align-items-center">
            <span class="my-underline-2"></span>
            <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Your Answer</h2>
        </div>
        <div class="section card my-card p-0">
            <div class="card-body">
                <form action="{{route('questions.answers.store', $question->id)}}" method="POST" id="create-answer-form">
                    @csrf
                    <div class="form-group">
                        <input
                            type="hidden"
                            id="body"
                            name="body"
                            value="{{ old('body') }}">
                        <trix-editor input="body" class="form-control  @error('body') is-invalid @enderror" ></trix-editor>
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
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $("#create-answer-form").validate({
            rules: {
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
            event.preventDefault();
            alert("File attachment not supported!");
    })
        let trixHeadingTag = $('.trix-button--icon-heading-1');
        trixHeadingTag.attr('data-trix-attribute', '');
        trixHeadingTag.attr('title', 'disabled');
        trixHeadingTag.attr('id', 'not-allowed');

    </script>
    <script>
        new MySmoothScroll("#scroll-to-answer-question");
        new MySmoothScroll("#scroll-to-answer-question-by-no-answer-found");
        new MySmoothScroll("#scroll-to-answers");
        new RevealScroll($(".reveal"), "60%");
    </script>

    <script>
            function displayModalToDeleteAnswer(questionId, answerId) {
                console.log(answerId);
                var url = "/qna/questions/"+questionId+"/answers/" + answerId;
                console.log(url);
                $("#deleteAnswerForm").attr('action', url);
            }
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
