document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".input-message");
  const input = document.querySelector("#message");
  const sendBtn = document.querySelector(".send-btn");
  const chatBox = document.querySelector(".chat-box");
  const incoming_id = document.querySelector("#incoming_id").value;
  const scrollDownBtn = document.querySelector(".scroll-down-btn");

  form.addEventListener("submit", (event) => {
    event.preventDefault();
  });

  sendBtn.addEventListener("click", (event) => {
    event.preventDefault();

    if (input.value.trim() == "") {
      return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/send-message.php", true);

    xhr.onload = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.responseText;
          input.value = "";
          scrollToBottom();
        } else {
          console.error("Error: " + xhr.status);
        }
      }
    };
    let formData = new FormData(form);
    xhr.send(formData);
  });

  chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
  };

  chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
  };

  chatBox.addEventListener("touchstart", () => {
    chatBox.classList.add("active");
  });

  chatBox.addEventListener("touchend", () => {
    chatBox.classList.remove("active");
  });

  setInterval(function () {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/get-message.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          chatBox.innerHTML = data;
          if (!chatBox.classList.contains("active")) {
            scrollToBottom();
          }
        }
      }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id=" + incoming_id);
  }, 500);

  function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
  }
});
