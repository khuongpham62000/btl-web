<style>
    body {
        justify-content: flex-start;
    }

    .container {
        margin-top: 8rem;
        max-height: calc(100vh - 8rem);
        justify-content: center;
        align-self: center;
        padding-bottom: 4rem;
        transition: 0.3s margin ease-in-out;
        position: fixed;
    }

    @media only screen and (max-width: 768px) {
        .container {
            margin-top: 4rem;
        }
    }

    a {
        text-decoration: none;
        color: black;
        font-weight: 600;
    }

    .big,
    .medium,
    .small {
        text-align: center;
        max-width: 700px;
    }

    .small a:hover {
        color: black;
        text-decoration: underline;
    }

    .big {
        font-size: 32px;
        padding: 1rem;
        margin-top: 1rem;
    }

    .medium {
        font-size: 18px;
        padding: 0.5rem;
        margin-top: 0.5rem;
    }

    .small {
        font-size: 14px;
        padding: 0.25rem;
    }
</style>

<style>
    .product {
        position: fixed;
        top: 60%;
        justify-content: space-evenly;
        width: 100%;
        padding: 0 3rem;
    }

    .item {
        transition: 0.3s transform ease-in-out;
    }

    .item:hover {
        transform: translateY(-4%);
    }

    .item_title {
        text-transform: uppercase;
        font-weight: 600;
    }

    .item_image {
        overflow: hidden;
    }
</style>

<div class="container col">
    <div class="big">
        ORGANIC NUT MILKS.
        <br>
        WE MAKE 'EM FRESH,
        <br>
        YOU DRINK 'EM FRESH.
    </div>
    <div class="small">Happily delivering to doorsteps in Austin, San Antonio, Houston and Dallas. Made in Austin, TX</div>
</div>
<div class="product row">
    <div class="item">
        <a href="/index.php?controller=UserProduct&id=1">
            <div class="item_title medium" style="color: #387da3;">This one's original</div>
            <div class="item_image">
                <img src="https://cdn11.bigcommerce.com/s-ayhps3hr1w/images/stencil/500x659/products/118/416/Fronks_Original_01__45224.1484091301.png?c=2" alt="Hinh san pham">
            </div>
        </a>
    </div>
    <div class="item">
        <a href="/index.php?controller=UserProduct&id=2">
            <div class="item_title medium" style="color: #df4597;">This one's Cocoa</div>
            <div class="item_image">
                <img src="https://cdn11.bigcommerce.com/s-ayhps3hr1w/images/stencil/500x659/products/117/415/Fronks_Cocoa_01__28865.1578619123.png?c=2" alt="Hinh san pham">
            </div>
        </a>
    </div>
    <div class="item">
        <a href="/index.php?controller=UserProduct&id=3">
            <div class="item_title medium" style="color: #555;">This one's simple</div>
            <div class="item_image">
                <img src="https://cdn11.bigcommerce.com/s-ayhps3hr1w/images/stencil/500x659/products/114/419/Fronks_Simple_04__73447.1578619147.png?c=2" alt="Hinh san pham">
            </div>
        </a>
    </div>
</div>