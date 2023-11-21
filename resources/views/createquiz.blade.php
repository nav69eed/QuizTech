<!DOCTYPE html>
<html lang="en">
<x-head :title="'Create Quiz'" />
<style>
    .hero1 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .login-box {
        display: flex;
        align-items: center;
        justify-content: center;
        position: static;
        transform: translate(0%, 0%);
    }
</style>

<body>
    <x-nav-bar-main :user="$user" />
    <div class="h2 c-a w-50 mx-auto mt-5">
        Quiz Name : <span class="c-s">{{ $quiz->title }}
        </span>
    </div>
    <p class="w-50 mx-auto">
        <span class="h4 c-a">Description:</span> {{ $quiz->description }}
    </p>
    <div class="hero1" style="min-height: 80vh;">
        @php $counter = 0 @endphp
        @forelse ($quiz->questions as $question)
            <div class="questions shadow-lg p-3 mt-3 ps-5">
                <p class="h5 c-a">
                    Q{{ ++$counter }} : {{ $question->ques }}
                </p>
                <p class="h6 ps-4 ans">
                    {{ $question->options[0]->ans }}
                </p>
            </div>
        @empty
            <div class="h5 c-a shadow-lg">
                No Question Yet
            </div>
        @endforelse


        <div class="form shadow-lg" style="position: relative;">
            <div class="login-box">

                <form action=" {{ route('createques') }} " method="POST">
                    @csrf
                    <div class="c-a h5">
                        Enter Question
                    </div>
                    <div class="user-box">
                        <input type="text" name="ques" required="">
                        <label class="c-s">Question</label>
                    </div>
                    <div class="user-box">
                        {{-- <textarea name="ans" id="" cols="20" rows="1">
                    </textarea> --}}
                        <input type="text" name="opt1" required="">
                        <label class="c-s">Option 1</label>
                        <div class="">
                            <input type="radio" name="correct_option" value="1"> Correct
                        </div>

                    </div>
                    <div class="user-box">
                        <input type="text" name="opt2" required="">
                        <label class="c-s">Option 2</label>
                        <div class="">
                            <input type="radio" name="correct_option" value="2"> Correct
                        </div>
                    </div>
                    <div class="user-box">
                        <input type="text" name="opt3" required="">
                        <label class="c-s">Option 3</label>
                        <div class="">
                            <input type="radio" name="correct_option" value="3"> Correct
                        </div>

                    </div>
                    <div class="user-box">
                        <input type="text" name="opt4" required="">
                        <label class="c-s">Option 4</label>
                        <div class="">
                            <input type="radio" name="correct_option" value="4"> Correct
                        </div>
                    </div>
                    <center>
                        <a class="c-s">
                            <button class="btn" type="submit">Create</button>
                            <span></span>
                        </a>
                    </center>
                </form>
            </div>
        </div>

    </div>
</body>
<style>
    .hero {
        /* position: relative; */
        max-height: 400px;
    }

    .questions {}

    .form {
        position: relative;
    }
</style>

</html>
