<!DOCTYPE html>
<html lang="en">
<x-head :title="'QuizTech'" />
<style>
    .login-box {
        display: flex;
        align-items: center;
        justify-content: center;
        position: static;
        transform: translate(0%, 0%);
    }

    .quizBox {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .radio-options {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .radio-options label {
        display: block;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }

    .radio-options input[type="radio"] {
        display: none;
    }

    .radio-options input[type="radio"]:checked+label {
        background-color: #007BFF;
        color: #fff;
        border-color: #007BFF;
    }
</style>

<body>
    <x-nav-bar-main :user="$user" />
    @if (!Session::has('response'))
        <div class="mx-auto my-3 p-4 shadow  h6 quizdiv position-relative" id="quiztitle">
            <p class="c-a">
                Quiz Name : <strong class="c-s">{{ $quiz->title }}</strong>
            </p>
            <p class="">
                <span class="c-a h6">Description :- </span>{{ $quiz->description }}
            </p>
            <a id="quizstartbtn">
                <x-start-button />
            </a>
        </div>
    @endif
    <div class="quizBox">
        <div class="" id="quiz">
            <form action="{{ route('quizsubmit', ['id' => $quiz->id]) }}" method="POST">
                @csrf
                @forelse ($quiz->questions as $question)
                    @if (Session::has('response'))
                        @php
                            $outer = 0;
                            $response = Session::get('response');
                        @endphp

                        @if ($response && count($response) > $outer && \Illuminate\Support\Str::startsWith($response[$outer], 'Correct'))
                            <div class="alert alert-success py-1 mt-4">
                                Correct Answer !!!
                            </div>
                        @else
                            <div class="alert alert-danger py-1 mt-4">
                                Wrong Answer !!!
                            </div>
                        @endif
                        @php
                            $outer++;
                        @endphp
                    @endif

                    @php
                        $index = 0;
                    @endphp
                    <div class="form-check mt-4">
                        {{ $question->ques }}
                    </div>
                    @while ($index < 4)
                        <div class="form-check">
                            <input type="radio" class="form-check-input"
                                id="radio{{ $question->id }}_{{ $index }}" name="{{ $question->id }}"
                                value="{{ $question->options[$index]->opt }}">

                            <label class="form-check-label"
                                for="radio{{ $question->id }}_{{ $index }}">{{ $question->options[$index]->opt }}</label>
                        </div>
                        @php
                            $index++;
                        @endphp
                    @endwhile

                @empty
                    <p>No questions available.</p>
                @endforelse

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</body>
<script>
    btn = document.getElementById('quizstartbtn');
    quiztitle = document.getElementById('quiztitle');
    quiz = document.getElementById('quiz');
    // Corrected code
    var radio = document.querySelectorAll('input[type="radio"]');
    @php
        $sessionData = Session::get('inpt');
    @endphp
    var sessionData = {!! json_encode($sessionData) !!};
    quiz.style.display = 'none';
    @if (Session::has('response'))
        // console.log(radio);
        quiz.style.display = 'flex';
        radio.forEach(radioButton => {
            if (radioButton.value === sessionData[radioButton.name]) {
                radioButton.checked = true;
            }
            radioButton.disabled = true;
        });
    @endif
    btn.addEventListener('click', () => {
        quiz.style.display = 'flex';
        quiztitle.style.display = 'none';
    });
</script>

</html>
