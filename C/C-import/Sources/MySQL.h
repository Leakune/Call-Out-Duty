#include <winsock.h>
#include <MYSQL/mysql.h>

typedef struct Connection{
    const char *host;
    const char *user;
    const char *passwd;
    const char *dbname;
    unsigned int port;
    const char *unix_socket;
    unsigned int flag;
} Connection;

MYSQL * connect_MySQL(Connection *co);
void display_data_MySQL(char *car);
void delete_central_MySQL();
void import_MySQL();
