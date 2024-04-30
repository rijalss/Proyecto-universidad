// Nombre de constante para el menu sidebar es hamburguesa :)
const Hamburguesa = document.querySelector(".toggle-btn"); 

Hamburguesa.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
});