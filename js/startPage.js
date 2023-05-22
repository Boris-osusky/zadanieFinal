function setLanguage(language){
    var d = new Date();
    d.setTime(d.getTime() + (1 * 60 * 60 * 1000)); // Platnosť cookie - 1 hodina od aktuálneho času
    var expires = "expires=" + d.toUTCString();
    document.cookie = "language="+language+"; " + expires + "; path=/";
    //document.cookie = "language="+language;
    changeStudent(language);
}
function startPage(){
    var language= getCookieValue();
    changeStudent(language);
}