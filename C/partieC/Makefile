glade:
	gcc -o gladewin main.c -Wall `pkg-config --cflags --libs gtk+-3.0` -rdynamic
qrcode:
	gcc -o tester qrcode.c -Wall `mysql_config --cflags --libs` `pkg-config --cflags --libs gtk+-3.0` -rdynamic
sql:
	gcc -o mysql db.c -Wall `mysql_config --cflags --libs` -rdynamic
sqlgen:
	gcc -o sqlgen qrcode_gen.c
qrcodepng:
	gcc -o png qrcode-png.c -Wall `pkg-config --cflags --libs libpng16` `pkg-config --cflags --libs libqrencode`
qrcodemed:
	gcc -o med /Users/mohamedelmatror/Desktop/myproject/QR-Code-generator-master/c/qrcodemed.c -l/Users/mohamedelmatror/Desktop/myproject/QR-Code-generator-master/c/qrcodegen.h -Wall
login:
	gcc -o login-test test-login.c -Wall `mysql_config --cflags --libs` -rdynamic
qrcodesave:
	gcc -o testerwin qrcode.c -Wall `mysql_config --cflags --libs` `pkg-config --cflags --libs gtk+-3.0` `pkg-config --cflags --libs libpng16` `pkg-config --cflags --libs libqrencode` -rdynamic
