<div class=" section d-flex flex-row justify-content-center align-items-center section-divider">
    <div class="text">
        <h2><strong class="text-hblack text-capitalize text-center sub-heading">No answers yet :(</strong></h2>
        <p class="text-muted text-center">Be the first to answer.</p>
        <div class="button text-center">
            <a
                href="@auth #answer-question @else {{ route('login') }}@endauth"
                id="scroll-to-answer-question-by-no-answer-found"
                class="styled-btn styled-rounded text-muted border border-dark p-1" style="text-decoration:none">
                <span class="styled-button-text">Answer Now</span>
            </a>
        </div>
    </div>
    <img src="{{asset('images/others/not_found.png')}}" alt="No-Results-Found" class="no-result-found-img">
</div>
