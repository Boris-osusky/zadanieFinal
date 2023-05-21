var jsonData;
var current;

const fetchData = () => {
    return fetch("./language.json")
        .then(res => res.json())
        .then(data => {
            jsonData = data;
        });
};

function getCookieValue() {
    var cookies = document.cookie.split(";");
    var langVar = "language=";
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(langVar) === 0) {
            console.log(cookie.substring(langVar.length, cookie.length))
            return cookie.substring(langVar.length, cookie.length);
        }
    }
    console.log("ZA FOR")
    var d = new Date();
    d.setTime(d.getTime() + (1 * 60 * 60 * 1000)); // Platnosť cookie - 1 hodina od aktuálneho času
    var expires = "expires=" + d.toUTCString();
    document.cookie = "language=sk" + expires + "; path=/";
    return "sk";
}

function changeIndex(language) {
    var navText = document.getElementById("navText");
    var indexIntro = document.getElementById("indexIntro");
    var navHome = document.getElementById("navHome1");

    if (jsonData) { // Skontrolujte, či sú údaje z JSON súboru dostupné
        if (language == "sk") {
            navText.textContent = jsonData[0].sk.navText;
            indexIntro.textContent = jsonData[0].sk.indexIntro;
            navHome.textContent = jsonData[0].sk.navHome;
        } else {
            navText.textContent = jsonData[0].en.navText;
            indexIntro.textContent = jsonData[0].en.indexIntro;
            navHome.textContent = jsonData[0].en.navHome;
        }
    }
    else {
        fetchData().then(() => {
            var language = getCookieValue();
            changeIndex(language);
        });
    }
}

function changeTeacher(language) {
    var dropzone = document.getElementById("dropzone");
    var assignTaskButton = document.getElementById("assignTaskButton");
    var pointsInput= document.getElementById("pointsInput");
    var navHome = document.getElementById("navHome6");

    if (jsonData) { // Skontrolujte, či sú údaje z JSON súboru dostupné
        if (language == "sk") {
            dropzone.textContent = jsonData[0].sk.dropzone;
            assignTaskButton.textContent = jsonData[0].sk.assignTaskButton;
            pointsInput.placeholder= jsonData[0].sk.pointsInput;
            navHome.textContent = jsonData[0].sk.navHome;

        } else {
            dropzone.textContent = jsonData[0].en.dropzone;
            assignTaskButton.textContent = jsonData[0].en.assignTaskButton;
            pointsInput.placeholder= jsonData[0].en.pointsInput;
            navHome.textContent = jsonData[0].en.navHome;
        }
    }
    else {
        fetchData().then(() => {
            var language = getCookieValue();
            changeTeacher(language);
        });
    }
}

function changeStudent(language){
    var generateTaskButton = document.getElementById("generateTaskButton");
    var sendAnsweredTaskButton= document.getElementById("sendAnsweredTaskButton");
    var navText3= document.getElementById("navText3");
    var navLogout2= document.getElementById("navLogout2");
    var navHome = document.getElementById("navHome2");

    if (jsonData) { // Skontrolujte, či sú údaje z JSON súboru dostupné
        if(language== "sk"){
            generateTaskButton.value= jsonData[0].sk.loginH3;
            sendAnsweredTaskButton.value= jsonData[0].sk.loginUser;
            navText3.textContent = jsonData[0].sk.navText;
            navLogout2.textContent = jsonData[0].sk.navLogout;
            navHome.textContent = jsonData[0].sk.navHome;
        }
        else {
            generateTaskButton.value= jsonData[0].en.loginH3;
            sendAnsweredTaskButton.value= jsonData[0].en.loginUser;
            navText3.textContent = jsonData[0].en.navText;
            navLogout2.textContent = jsonData[0].sk.navLogout;
            navHome.textContent = jsonData[0].en.navHome;
        }
    }
    else {
            fetchData().then(() => {
                var language = getCookieValue();
                changeStudent(language);
            });
    }

}

