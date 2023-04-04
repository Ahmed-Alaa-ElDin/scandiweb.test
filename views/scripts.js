$(function () {
  var massDeleteBtn = $("#delete-product-btn");
  var deleteCheckboxes = $(".delete-checkbox");

  deleteCheckboxes.on("click", function (e) {
    let deleteCheckboxesChecked = $(".delete-checkbox:checked");

    deleteCheckboxesChecked.length
      ? massDeleteBtn.removeClass("d-none")
      : massDeleteBtn.addClass("d-none");
  });

  var selectType = $("#productType");
  var dvdBlock = $("#dvdBlock");
  var bookBlock = $("#bookBlock");
  var furnitureBlock = $("#furnitureBlock");

  selectType.on("change", function (e) {
    let type = this.value;
    switch (type) {
      case "1":
        dvdBlock.removeClass("d-none");
        bookBlock.addClass("d-none");
        furnitureBlock.addClass("d-none");
        break;
      case "2":
        dvdBlock.addClass("d-none");
        bookBlock.removeClass("d-none");
        furnitureBlock.addClass("d-none");
        break;
      case "3":
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

    let values = {};

    $(this)
      .find("input, select")
      .each(function (i, inp) {
        let fieldName = $(this).attr("name");

        values[fieldName] = $(this).val();
      });

    $.ajax({
      url: "/product-validation",
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
