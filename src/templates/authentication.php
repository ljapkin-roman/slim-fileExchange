<h3> Form for register </h3>
<?php
if (isset($data['errors'])) {
    $errors = $data['errors'];
}
if (isset($data['data'])) {
    $data = $data['data'];
}

?>
<form action="/record" method="post">
    <p>
        <label for="first_name"> First name: </label>
        <input id="first_name" type='text' name="first_name"
            <?php if (isset($data['first_name'])) {
                print_r("value={$data['first_name']}");
            }
            ?>
               required>
    </p>
    <?php
    if (isset($errors['first_name'])) {
        print_r("<p> {$errors['first_name']} </p>");
    }
    ?>

    <p>
        <label for="last_name"> Last name: </label>
        <input id="last_name" type='text' name="last_name"

            <?php if (isset($data['last_name'])) {
                print_r("value={$data['last_name']}");
            }
            ?>
               required>

        <?php
        if (isset($errors['last_name'])) {
            print_r("<p> {$errors['last_name']} </p>");
        }
        ?>
    </p>



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

    <p>
        <label for="repeat_password"> Repeat password: </label>
        <input type='repeat_password' name="repeat_password" id="repeat_password"

            <?php if (isset($data['repeat_password'])) {
                print_r("value={$data['repeat_password']}");
            }
            ?>

               required>

        <?php
        if (isset($errors['repeat_password'])) {
            print_r("<p> {$errors['repeat_password']} </p>");
        }
        ?>
    </p>






    <input type='submit' value='Submit'>
</form>
<?php

print_r($_COOKIE);
?>
