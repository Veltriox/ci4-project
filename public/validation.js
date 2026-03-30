
var form = document.getElementById("signupForm");

if (!form) {
    form = document.getElementById("loginForm");
}

if (!form) {
    form = document.getElementById("editUserForm");
}


form.oninput = function (event) {

  var inputBox = event.target;
  var error = document.getElementById(inputBox.id + "-error");


  if (inputBox.value != "") {
    inputBox.style.border = "2px solid green";

    if (error) {
      error.style.display = "none";
    }

  } else {
    inputBox.style.border = "2px solid red";
  }
};


form.onsubmit = function (event) {

  event.preventDefault();

  var formData = new FormData(form);

  fetch(form.action, {
    method: "POST",
    body: formData
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {


      if (data.status == "error") {

        var error = document.getElementById(data.field + "-error");
        var inputBox = document.getElementById(data.field);

        if (error) {
          error.innerText = data.message;
          error.style.display = "block";
        }

        if (inputBox) {
          inputBox.style.border = "2px solid red";
        }

      } else {
        // success
        window.location.href = data.redirect;
      }

    });

};
