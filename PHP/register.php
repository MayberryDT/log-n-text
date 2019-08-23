<?php include('server.php') ?>
<!DOCTYPE html>
    <head>
        <title>Register</title>
    </head>
    <body>

        <div class="container">

            <div class="header">

                <h2>Register</h2>

            </div>

        <form action="register.php" method="POST" required>

            <?php include('errors.php') ?>

            <div>
            
                <label for="username">Username :</label>
                <input type="text" name="username" required>
            
            </div>

            <div>
            
                <label for="password">Password :</label>
                <input type="password" name="password_1" required>
        
            </div>

            <div>
            
                <label for="password">Confirm Password :</label>
                <input type="password" name="password_2" required>
        
            </div>

            <button type="submit" name="reg_user">Submit</button>

            <p>Already a user? <a href="login.php"><b>Log In</b></a></p>
            
        </form>
        
        </div>

    </body>
</html>