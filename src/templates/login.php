<form action="/is-user-exist" method="post">

    <p>
        <label for="email"> Email: </label>
        <input type='email' name="email" id="email"

            <?php if (isset($data['email'])) {
                print_r("value={$data['email']}");
            }
            ?>

               required>

        <?php
        if (isset($errors['email'])) {
            print_r("<p> {$errors['email']} </p>");
        }
        ?>
    </p>

    <p>
        <label for="password"> Password: </label>
        <input type='password' name="password" id="password"

            <?php if (isset($data['password'])) {
                print_r("value={$data['password']}");
            }
            ?>

               required>

        <?php
        if (isset($errors['password'])) {
            print_r("<p> {$errors['password']} </p>");
        }
        ?>
    </p>

    <input type='submit' value='Submit'>
</form>
