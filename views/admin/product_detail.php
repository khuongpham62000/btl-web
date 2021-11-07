<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link rel="stylesheet" href="assets/css/upload-image.css">
<form>
    <!-- Title -->
    <div class="row justify-content-between">
        <h1 class="h3 ml-3 mb-0 text-gray-800">Product <?= $product->id ?></h1>
        <div class="btn btn-success btn-icon-split mr-3" id="submit" onclick="triggred()">
            <span class="icon text-white-50">
                <i class="fas fa-check" id="btn-icon"></i>
            </span>
            <span class="text mr-3 ml-3" id="btn-text">Save Info</span>
        </div>
    </div>

    <hr class="sidebar-divider" />
    <!-- Content -->
    <div class="row justify-content-center">
        <div class="col-xl-2 col-md-2 d-none d-lg-block d-xl-block mr-5">
            <img class="img-thumbnail" src="<?= $product->image ?>" />
        </div>
        <div class="col-md-8 text-gray-900">
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Name
                </div>
                <input id="product_name" value="<?= $product->name ?>" type="text" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false">
            </div>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Stock
                </div>
                <input id="product_stock" value="<?= $product->stock ?>" type="text" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false">
            </div>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Price
                </div>
                <input id="product_price" value="<?= $product->price ?>" type="text" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false">
            </div>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Volume
                </div>
                <input id="product_volume" value="<?= $product->volume ?>" type="text" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false">
            </div>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-4 align-self-center">
                    Description
                </div>
                <textarea id="product_description" type="text" class="form-control form-control-user col-xl-8 col-md-8" autocomplete="off" spellcheck="false" rows="6">
                    <?= $product->description ?>
                </textarea>
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
    // Dropzone.options.uploadForm = {
    //     // url: "index.php?controller=AdminProduct&action=updateImage&id=<?= $product->id ?>",
    //     paramName: "image",
    //     maxFilesize: 2, // MB
    //     maxFiles: 1,
    //     acceptedFiles: "image/*",
    // };

    Dropzone.options.myDropzone = {
        url: "index.php?controller=AdminProduct&action=updateImage&id=<?= $product->id ?>",
        autoProcessQueue: true,
        uploadMultiple: false,
        maxFiles: 1,
        maxFilesize: 2,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        success: function() {
            window.location.href = "index.php?controller=AdminProduct&action=viewDetail&id=<?= $product->id ?>";
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
        formData.append('name', $('#product_name')[0].value);
        formData.append('stock', $('#product_stock')[0].value);
        formData.append('price', $('#product_price')[0].value);
        formData.append('volume', $('#product_volume')[0].value);
        formData.append('description', $('#product_description')[0].value);
        $.ajax({
            type: "POST",
            url: "index.php?controller=AdminProduct&action=save&id=<?= $product->id ?>",
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