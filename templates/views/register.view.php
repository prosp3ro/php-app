<?php require_once(PARTIALS . "/head.view.php"); ?>

<div>
    <form action="/register" method="POST">
        <div>
            <h1>Register</h1>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label for="password_repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="password_repeat" required>

            <br><br>
            <div>
                <button type="submit">Sign Up</button>
            </div>
        </div>
    </form>
</div>

<?php require_once(PARTIALS . "/footer.view.php"); ?>
