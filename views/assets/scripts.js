$(function () {
  // Mass Delete Buttons
  var massDeleteBtn = $("#delete-product-btn");
  var deleteCheckboxes = $(".delete-checkbox");

  deleteCheckboxes.on("click", function (e) {
    let deleteCheckboxesChecked = $(".delete-checkbox:checked");

    deleteCheckboxesChecked.length
      ? massDeleteBtn.removeClass("d-none")
      : massDeleteBtn.addClass("d-none");
  });

    massDeleteBtn.on("click", function (e) {
      let selectedProducts = [];

      $("input[type=checkbox][name='products_id']:checked").each(function () {
        selectedProducts.push(this.value);
      });

      $.ajax({
        url: "/product-mass-delete",
        method: "POST",
        data: {"selectedProducts":selectedProducts},
        success: function (response) {
          let parsedResponse = JSON.parse(response);
          if (parsedResponse.status == "success") {
            window.location.replace("/");
          }
        }
      });
    });

  // Create New Product
  var selectType = $("#productType");
  var dvdBlock = $("#dvdBlock");
  var bookBlock = $("#bookBlock");
  var furnitureBlock = $("#furnitureBlock");

  selectType.on("change", function (e) {
    let type = this.value;
    switch (type) {
      case "DVD":
        dvdBlock.removeClass("d-none");
        bookBlock.addClass("d-none");
        furnitureBlock.addClass("d-none");
        break;
      case "Book":
        dvdBlock.addClass("d-none");
        bookBlock.removeClass("d-none");
        furnitureBlock.addClass("d-none");
        break;
      case "Furniture":
        dvdBlock.addClass("d-none");
        bookBlock.addClass("d-none");
        furnitureBlock.removeClass("d-none");
        break;
      default:
        dvdBlock.addClass("d-none");
        bookBlock.addClass("d-none");
        furnitureBlock.addClass("d-none");
    }
  });

  var productForm = $("#product_form");

  productForm.on("submit", function (e) {
    e.preventDefault();

    let values = {
      name: $("#name").val(),
      sku: $("#sku").val(),
      price: $("#price").val(),
      type: $("#productType").val(),
      arguments: {
        size: $("#size").val(),
        weight: $("#weight").val(),
        width: $("#width").val(),
        height: $("#height").val(),
        length: $("#length").val()
      }
    };

    $.ajax({
      url: "/product-store",
      method: "POST",
      data: values,
      beforeSend: function () {
        $(".error").remove();
        $("#errorsWrapper").addClass("d-none");
      },
      success: function (response) {
        let parsedResponse = JSON.parse(response);
        if (parsedResponse.status == "success") {
          window.location.replace("/");
        } else {
          $("#errorsWrapper").removeClass("d-none");
          Object.entries(parsedResponse.messages).forEach(function ([
            field,
            messages
          ]) {
            messages.forEach((message) => {
              $("#errors").append(`
                <li class="error fs-7 text-danger fw-bold">
                  ${message}
                </li>
              `);
            });
          });
        }
      }
    });
  });
});
