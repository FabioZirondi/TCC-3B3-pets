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

const telefone = document.querySelector('#cad-tel');

telefone.addEventListener('input', formatarTelefone);
telefone.addEventListener('focus', () => {
  // Define o valor do campo de entrada como vazio ao focar
  telefone.value = '';
});

function formatarTelefone() {
  // Remove qualquer caractere não numérico do número de telefone
  let numeroLimpo = telefone.value.replace(/\D/g, '');

  // Limita o número de caracteres para 11
  numeroLimpo = numeroLimpo.substr(0, 11);

  // Formata o número de telefone no padrão desejado: +55 (00) 00000-0000
  let formatoTelefone = '';
  for (let i = 0; i < numeroLimpo.length; i++) {
    if (i === 0) {
      formatoTelefone += `+${numeroLimpo[i]}`;
    } else if (i === 2) {
      formatoTelefone += ` (${numeroLimpo[i]}`;
    } else if (i === 7) {
      formatoTelefone += `) ${numeroLimpo[i]}`;
    } else if (i === 9) {
      formatoTelefone += `-${numeroLimpo[i]}`;
    } else {
      formatoTelefone += numeroLimpo[i];
    }
  }

  // Atualiza o valor do campo de entrada com o número de telefone formatado
  telefone.value = formatoTelefone;
}
