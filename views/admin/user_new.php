<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link rel="stylesheet" href="assets/css/upload-image.css">
<style>
    .error-border {
        border-color: brown;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<!-- Content -->
<div class="row justify-content-center">
    <div class="col-xl-8 col-md-12 text-gray-900">
        <!-- Name field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Name
            </div>
            <input type="text" class="form-control form-control-user col-xl-8 col-md-8" id="name" value="" autocomplete="off" spellcheck="false" />
        </div>
        <!-- ./Name field -->
        <!-- Email field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Email
            </div>
            <input type="email" class="form-control form-control-user col-xl-8 col-md-8" id="email" value="" autocomplete="off" spellcheck="false" />
        </div>
        <!-- ./Email field -->
        <!-- Password field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Password
            </div>
            <input type="password" class="form-control form-control-user col-xl-8 col-md-8" id="password" value="" autocomplete="off" spellcheck="false" />
        </div>
        <!-- ./Password field -->
        <!-- Phone field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Phone
            </div>
            <input type="number" class="form-control form-control-user col-xl-8 col-md-8" id="phone" value="" autocomplete="off" spellcheck="false" />
        </div>
        <!-- ./Phone field -->
        <!-- Address field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Address
            </div>
            <input type="text" class="form-control form-control-user col-xl-8 col-md-8" id="address" value="" autocomplete="off" spellcheck="false" />
        </div>
        <!-- ./Address field -->
        <!-- Role field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Role
            </div>
            <select class="form-control form-control-user col-xl-8 col-md-8" name="role" id="role">
                <option value="USER">User</option>
                <option value="ADMIN">Admin</option>
            </select>
        </div>
        <!-- ./Role field -->
        <!-- Field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Image
            </div>
            <div class="col-xl-8 col-md-8 p-0">
                <div class="dropzone" id="myDropzone"></div>
            </div>
        </div>
        <!-- Confirm button -->
        <div class="row justify-content-center">
            <div class="btn btn-success btn-icon-split mr-3" id="submit">
                <span class="icon text-white-50">
                    <i class="fas fa-check" id="btn-icon"></i>
                </span>
                <span class="text mr-3 ml-3" id="btn-text">Add User</span>
            </div>
        </div>
    </div>
</div>

<script>
    Dropzone.options.myDropzone = {
        url: "index.php?controller=AdminUser&action=addUser&new=true",
        autoProcessQueue: false,
        uploadMultiple: false,
        maxFiles: 1,
        maxFilesize: 2,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        init: function() {

            var myDropzone = this;

            function checkNullInput() {
                let checked = true;
                $("input[type!='file']").each(function() {
                    if (checkNull($(this).val())) {
                        checked = false;
                        $(this).toggleClass('error-border', true);
                    } else {
                        $(this).toggleClass('error-border', false);
                    }
                });
                return checked;
            }

            // Update selector to match your button
            $("#btn-text").click(function(e) {
                e.preventDefault();
                let checked = checkNullInput();
                if (myDropzone.getQueuedFiles().length === 0) {
                    $('#myDropzone').toggleClass('error-border', true);
                } else {
                    $('#myDropzone').toggleClass('error-border', false);
                    if (checked) {
                        myDropzone.processQueue();
                    }
                }
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                $("input[type!='file']").each(function() {
                    formData.append($(this).attr("id"), $(this).val());
                });
                formData.append("role", $('select')[0].value);
            });
        },
        success: function(data) {
            window.location.href = "index.php?controller=AdminUser";
        }
    }
</script>