<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-box {
            max-width: 450px;
            margin: auto;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #1e88e5, #0d47a1);
            color: white;
            text-align: center;
            padding: 30px;
        }
        .login-header i {
            font-size: 50px;
            margin-bottom: 15px;
        }
        .login-header h3 {
            margin: 0;
            font-size: 1.8rem;
        }
        .login-body {
            padding: 40px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #ddd;
            padding: 12px;
        }
        .form-control:focus {
            border-color: #1e88e5;
            outline: none;
        }
        .btn-login {
            background: linear-gradient(135deg, #1e88e5, #0d47a1);
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            color: white;
        }
        .btn-login:hover {
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: #1e88e5;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="login-header">
                <i class="fas fa-umbrella-beach"></i>
                <h3>Winnie's Resort</h3>
                <p>Customer Login</p>
            </div>
            <div class="login-body">
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                
                <form action="/doLogin" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                </form>
                <div class="register-link">
                    <p>Don't have an account? <a href="/register">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>