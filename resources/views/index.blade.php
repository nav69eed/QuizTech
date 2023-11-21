<!DOCTYPE html>
<html lang="en">
<x-head :title="'QuizTech'" />

<body>
    <x-nav-bar />
    <div class="hero">
        <div class="">
            <p class="h2 c-s fw-bold">
                Welcome to <span class="c-a">QuizTech</span> <br>
                Please select on to proceed further
            </p>
        </div>
        <div class="buttons mt-3">
            <x-button-main :title="'Teacher'" :adress="'/login'" />
            <x-button-main :title="'Student'" :adress="'/login'" />

        </div>

        <div class="text-intro mt-4">
            <p>

                Welcome to <span class="c-a">QuizTech</span>, where learning meets excitement in the digital age! 🚀
                Our innovative quiz app is designed
                to <span class="c-a">revolutionize </span>the way you engage with information, making the learning
                <span class="c-a">experience</span> not only <span class="c-a">educational </span>but
                also incredibly fun.
            </p>
        </div>
    </div>
</body>

</html>
