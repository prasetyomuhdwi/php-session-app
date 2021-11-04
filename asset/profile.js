var isPopup = false;

function popupModal() {
  let modal = document.getElementById("modal");
  if (!isPopup) {
    modal.classList.remove("hidden");
    isPopup = true;
  } else {
    modal.classList.add("hidden");
    isPopup = false;
  }
}

var step = 1;
function changeStep() {
  let step1 = document.querySelectorAll(".chooseImg");
  let step2 = document.getElementById("previewImg");
  if (step == 2) {
    step1.forEach((element) => {
      element.classList.remove("hidden");
    });
    step2.classList.add("hidden");
    step = 1;
  } else {
    step1.forEach((element) => {
      element.classList.add("hidden");
    });
    step2.classList.remove("hidden");
    step = 2;
  }
}

function displayImage(e) {
  changeStep();
  if (e.files[0]) {
    let reader = new FileReader();
    reader.onload = function (e) {
      document
        .querySelector("#profileDisplay")
        .setAttribute("src", e.target.result);
    };
    reader.readAsDataURL(e.files[0]);
  }
}

function onSubmit(event) {
  let file = document.getElementById("profileImg").files[0];
  let btnSubmit = document.getElementById("btnSubmit");
  let progressBar = document.getElementById("bar");

  progressBar.classList.remove("hidden");
  btnSubmit.classList.add("hidden");

  let progress = 0;
  let invervalSpeed = 10;
  let incrementSpeed = 1;

  if (file) {
    let formData = new FormData();
    formData.append("profileImg", file);

    let ajax = new XMLHttpRequest();
    ajax.open("POST", "upload.php", true);
    ajax.upload.onprogress = function (e) {
      if (e.lengthComputable) {
        progressInterval = setInterval(function () {
          progress += incrementSpeed;
          progressBar.style.width = progress + "%";
          if (progress >= 100) {
            clearInterval(progressInterval);
          }
        }, invervalSpeed);
      }
    };

    ajax.send(formData);

    ajax.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);

        setTimeout(function () {
          progressBar.classList.add("hidden");
          btnSubmit.classList.remove("hidden");
          popupModal();
          changeStep();
          document.getElementById("profileImg").value = null;
          location.reload(true);
        }, 3000);
      }
    };
  }

  return false;
}
