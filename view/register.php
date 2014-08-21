<div class="hero-unit" id="register-form">
    <div class="container" style="width:500px;">
        <form method="POST" action="" class="form-signin">
            <h2 class="form-signin-heading">Rejestracja</h2>
            <?php
            if($error){
                echo '<div class="alert alert-error">'.$error.'</div>';
            }
            ?>
            <div class="control-group ">
                <label class="control-label" for="name">Login:</label>
                <div class="controls">
                    <input class="input-block-level" type='text' name='name' id='name' placeholder="Login" pattern="[A-Za-z1-9]{1,20}" autofocus>
                    <span class="help-inline">Username is already taken</span>
                </div>
            </div>

            <div class="control-group ">
                <label class="control-label" for="password">Hasło:</label>
                <div class="controls">
                    <input class="input-block-level" type='password' id='password' name='pass' placeholder="Hasło" pattern=".{6,30}"   min="1" max="5" required>
                    <span class="help-inline">Username is already taken</span>
                </div>
            </div>

            <div class="control-group ">
                <label class="control-label" for="password-repeat">Powtórz hasło:</label>
                <div class="controls">
                    <input class="input-block-level" type='password' id='password-repeat' name='pass_repeat' pattern=".{6,30}" placeholder="Powtórz hasło" required>
                    <span class="help-inline">Username is already taken</span>
                </div>
            </div>

            <div class="control-group ">
                <label class="control-label" for="mail">E-mail:</label>
                <div class="controls">
                    <input class="input-block-level" type='email' id='mail' name='mail'  placeholder="E-mail" required>
                    <span class="help-inline">Username is already taken</span>
                </div>
            </div>
            <button class="btn btn-large btn-primary">Zarejestruj</button>
        </form>
    </div>
</div>