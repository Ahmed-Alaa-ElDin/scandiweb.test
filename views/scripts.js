var massDeleteBtn = document.getElementById("delete-product-btn");
var deleteCheckboxes = document.getElementsByClassName("delete-checkbox");

Array.from(deleteCheckboxes).forEach((deleteCheckbox) => {
  deleteCheckbox.addEventListener("click", function (e) {
    let deleteCheckboxesChecked = document.querySelectorAll(
      ".delete-checkbox:checked"
    );

    deleteCheckboxesChecked.length
      ? massDeleteBtn.classList.remove("d-none")
      : massDeleteBtn.classList.add("d-none");
  });
});
