<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="/views/assets/styles.css">
</head>

<body>
    <div class="container py-3">
        <form action="/add-product" method="post" id="product_form">

            <!-- Header :: Start -->
            <header class="d-flex justify-content-between align-items-center">
                <!-- Title -->
                <h1>Product Add</h1>

                <!-- Buttons :: Start -->
                <div class="d-inline-flex justify-content-between align-items-center gap-2">
                    <!-- Save -->
                    <button type="submit" class="btn btn-success fw-bold d-inline-flex align-items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M21 7v12q0 .825-.588 1.413T19 21H5q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h12l4 4Zm-2 .85L16.15 5H5v14h14V7.85ZM12 18q1.25 0 2.125-.875T15 15q0-1.25-.875-2.125T12 12q-1.25 0-2.125.875T9 15q0 1.25.875 2.125T12 18Zm-6-8h9V6H6v4ZM5 7.85V19V5v2.85Z" />
                        </svg>
                        Save
                    </button>

                    <!-- Cancel -->
                    <a id="" href="./" class="btn btn-danger fw-bold d-inline-flex align-items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="currentColor" d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275q.275.275.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7q-.275.275-.7.275t-.7-.275L12 13.4Z" />
                        </svg>
                        Cancel
                    </a>
                </div>
                <!-- Buttons :: End -->
            </header>
            <!-- Header :: End -->

            <hr>

            <div class="d-flex flex-column gap-3">
                <!-- Error Messages -->
                <div id="errorsWrapper" class="d-none bg-danger-subtle p-3 rounded-2 shadow-sm">
                    <ul id="errors" class="w-100 m-0">
                        
                    </ul>
                </div>

                <!-- SKU -->
                <div class="row g-3 align-items-center has-validation">
                    <div class="col-2 col-md-1">
                        <label class="fw-bold col-form-label" for="sku">SKU</label>
                    </div>
                    <div class="col-10 col-md-11 w-50">
                        <input type="text" class="col-auto form-control" name="sku" id="sku">

                    </div>
                </div>

                <!-- Name -->
                <div class="row g-3 align-items-center">
                    <div class="col-2 col-md-1">
                        <label class="fw-bold col-form-label" for="name">Name</label>
                    </div>
                    <div class="col-10 col-md-11 w-50">
                        <input type="text" class="col-auto form-control" name="name" id="name">
                    </div>
                </div>

                <!-- Price -->
                <div class="row g-3 align-items-center">
                    <div class="col-2 col-md-1">
                        <label class="fw-bold col-form-label" for="name">Price</label>
                    </div>
                    <div class="col-10 col-md-11 input-group w-50">
                        <span class="input-group-text" id="dollar">$</span>
                        <input type="text" class="form-control" name="price" id="price" aria-describedby="dollar">
                    </div>
                </div>

                <!-- Type -->
                <div class="row g-3 align-items-center">
                    <div class="col-2 col-md-1">
                        <label class="fw-bold form-label" for="productType">Type</label>
                    </div>
                    <div class="col-10 col-md-11 w-50">
                        <select name="productType" class="form-control" id="productType">
                            <option value="">Choose the product's type</option>
                            <option value="1">DVD</option>
                            <option value="2">Book</option>
                            <option value="3">Furniture</option>
                        </select>
                    </div>
                </div>

                <!-- DVD Section :: Start -->
                <!-- Size -->
                <div id="dvdBlock" class="d-none row gap-3 bg-primary-subtle border border-primary rounded py-3 px-2 mx-2">
                    <div class="col-12 m-0">
                        <label class="fw-bold form-label" for="">Please, provide size</label>
                    </div>

                    <div class="col-12 row align-items-center">
                        <div class="col-2 col-md-1">
                            <label class="fw-bold form-label" for="size">Size</label>
                        </div>

                        <div class="col-10 input-group w-50">
                            <input type="text" class="form-control" name="size" id="size" aria-describedby="mb">
                            <span class="input-group-text" id="mb">MB</span>
                        </div>
                    </div>
                </div>
                <!-- DVD Section :: End -->

                <!-- Furniture Section :: Start -->
                <div id="furnitureBlock" class="d-none row gap-3 bg-success-subtle border border-success rounded py-3 px-2 mx-2">
                    <label class="fw-bold form-label" for="">Please, provide dimensions</label>

                    <!-- Height -->
                    <div class="row align-items-center">
                        <div class="col-2 col-md-1">
                            <label class="fw-bold form-label" for="height">Height</label>
                        </div>

                        <div class="col-10 input-group w-50">
                            <input type="text" class="form-control" name="height" id="height" aria-describedby="cm">
                            <span class="input-group-text" id="cm">CM</span>
                        </div>
                    </div>

                    <!-- Width -->
                    <div class="row align-items-center">
                        <div class="col-2 col-md-1">
                            <label class="fw-bold form-label" for="width">Width</label>
                        </div>

                        <div class="col-10 input-group w-50">
                            <input type="text" class="form-control" name="width" id="width" aria-describedby="cm">
                            <span class="input-group-text" id="cm">CM</span>
                        </div>
                    </div>

                    <!-- Length -->
                    <div class="row align-items-center">
                        <div class="col-2 col-md-1">
                            <label class="fw-bold form-label" for="length">Length</label>
                        </div>

                        <div class="col-10 input-group w-50">
                            <input type="text" class="form-control" name="length" id="length" aria-describedby="cm">
                            <span class="input-group-text" id="cm">CM</span>
                        </div>
                    </div>
                </div>
                <!-- Furniture Section :: End -->

                <!-- Book Section :: Start -->
                <!-- Weight -->
                <div id="bookBlock" class="d-none row gap-3 bg-warning-subtle border border-warning rounded py-3 px-2 mx-2">
                    <label class="fw-bold form-label" for="">Please, provide weight</label>

                    <div class="row align-items-center">
                        <div class="col-2 col-md-1">
                            <label class="fw-bold form-label" for="weight">Weight</label>
                        </div>

                        <div class="col-10 input-group w-50">
                            <input type="text" class="form-control" name="weight" id="weight" aria-describedby="kg">
                            <span class="input-group-text" id="kg">KG</span>
                        </div>
                    </div>
                </div>
                <!-- Book Section :: End -->

            </div>

            <hr>

            <footer class="text-center fw-bold">
                Scandiweb Test Assignment
            </footer>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/views/assets/scripts.js"></script>
</body>

</html>