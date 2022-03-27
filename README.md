# PHPChangePassword
PHP Web App to change local linux password

This project enable users to change linux password via web:
1. Users will be authenticated via IMAP
2. Password changing is executed via shell script
3. Shell Script is copied to /usr/bin and allow web server users (nginx or apache) to execute sudo (visudo)


Most of the code are taken from these users/repo. Credits to them:
https://github.com/cuongquach/chrdpass.sh
https://github.com/samanzdev/ChangePassword

