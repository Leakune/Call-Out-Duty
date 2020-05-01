#include <mysql.h>
#include <stdio.h>
#include <string.h>


int login(char mail[], char password[])
{
    char sqlStr[300];


    MYSQL *mysql = mysql_init(NULL);
    if (mysql == NULL) {
        fprintf(stderr, "ERROR:mysql_init() failed.\n");
        exit(1);
    }

    const char* host = "localhost";
    const char* user = "med";
    const char* passwd = "medmet";
    const char* db = "calloutduty";

    if (mysql_real_connect(mysql, host, user, passwd, db, 0, NULL, 0) == NULL) {
        fprintf(stderr, "ERROR:mysql_real_connect() failed.\n");
        exit(1);
    }


    MYSQL_STMT *statement = NULL;
    statement = mysql_stmt_init(mysql);
    if (statement == NULL) {
        fprintf(stderr, "ERROR:mysql_stmt_init() failed.\n");
        exit(1);
    }

    strcpy (sqlStr, "SELECT id FROM rhs WHERE password=? AND mail=?");

    if (mysql_stmt_prepare(statement, sqlStr, strlen(sqlStr))) {
        fprintf(stderr, "ERROR:mysql_stmt_prepare() failed. Error:%s\nsql:%s\n", mysql_stmt_error(statement), sqlStr);
        exit(1);
    }

    MYSQL_BIND input_bind[2];
    memset(input_bind, 0, sizeof(input_bind));
       // char password[10];
    char first_input[10];
    char second_input[20];
    strcpy(second_input, mail);
    strcpy(first_input, password);
    long unsigned int  small_hash_len = strlen(first_input);
    long unsigned int  small_hash_len1 = strlen(second_input);

    input_bind[0].buffer_type = MYSQL_TYPE_STRING;
    input_bind[0].buffer = &first_input;
    input_bind[0].buffer_length = small_hash_len;
    input_bind[0].length = &small_hash_len;
    input_bind[0].is_null =0;

    input_bind[1].buffer_type = MYSQL_TYPE_STRING;
    input_bind[1].buffer = &second_input;
    input_bind[1].buffer_length = small_hash_len1;
    input_bind[1].length = &small_hash_len1;
    input_bind[1].is_null =0;

    if (mysql_stmt_bind_param(statement, input_bind)) {
        fprintf(stderr, "ERROR:mysql_stmt_bind_param failed\n");
        exit(1);
    }

    if (mysql_stmt_execute(statement)) {
        fprintf(stderr, "mysql_stmt_execute(), failed. Error:%s\n", mysql_stmt_error(statement));
        exit(1);
    }

    /* Fetch result set meta information */
    MYSQL_RES* prepare_meta_result = mysql_stmt_result_metadata(statement);
    if (!prepare_meta_result)
    {
        fprintf(stderr,
                " mysql_stmt_result_metadata(), \
                returned no meta information\n");
        fprintf(stderr, " %s\n", mysql_stmt_error(statement));
        exit(1);
    }

    /* Get total columns in the query */
    int column_count= mysql_num_fields(prepare_meta_result);
    if (column_count != 1) /* validate column count */
    {
        fprintf(stderr, " invalid column count returned by MySQL\n");
        exit(1);
    }

    /* Bind single result column, expected to be a double. */
    MYSQL_BIND result_bind[1];
    memset(result_bind, 0, sizeof(result_bind));

    
    int result_double;
   // unsigned long result_len = 0;
    int result=0, boolean;
    result_bind[0].buffer_type = MYSQL_TYPE_LONG;
    result_bind[0].buffer = (char *)&result_double;
  //  result_bind[0].buffer_length = sizeof(result_double);
    result_bind[0].length = 0;
    result_bind[0].is_null = 0;

    if (mysql_stmt_bind_result(statement, result_bind)) {
        fprintf(stderr, "mysql_stmt_bind_Result(), failed. Error:%s\n", mysql_stmt_error(statement));
        exit(1);
    }

    while (!mysql_stmt_fetch(statement)) {
       result=result_double;
            
        
    }
      if(result != 0){
        boolean=1;
        
    }else{
        boolean=0;

    }
    return boolean;
}