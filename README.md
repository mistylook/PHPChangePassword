# PHPChangePassword
PHP Web App to change local linux password

This project enable users to change linux password via web:
1. Users will be authenticated via IMAP
2. Password changing is executed via shell script
3. Shell Script is copied to /usr/bin and allow web server users (nginx or apache) to execute sudo (visudo)

Installation:
1. Copy changepass.php and js folder to your web server
2. Copy chpasswd to /usr/bin
3. Chown chpasswd to be executeable (chmod +x /usr/bin/chpasswd)
4. Allow sudo (visudo) and add this line: web-server-user ALL=NOPASSWD: /usr/bin/chpasswd
6. Access the file (http://your.domain.com/changepass.php)

Most of the code are taken from these users/repo. Credits to them:
- https://github.com/cuongquach/chrdpass.sh
- https://github.com/samanzdev/ChangePassword

