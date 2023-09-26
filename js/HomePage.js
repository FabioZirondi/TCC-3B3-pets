function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function exibirmensagem(){
  document.getElementById("imagem").addEventListener("change", function () {
    const fileInput = document.getElementById("imagem");
    const fileLabel = document.getElementById("fileLabel");

    if (fileInput.files.length > 0) {
        fileLabel.innerHTML = `<img src="../img/upload.png" alt="imagemUpload"> ${fileInput.files[0].name}`;
    } else {
        fileLabel.innerHTML = `<img src="../img/upload.png" alt="imagemUpload"> Escolher Arquivo`;
    }
});
}