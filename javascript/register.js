document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("#form");
  const button = document.querySelector("button");
  const errorText = document.querySelector(".error");

  form.addEventListener("submit", (event) => {
    event.preventDefault();
  });

  button.addEventListener("click", (event) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/register.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const data = xhr.response;
          if (data === "success") {
            location.href = "dashboard.php";
          } else {
            errorText.innerHTML = data;
            errorText.style.display = "block";
          }
        } else {
          console.error(
            "Terjadi kesalahan saat melakukan permintaan: " + xhr.status
          );
        }
      }
    };
    xhr.onerror = () => {
      console.error("Terjadi kesalahan saat melakukan permintaan.");
    };

    const formData = new FormData(form);
    xhr.send(formData);
  });
});
