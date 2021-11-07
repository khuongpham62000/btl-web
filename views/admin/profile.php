<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link rel="stylesheet" href="assets/css/upload-image.css">

<!-- Header -->
<div class="row">
    <div class="col-xl-2 col-md-4 col-sm-4 mb-4 mr-5">
        <img class="img-thumbnail rounded-circle" src="<?= $account->image ?>" />
    </div>
    <div class="col">
        <div class="h3 mt-4 text-gray-800">
            Hello <?= $account->name ?>!
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Edit Avatar
        </button>
    </div>
</div>

<hr class="sidebar-divider" />
<!-- Content -->
<div class="row justify-content-center">
    <div class="col-xl-8 col-md-12 text-gray-900">
        <!-- Name field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Name
            </div>
            <input type="text" class="form-control form-control-user col-xl-10 col-md-8" id="name" value="<?= $account->name ?>" autocomplete="off" spellcheck="false" />
        </div>
        <!-- ./Name field -->
        <!-- Email field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Email
            </div>
            <input type="email" class="form-control form-control-user col-xl-10 col-md-8" id="email" value="<?= $account->email ?>" autocomplete="off" spellcheck="false" />
        </div>
        <!-- ./Email field -->
        <!-- Email field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-2 col-md-2 align-self-center">
                Address
            </div>
            <input type="text" class="form-control form-control-user col-xl-10 col-md-8" id="address" value="<?= $account->address ?>" autocomplete="off" spellcheck="false" />
        </div>
        <!-- ./Email field -->
        <!-- Confirm button -->
        <div class="row justify-content-center">
            <div class="btn btn-success btn-icon-split mr-3" id="submit" onclick="triggred()">
                <span class="icon text-white-50">
                    <i class="fas fa-check" id="btn-icon"></i>
                </span>
                <span class="text mr-3 ml-3" id="btn-text">Save Info</span>
            </div>
        </div>
        <!-- ./Confirm button -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="dropzone" id="myDropzone2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="save-image">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    Dropzone.options.myDropzone2 = {
        url: "index.php?controller=AdminProfile&action=updateImage&id=<?= $account->id ?>",
        autoProcessQueue: false,
        uploadMultiple: false,
        maxFiles: 1,
        maxFilesize: 2,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        init: function() {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            document.getElementById("save-image").addEventListener("click", function(e) {
                // Make sure that the form isn't actually being sent.
                dzClosure.processQueue();
            });
        },
        success: function() {
            window.location.href = "index.php?controller=AdminProfile&action=index&id=<?= $account->id ?>";
        }
    }

    function triggred() {
        var btn_icon = $('#btn-icon');
        if (btn_icon.hasClass("fa-check")) {
            $('#btn-text')[0].innerHTML = "Saving";
            btn_icon.toggleClass("fa-check");
            btn_icon.toggleClass("fa-spinner");
            btn_icon.toggleClass("fa-spin");
        }
        var formData = new FormData();
        formData.append('name', $('#name')[0].value);
        formData.append('email', $('#email')[0].value);
        formData.append('address', $('#address')[0].value);
        $.ajax({
            type: "POST",
            url: "index.php?controller=AdminProfile&action=save&id=<?= $account->id ?>",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data, status) {
                if (!btn_icon.hasClass("fa-check")) {
                    $('#btn-text')[0].innerHTML = "Saved";
                    btn_icon.toggleClass("fa-check");
                    btn_icon.toggleClass("fa-spinner");
                    btn_icon.toggleClass("fa-spin");
                }
            },
        });
    }
</script>