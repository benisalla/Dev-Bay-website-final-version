// function sendEmail() {
//     Email.send({
//         Host: "smtp.yourisp.com",
//         Username: "username",
//         Password: "password",
//         To: "them@website.com",
//         From: "you@isp.com",
//         Subject: "This is the subject",
//         Body: "And this is the body",
//     }).then((message) => alert(message));
// }




const btn = document.querySelector(".btn-dark-light");

CheckAndChange();

btn.addEventListener("click", () => {
    btn.classList.toggle("active");
    localStorage.setItem("isDark", btn.classList.contains("active"));
    CheckAndChange();
});

function CheckAndChange() {
    if (localStorage.getItem("isDark") === 'true') {
        btn.classList.add('active');
        document.documentElement.style.setProperty("--darkBlue", "#000066");
        document.documentElement.style.setProperty("--light", "#042344f5");
        document.documentElement.style.setProperty("--lightBG", "#10467ef5");
        document.documentElement.style.setProperty("--theme", "rgb(20, 19, 19)");
        document.documentElement.style.setProperty("--midBlue", "#122d4b");
        document.documentElement.style.setProperty("--darkerblue", "#122d4b");
        document.documentElement.style.setProperty("--header", "#adc3e6");
        document.documentElement.style.setProperty("--green", "#16e016");
        document.documentElement.style.setProperty("--whiteText", "#fff");
        document.documentElement.style.setProperty("--toggleColor", "#fff");
        document.documentElement.style.setProperty("--iconColor", "#16e016");
    } else {
        document.documentElement.style.setProperty("--darkBlue", "#000066");
        document.documentElement.style.setProperty("--light", "#dfe7eb");
        document.documentElement.style.setProperty("--lightBG", "#fff");
        document.documentElement.style.setProperty("--theme", "#fff");
        document.documentElement.style.setProperty("--midBlue", "#073e7e");
        document.documentElement.style.setProperty("--darkerblue", "#061429");
        document.documentElement.style.setProperty("--header", "#091E3E");
        document.documentElement.style.setProperty("--green", "#16e016");
        document.documentElement.style.setProperty("--whiteText", "#073e7e");
        document.documentElement.style.setProperty("--toggleColor", "#000066");
        document.documentElement.style.setProperty("--iconColor", "#06A3DA");
    }
}
