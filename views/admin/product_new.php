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
<form>
    <!-- Title -->
    <div class="row justify-content-between">
        <h1 class="h3 ml-3 mb-0 text-gray-800">Add Product</h1>
        <div>
            <div class="btn btn-success btn-icon-split mr-3" id="submit">
                <span class="icon text-white-50">
                    <i class="fas fa-check" id="btn-icon"></i>
                </span>
                <span class="text mr-3 ml-3" id="btn-text">Add Product</span>
            </div>
        </div>
    </div>

    <hr class="sidebar-divider" />
    <!-- Content -->
    <div class="row justify-content-center">
        <div class="col-md-8 text-gray-900">
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Name
                </div>
                <input id="name" value="" type="text" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false" />
            </div>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Stock
                </div>
                <input id="stock" value="" type="number" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false" />
            </div>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Price
                </div>
                <input id="price" value="" type="number" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false" />
            </div>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Volume
                </div>
                <input id="volume" value="" type="number" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false" />
            </div>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Description
                </div>
                <textarea id="description" type="text" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false" rows="6"></textarea>
            </div>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Image
                </div>
                <div class="col-xl-8 col-md-8 p-0">
                    <div class="dropzone" id="myDropzone"></div>
                </div>
            </div>
        </div>
</form>

<script>
    Dropzone.options.myDropzone = {
        url: "index.php?controller=AdminProduct&action=addProduct&new=true",
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
                formData.append("description", $('textarea')[0].value);
            });
        },
        success: function(data) {
            window.location.href = "index.php?controller=AdminProduct";
        }
    }
</script>