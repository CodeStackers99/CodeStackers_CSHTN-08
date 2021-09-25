<div class=" section d-flex flex-row justify-content-center align-items-center section-divider">
    <div class="text">
        <h2><strong class="text-hblack text-capitalize text-center sub-heading">No Previously Attempted Quiz found :(</strong></h2>
        <div class="button text-center">
            <a
                href="{{ route('quiz.start') }}"
                id="scroll-to-answer-question-by-no-answer-found"
                class="styled-btn styled-rounded text-muted border border-dark p-2" style="text-decoration:none">
                <span class="styled-button-text">Take A Quiz</span>
            </a>
        </div>
    </div>
    <img src="{{asset('images/others/not_found.png')}}" alt="No-Results-Found" class="no-result-found-img">
</div>