function changeLogin(language) {
var loginH3= document.getElementById("loginH3");
var loginUser= document.getElementById("loginUser");
var loginPass= document.getElementById("loginPass");
var loginSubmit= document.getElementById("loginSubmit");
var loginP= document.getElementById("loginP");
var navText = document.getElementById("navText2");
var navHome = document.getElementById("navHome5");

if (jsonData) { // Skontrolujte, či sú údaje z JSON súboru dostupné
    if(language== "sk"){
        loginH3.textContent= jsonData[0].sk.loginH3;
        loginUser.textContent= jsonData[0].sk.loginUser;
        loginPass.textContent= jsonData[0].sk.loginPass;

        var loginA= loginP.getElementsByTagName("a");
        loginA[0].textContent= jsonData[0].sk.loginA;
        loginP.firstChild.textContent= jsonData[0].sk.loginP;
        loginSubmit.textContent= jsonData[0].sk.loginSubmit;
        navText.textContent = jsonData[0].sk.navText;
        navHome.textContent = jsonData[0].sk.navHome;

    }
    else {
        loginH3.textContent= jsonData[0].en.loginH3;
        loginUser.textContent= jsonData[0].en.loginUser;
        loginPass.textContent= jsonData[0].en.loginPass;
        var loginA= loginP.getElementsByTagName("a");
        loginA[0].textContent= jsonData[0].en.loginA;
        loginP.firstChild.textContent= jsonData[0].en.loginP;
        loginSubmit.textContent= jsonData[0].en.loginSubmit;
        navText.textContent = jsonData[0].en.navText;
        navHome.textContent = jsonData[0].en.navHome;
    }
}
 else {
        fetchData().then(() => {
            var language = getCookieValue();
            changeLogin(language);
        });
    }
}

function changeRegister(language) {
    var regH1= document.getElementById("regH1");
    var regH2= document.getElementById("regH2");
    var regName= document.getElementById("regName");
    var regSurname= document.getElementById("regSurname");
    var regPass= document.getElementById("regPass");
    var regSubmit = document.getElementById("regSubmit");
    var regP = document.getElementById("regP");
    var navText5 = document.getElementById("navText5");
    var navHome = document.getElementById("navHome3");

    if (jsonData) { // Skontrolujte, či sú údaje z JSON súboru dostupné
        if(language== "sk"){
            regH1.textContent= jsonData[0].sk.regH1;
            regH2.textContent= jsonData[0].sk.regH2;
            regName.textContent= jsonData[0].sk.regName;
    
            var regA= regP.getElementsByTagName("a");
            regA[0].textContent= jsonData[0].sk.regA;
            regP.firstChild.textContent= jsonData[0].sk.regP;
            regSubmit.value= jsonData[0].sk.regSubmit;
            navText5.textContent = jsonData[0].sk.navText5;
            regSurname.textContent = jsonData[0].sk.regSurname;
            regPass.textContent = jsonData[0].sk.regPass;
            navHome.textContent = jsonData[0].sk.navHome;
        }
        else {
            regH1.textContent= jsonData[0].en.regH1;
            regH2.textContent= jsonData[0].en.regH2;
            regName.textContent= jsonData[0].en.regName;
    
            var regA= regP.getElementsByTagName("a");
            regA[0].textContent= jsonData[0].en.regA;
            regP.firstChild.textContent= jsonData[0].en.regP;
            regSubmit.value= jsonData[0].en.regSubmit;
            navText5.textContent = jsonData[0].en.navText5;
            regSurname.textContent = jsonData[0].en.regSurname;
            regPass.textContent = jsonData[0].en.regPass;
            navHome.textContent = jsonData[0].en.navHome;

        }
    }
     else {
            fetchData().then(() => {
                var language = getCookieValue();
                changeRegister(language);
            });
        }
    
}