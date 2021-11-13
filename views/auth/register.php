<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-8 col-md-12">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="name" id="name" placeholder="Full Name" autocomplete="off" spellcheck="false" />
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="phone" id="phone" placeholder="Phone Number" autocomplete="off" spellcheck="false" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email Address" autocomplete="off" spellcheck="false" />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" />
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" name="password-2" id="password-repeat" placeholder="Repeat Password" />
                            </div>
                        </div>
                        <a onclick="register(event)" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </a>
                        <hr />
                        <a href="#" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Register with Google
                        </a>
                        <a href="#" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Register with
                            Facebook
                        </a>
                    </form>
                    <hr />
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="index.php?controller=Login">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function verified(formData) {
        let ret = true;
        let check = !checkNull(formData.get('name'));
        ret &= check;
        if (check === false) {
            $('.modal-body')[0].innerHTML = "Tên";
        }
        ret &= check = checkPhone(formData.get('phone'));
        if (check === false) {
            $('.modal-body')[0].innerHTML += ", Số điện thoại";
        }
        ret &= check = checkEmail(formData.get('email'));
        if (check === false) {
            $('.modal-body')[0].innerHTML += ", Email";
        }
        ret &= check = !checkNull(formData.get('password'));
        if (check === false) {
            $('.modal-body')[0].innerHTML += ", Mật khẩu";
        }
        ret &= check = (!checkNull(formData.get('password-2')) && formData.get('password') === formData.get('password-2'));
        if (check === false) {
            $('.modal-body')[0].innerHTML += ", Mật khẩu nhập lại";
        }
        if (!checkNull(formData.get('name'))) {
            $('.modal-body')[0].innerHTML = $('.modal-body')[0].innerHTML.slice(2);
        }
        return ret;
    }

    function register(event) {
        event.preventDefault();
        $('.modal-body')[0].innerHTML = '';
        let formData = new FormData($('form')[0]);
        if (verified(formData)) {
            $.ajax({
                type: "POST",
                url: "index.php?controller=Register&action=register",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    console.log(data);
                    data = JSON.parse(data);
                    if (data.status === 200) {
                        window.location.href = "index.php?controller=AdminUser";
                    } else {
                        $('.modal-body')[0].innerHTML = "Email đã tồn tại";
                        $('#modal').modal('toggle');
                    }
                },
            });
        } else {
            $('.modal-body')[0].innerHTML += " không chính xác";
            $('#modal').modal('toggle');
        }
    }
</script>