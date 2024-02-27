document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.querySelector(
    ".input-icon-wrapper i.fa-eye.pointer"
  );
  const passField = document.querySelector("#password2");

  toggleButton.addEventListener("click", () => {
    if (passField.type === "password") {
      passField.type = "text";
      toggleButton.classList.add("fa-eye-slash");
      toggleButton.classList.remove("fa-eye");
    } else {
      passField.type = "password";
      toggleButton.classList.add("fa-eye");
      toggleButton.classList.remove("fa-eye-slash");
    }
  });
});
