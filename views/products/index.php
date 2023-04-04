<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="/views/styles.css">
</head>

<body>
    <div class="container py-3">
        <!-- Header :: Start -->
        <header class="d-flex justify-content-between align-items-center">
            <!-- Title -->
            <h1>Product List</h1>

            <!-- Buttons :: Start -->
            <div class="d-inline-flex justify-content-between align-items-center gap-2">
                <!-- Add -->
                <a href="./add-product" class="btn btn-primary fw-bold d-inline-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11 19v-6H5v-2h6V5h2v6h6v2h-6v6h-2Z" />
                    </svg>
                    Add
                </a>

                <!-- Mass Delete -->
                <button id="delete-product-btn"
                    class="btn btn-danger fw-bold d-inline-flex align-items-center gap-1 d-none">
                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="M216 48h-40v-8a24 24 0 0 0-24-24h-48a24 24 0 0 0-24 24v8H40a8 8 0 0 0 0 16h8v144a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16V64h8a8 8 0 0 0 0-16ZM112 168a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0Zm48 0a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0Zm0-120H96v-8a8 8 0 0 1 8-8h48a8 8 0 0 1 8 8Z" />
                    </svg>
                    Mass Delete
                </button>
            </div>
            <!-- Buttons :: End -->
        </header>
        <!-- Header :: End -->

        <hr>

        <!-- Products List :: Start -->
        <div class="row g-3 py-4">
            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">JVC200123</span>
                    <span class="fs-4 fw-bold">Acme Disc</span>
                    <span class="fs-6">$1.00</span>
                    <div>
                        <span class="fw-bold">Size:</span>
                        <span>700 MB</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">JVC200123</span>
                    <span class="fs-4 fw-bold">Acme Disc</span>
                    <span class="fs-6">$1.00</span>
                    <div>
                        <span class="fw-bold">Size:</span>
                        <span>700 MB</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">JVC200123</span>
                    <span class="fs-4 fw-bold">Acme Disc</span>
                    <span class="fs-6">$1.00</span>
                    <div>
                        <span class="fw-bold">Size:</span>
                        <span>700 MB</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">JVC200123</span>
                    <span class="fs-4 fw-bold">Acme Disc</span>
                    <span class="fs-6">$1.00</span>
                    <div>
                        <span class="fw-bold">Size:</span>
                        <span>700 MB</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">GGWP0007</span>
                    <span class="fs-4 fw-bold">War and Peace</span>
                    <span class="fs-6">$20.00</span>
                    <div>
                        <span class="fw-bold">Weight:</span>
                        <span>2 KG</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">GGWP0007</span>
                    <span class="fs-4 fw-bold">War and Peace</span>
                    <span class="fs-6">$20.00</span>
                    <div>
                        <span class="fw-bold">Weight:</span>
                        <span>2 KG</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">GGWP0007</span>
                    <span class="fs-4 fw-bold">War and Peace</span>
                    <span class="fs-6">$20.00</span>
                    <div>
                        <span class="fw-bold">Weight:</span>
                        <span>2 KG</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">GGWP0007</span>
                    <span class="fs-4 fw-bold">War and Peace</span>
                    <span class="fs-6">$20.00</span>
                    <div>
                        <span class="fw-bold">Weight:</span>
                        <span>2 KG</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">TR120555</span>
                    <span class="fs-4 fw-bold">Chair</span>
                    <span class="fs-6">$40.00</span>
                    <div>
                        <span class="fw-bold">Dimension:</span>
                        <span>24x45x15</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">TR120555</span>
                    <span class="fs-4 fw-bold">Chair</span>
                    <span class="fs-6">$40.00</span>
                    <div>
                        <span class="fw-bold">Dimension:</span>
                        <span>24x45x15</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">TR120555</span>
                    <span class="fs-4 fw-bold">Chair</span>
                    <span class="fs-6">$40.00</span>
                    <div>
                        <span class="fw-bold">Dimension:</span>
                        <span>24x45x15</span>
                    </div>
                </label>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <label
                    class="position-relative border border-light-subtle p-2 text-center d-flex flex-column rounded shadow-sm cursor-pointer user-select-none">
                    <input type="checkbox" name="" id=""
                        class="delete-checkbox form-check-input position-absolute left-10 top-10">

                    <span class="fs-6">TR120555</span>
                    <span class="fs-4 fw-bold">Chair</span>
                    <span class="fs-6">$40.00</span>
                    <div>
                        <span class="fw-bold">Dimension:</span>
                        <span>24x45x15</span>
                    </div>
                </label>
            </div>
        </div>
        <!-- Products List :: End -->

        <hr>

        <footer class="text-center fw-bold">
            Scandiweb Test Assignment
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/views/scripts.js"></script>
</body>

</html>