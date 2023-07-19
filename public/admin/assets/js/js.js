const myInput = document.getElementById("input_just_number");
myInput.addEventListener("keypress", function (evt) {
    const charCode = evt.which ? evt.which : event.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        evt.preventDefault();
    }
});



