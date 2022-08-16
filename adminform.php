


















<!DOCTYPE html>
<html lang="en">

<head>
    <title>USER LOGIN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/login.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body>
    <nav class="navbar sticky" style="padding: 40px 0;">
        <div class="max-widthh">
            

            <div class="logo"><a href="index.php">Rent<span>ools.</span></a></div>
        
        </div>
    </nav>
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <img src="img/admin.jpg" alt="login">
            </div>
        </div>
    </section>
    <div class="form-design">
        <form action="admin.php" method="post">
            <h2>ADMIN LOGIN</h2>
            <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <label>Admin User</label>
            <div class="field">
                <input type="text" name="adminname" placeholder="Email Address">
            </div>
            <label>Password</label>
            <div class="field">
                <input type="password" name="adminpassword" placeholder="Password">
            </div>
       

            <div class="field btn">
                <div class="btn-layer"></div>
                <input type="submit" value="Login" name="adminlogin">
            </div>
       
        </form>
    </div>
</body>

</html>