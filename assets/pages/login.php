

<link rel="stylesheet" href="assets/css/login.css">

<div class="container">
    <!-- Form starts here -->
    <form id="loginForm" method="post" action="assets/php/actions.php?login">
        <h2>Login</h2>

        <!-- Email/Username Field -->
        <div class="form-group">
            <label for="email">Email Address or Username</label>
            <input type="text" class="form-control" id="email" name="useremail" placeholder="Enter your email or username" required>
        </div><?=showError('useremail')?>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
        </div>

        <!-- Login Button -->
        <button type="submit" class="btn btn-primary">Login</button>

        <!-- Links -->
        <p>Don't have an account? <a href="signup.html">Sign up</a></p>
        <p><a href="forgotPassword.html">Forgot Password?</a></p>

      
    </form>
</div>

