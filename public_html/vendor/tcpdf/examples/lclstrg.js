$(document).ready(function(){
    localStorage.setItem("lastname", $("#getme").val());
    console.log(localStorage.getItem("lastname"));
});