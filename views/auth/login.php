<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-6 col-md-8">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>
                    <form class="user">
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Enter Email Address..." spellcheck="false" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" autocomplete="on" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck" />
                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                            </div>
                        </div>
                        <a onclick="login()" class="btn btn-primary btn-user btn-block">
                            Login
                        </a>
                        <hr />
                        <a href="index.html" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Login with Google
                        </a>
                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                        </a>
                    </form>
                    <hr />
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="register.html">Create an Account!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function login() {
        let formData = new FormData($('form')[0]);
        formData.append("remember", $('#customCheck')[0].value);
        $.ajax({
            type: "POST",
            url: "index.php?controller=Login&action=verify",
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                console.log(data);
                data = JSON.parse(data);
                if (data.status = 200) {
                    window.location.href = "index.php?controller=AdminUser";
                }
            },
        });
    }
</script>