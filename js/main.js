
// Generate Password

let password = document.querySelector('#paasword');

function generatePassword() {
    let chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let passwordLength = 12;
    let password = "";
    for (let i = 0; i <= passwordLength; i++) {
        let randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber + 1);
    }
    document.querySelector("#password").value = password;
}

// Copy Password

function copyPassword() {
    let copyText = document.querySelector("#password");
    copyText.select();
    copyText.setSelectionRange(0,999);
    document.execCommand("copy");
}