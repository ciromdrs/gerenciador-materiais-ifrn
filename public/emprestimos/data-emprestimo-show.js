
var div_data_emprestimo = document.querySelector('div#div-data-emprestimo');
var div_emprestimo = document.querySelector('div#div-emprestimos');

var emprestar = document.querySelector('input#emprestar-agora').addEventListener('click', emprestar);
var agendar = document.querySelector('input#agendar-emprestimo').addEventListener('click', agendar);

function agendar() {
    div_data_emprestimo.style.display = "block";
}

function emprestar() {
    div_data_emprestimo.style.display = "none";
    div_emprestimo.style.display = "block";
}
