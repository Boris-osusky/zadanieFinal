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
    var indexLogout= document.getElementById("indexLogout");

    if (jsonData) { // Skontrolujte, či sú údaje z JSON súboru dostupné
        if (language == "sk") {
            navText.textContent = jsonData[0].sk.navText;
            indexIntro.textContent = jsonData[0].sk.indexIntro;
            navHome.textContent = jsonData[0].sk.navHome;
            indexLogout.textContent = jsonData[0].sk.navLogout;
        } else {
            navText.textContent = jsonData[0].en.navText;
            indexIntro.textContent = jsonData[0].en.indexIntro;
            navHome.textContent = jsonData[0].en.navHome;
            indexLogout.textContent = jsonData[0].en.navLogout;
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
    var navLogout2 = document.getElementById("navLogout2");
    var navHome = document.getElementById("navHome6");
    var navText4 = document.getElementById("navText4");
    var teacherFrom = document.getElementById("teacherFrom");
    var teacherTo = document.getElementById("teacherTo");
    var teacherPoints= document.getElementById("teacherPoints");
    var teacherStudent = document.getElementById("teacherStudent");
    var teacherTask= document.getElementById("teacherTask");

    if (jsonData) { // Skontrolujte, či sú údaje z JSON súboru dostupné
        if (language == "sk") {
            dropzone.textContent = jsonData[0].sk.dropzone;
            assignTaskButton.textContent = jsonData[0].sk.assignTaskButton;
            pointsInput.placeholder= jsonData[0].sk.pointsInput;
            navHome.textContent = jsonData[0].sk.navHome;
            navLogout2.textContent = jsonData[0].sk.navLogout;
            teacherFrom.textContent = jsonData[0].sk.teacherFrom;
            teacherTo.textContent = jsonData[0].sk.teacherTo;
            teacherPoints.textContent= jsonData[0].sk.teacherPoints;
            teacherStudent.textContent = jsonData[0].sk.teacherStudent;
            teacherTask.textContent= jsonData[0].sk.teacherTask;
            navText4.textContent= jsonData[0].sk.navText;
            document.documentElement.setAttribute('lang', 'sk');

        } else {
            dropzone.textContent = jsonData[0].en.dropzone;
            assignTaskButton.textContent = jsonData[0].en.assignTaskButton;
            pointsInput.placeholder= jsonData[0].en.pointsInput;
            navHome.textContent = jsonData[0].en.navHome;
            navLogout2.textContent = jsonData[0].en.navLogout;
            teacherFrom.textContent = jsonData[0].en.teacherFrom;
            teacherTo.textContent = jsonData[0].en.teacherTo;
            teacherPoints.textContent= jsonData[0].en.teacherPoints;
            teacherStudent.textContent = jsonData[0].en.teacherStudent;
            teacherTask.textContent= jsonData[0].en.teacherTask;
            navText4.textContent= jsonData[0].en.navText;
            document.documentElement.setAttribute('lang', 'en');
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
    var navLogout2= document.getElementById("navLogout");
    var navHome = document.getElementById("navHome2");
    var answerTaskInput= document.getElementById("answerTaskInput");
    var sqrtNormal= document.getElementById("sqrtNormal");
    var sqrtHigher= document.getElementById("sqrtHigher");
    var expHigher= document.getElementById("expHigher");
    var expLower = document.getElementById("expLower");

    var sum = document.getElementById("sum");
    var sin= document.getElementById("sin");
    var cos= document.getElementById("cos");
    var tan= document.getElementById("tan");
    var frac = document.getElementById("frac");
    var lim= document.getElementById("lim");
    var integral = document.getElementById("integral");

    if (jsonData) { // Skontrolujte, či sú údaje z JSON súboru dostupné
        if(language== "sk"){
            navText3.textContent = jsonData[0].sk.navText3;
            navLogout2.textContent = jsonData[0].sk.navLogout;
            navHome.textContent = jsonData[0].sk.navHome;

            if(generateTaskButton != null) {
                answerTaskInput.placeholder = jsonData[0].sk.answerTaskInput;
                sqrtNormal.textContent= jsonData[0].sk.sqrtNormal;
                sqrtHigher.textContent= jsonData[0].sk.sqrtHigher;
                expHigher.textContent= jsonData[0].sk.expHigher;
                expLower.textContent = jsonData[0].sk.expLower;
                generateTaskButton.textContent= jsonData[0].sk.generateTaskButton;
                sendAnsweredTaskButton.textContent= jsonData[0].sk.sendAnsweredTaskButton;
                sum.textContent = jsonData[0].sk.sum;
                sin.textContent= jsonData[0].sk.sin;
                cos.textContent= jsonData[0].sk.cos;
                tan.textContent= jsonData[0].sk.tan;
                frac.textContent = jsonData[0].sk.frac;
                lim.textContent= jsonData[0].sk.lim;
                integral.textContent = jsonData[0].sk.integral;
    
            }
            document.documentElement.setAttribute('lang', 'sk');

        }
        else {
            navText3.textContent = jsonData[0].en.navText3;
            navLogout2.textContent = jsonData[0].en.navLogout;
            navHome.textContent = jsonData[0].en.navHome;
            
            if(generateTaskButton != null) {
            generateTaskButton.textContent= jsonData[0].en.generateTaskButton;
            sendAnsweredTaskButton.textContent= jsonData[0].en.sendAnsweredTaskButton;
            answerTaskInput.placeholder = jsonData[0].en.answerTaskInput;
            sqrtNormal.textContent= jsonData[0].en.sqrtNormal;
            sqrtHigher.textContent= jsonData[0].en.sqrtHigher;
            expHigher.textContent= jsonData[0].en.expHigher;
            expLower.textContent = jsonData[0].en.expLower;
        
            sum.textContent = jsonData[0].en.sum;
            sin.textContent= jsonData[0].en.sin;
            cos.textContent= jsonData[0].en.cos;
            tan.textContent= jsonData[0].en.tan;
            frac.textContent = jsonData[0].en.frac;
            lim.textContent= jsonData[0].en.lim;
            integral.textContent = jsonData[0].en.integral;
            }
            document.documentElement.setAttribute('lang', 'en');

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
        document.documentElement.setAttribute('lang', 'sk');


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
        document.documentElement.setAttribute('lang', 'en');

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
            document.documentElement.setAttribute('lang', 'sk');

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
            document.documentElement.setAttribute('lang', 'en');

        }
    }
     else {
            fetchData().then(() => {
                var language = getCookieValue();
                changeRegister(language);
            });
        }
    
}