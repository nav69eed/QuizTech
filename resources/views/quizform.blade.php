<!DOCTYPE html>
<html lang="en">
<x-head :title="'Create Quiz'" />

<body>
    <x-nav-bar-main :user="$user" />

    <div class="login-box">

        <form action=" {{route('quizform')}} " method="POST">
            @csrf
            <div class="user-box">
                <input type="text" name="name" required="">
                <label class="c-s">Quiz Name</label>
            </div>
            <div class="user-box">
                <textarea name="descp" id="" cols="20" rows="1">
            </textarea>
                <label class="c-s">Quiz Description</label>
            </div>
            <center>
                <a class="c-s">
                    <button class="btn" type="submit">Create</button>
                    <span></span>
                </a>
            </center>
        </form>
    </div>
</body>

</html>
