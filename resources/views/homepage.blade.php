<!DOCTYPE html>
<html lang="en">
<x-head :title="'QuizTech | Home'" />

<body>
    <x-nav-bar-main :user="$user" />

    <div class="login-box">

        <form>
            <div class="user-box">
                <input type="text" name="" required="">
                <label class="c-s">Qestion</label>
            </div>
            <div class="user-box">
                {{-- <input type="text" name="" required="">
            <label>Password</label> --}}
                <textarea name="" id="" cols="20" rows="1">
            </textarea>
                <label class="c-s">Answer</label>
            </div>
            <center>
                <a href="#" class="c-s">
                    SEND
                    <span></span>
                </a>
            </center>
        </form>
    </div>
</body>

</html>
