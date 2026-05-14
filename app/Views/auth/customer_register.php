<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Register - Winnie's Resort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        .register-box {
            max-width: 550px;
            margin: auto;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .register-header {
            background: linear-gradient(135deg, #1e88e5, #0d47a1);
            color: white;
            text-align: center;
            padding: 30px;
        }
        .register-header i {
            font-size: 50px;
            margin-bottom: 15px;
        }
        .register-header h3 {
            margin: 0;
            font-size: 1.8rem;
        }
        .register-body {
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
        .btn-register {
            background: linear-gradient(135deg, #1e88e5, #0d47a1);
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            color: white;
        }
        .btn-register:hover {
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #1e88e5;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-box">
            <div class="register-header">
                <i class="fas fa-user-plus"></i>
                <h3>Create Account</h3>
                <p>Join Winnie's Resort</p>
            </div>
            <div class="register-body">
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                
                <form action="/doRegister" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password (min 6 characters)" required>
                    </div>
                    <button type="submit" class="btn-register">Register</button>
                </form>
                <div class="login-link">
                    <p>Already have an account? <a href="/login">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>