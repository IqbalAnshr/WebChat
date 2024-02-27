document.addEventListener("DOMContentLoaded", function () {
  const userlist = document.querySelector(".user-list");
  const searchForm = document.querySelector(".search-form");

  searchForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const searchTerm = document.getElementById("search").value.trim();

    const xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "../php/search.php?search=" + encodeURIComponent(searchTerm),
      true
    );

    // Tangani respon dari server
    xhr.onload = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.responseText;
          userlist.innerHTML = data;
        } else {
          console.error("Error: " + xhr.status);
        }
      }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
  });

  setInterval(function () {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/users.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          if (document.getElementById("search").value.trim() == "") {
            userlist.innerHTML = data;
          }
        }
      }
    };
    xhr.send();
  }, 500);
});
