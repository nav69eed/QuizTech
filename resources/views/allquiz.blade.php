<!DOCTYPE html>
<html lang="en">
<x-head :title="'QuizTech | ALL QUIZZES'" />

<body>
    <x-nav-bar-main :user="$user" />
    @forelse ($quizzes as $quiz)
        <div class="mx-auto my-3 p-4 shadow  h6 quizdiv position-relative">
            <p class="c-a">
                Quiz Name : <strong class="c-s">{{ $quiz->title }}</strong>
            </p>
            <p class="">
                <span class="c-a h6">Description :- </span>{{ $quiz->description }}
            </p>
            <a href="{{ route('squiz', ['id' => $quiz->id]) }}">
                <x-start-button />
            </a>
        </div>
    @empty
        <div class="my-3 p-4 shadow c-s">
            No Quiz Yet
        </div>
    @endforelse
</body>

</html>
