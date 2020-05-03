#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "MySQL.h"

#define NB_PERIPH 2 //macro pour continuer ou non l'input des imports
MYSQL * connect_MySQL(Connection * co)
{

    MYSQL *connection, *res;            //créer un gestionnaire (ou autrement dit un objet) pour se connecter sur MySQL

    connection = mysql_init(NULL);  /*fonction qui allocalise, initialise et retourne un objet si on entre la valeur NULLE dans la fonction
                                    et qu'il y a eu assez de memoire pour contenir l'objet
                                    Mais s'il n'y a pas assez d'espace memoire, la fonction retourne NULLE*/

    mysql_options(connection,MYSQL_READ_DEFAULT_GROUP,"option");
    printf("MySQL client version: %s\n", mysql_get_client_info());

    //printf(" %s ", co->dbname);
    res = mysql_real_connect(connection, co->host, co->user, co->passwd, co->dbname, co->port, co->unix_socket, co->flag);
                                                                                        /*fonction qui retourne NULL si
                                                                                        on n'a pas réussi à se connecter sur la base,
                                                                                        Si ça marche elle retourne l'objet que nous avions
                                                                                        déjà employé pour se connecter sur MySQL (*connection)*/

    if (!res){      //S'il y a une erreur li� � la connexion, on affiche le message d'erreur puis son code d'erreur
        fprintf(stderr, "\n Error: %s [%d]\n",  mysql_error(connection), mysql_errno(connection));
        exit(1);
    }
    printf("Connection successful\n\n");
    return connection;
}
void display_data_MySQL(char *car)
{
    //char db[40] = "home services c ";
    char *db = (char *) malloc(40);
    strcat(strcpy(db, "call-out-duty "), car);
    printf(" %s ", db);
    /* CONNEXION A LA BASE DE DONNEES PERIPHERIQUES */
    Connection co = {"127.0.0.1",                       //const char *host
                    "root",                             //const char *user
                    "root",                             //const char *passwd
                    db,               //const char *dbname
                    3309,                               //unsigned int port
                    NULL,                               //const char *unix_socket
                    0};                                 //unsigned int flag

    MYSQL *connection = connect_MySQL(&co); // appel de la fonction pour se connecter à la base

    /*AFFICHAGE DES DONNES */
    mysql_query(connection, "SELECT id, name, firstname, pseudo, pwd, email, birthday, gender, phone, status, dateRegister, dateUpdated FROM users");

    MYSQL_RES *result = mysql_use_result(connection); //on enregistre les résultats de la précédente requette SQL dans un pointeur de structure
                                                      //de type MYSQL_RES

    int nb_columns = mysql_num_fields(result); //on stock le nombre de colonnes sélectionnées de la table service_provider d'après la requette
    MYSQL_ROW row; //contiendra une ligne de la table

    while((row = mysql_fetch_row(result)) != NULL) //on récupère les lignes trouvées tant que la requette en trouve
    {
        unsigned long *lengths = mysql_fetch_lengths(result); //on récupère la taille de la valeur d'une des colonnes pour une ligne trouvée
         for(int i = 0; i < nb_columns; i++){
            printf("[%.*s]", (int) lengths[i], row[i] ? row[i] : "NULL"); //on affiche les champs
         }
         printf("\n");
    }

    mysql_free_result(result); //on libère le jeu de résultat.

    mysql_close(connection); //on arrête la connexion avec la base de données périphériques
    free(db);
}

void delete_central_MySQL(MYSQL *connection)
{

    mysql_query(connection, "DELETE FROM users");
    mysql_query(connection, "DELETE FROM subscription_offer");
    mysql_query(connection, "DELETE FROM subscription");
    mysql_query(connection, "DELETE FROM bill");

    mysql_affected_rows(connection);
}
void import_MySQL()
{
    char text[1250];
    FILE *file;
    char *path = (char *) malloc(400);
    strcpy(path, "C:\\MAMP\\htdocs\\2eme annee\\Call-Out Duty\\Call-Out-Duty\\C\\C-import\\periph");
    char *n0Periph = (char *) malloc(5);
    int lengthPath;

    /* CONNEXION A LA BASE DE DONNEES CENTRALE */
    Connection co = {"127.0.0.1",               //const char *host
                    "root",                     //const char *user
                    "root",                     //const char *passwd
                    "call-out-duty central",  //const char *dbname
                    3309,                       //unsigned int port
                    NULL,                       //const char *unix_socket
                    0};                         //unsigned int flag

    MYSQL *connection = connect_MySQL(&co); // appel de la fonction pour se connecter à la base
    delete_central_MySQL(connection);

    /* IMPORT DES FICHIERS .SQL*/

    for (int i = 1; i < NB_PERIPH+1; i++){
        sprintf(n0Periph, "%d", i);
        strcat(n0Periph, ".sql");
        strcat(path, n0Periph);
        lengthPath = strlen(path);
        printf("%s\n", path);
        file = fopen(path, "r+");
        if(file == NULL){
           printf("Error: file can't be read.\n");
           fclose(file);
           continue;
        }
        while(fgets(text, 1249, file) !=  NULL) //tant que la lecture du fichier sql n'arrive à la fin...
        {
            if(strncmp(text, "INSERT", 6) == 0){ //si on retrouve les commandes INSERT...

                printf("%s\n", text);
                printf("%d\n", strlen(text));
                mysql_query(connection, text);
                mysql_affected_rows(connection);
            }
        }
        for(int j = 1; j < 6; j++){
            path[lengthPath - j] = '\0';
        }
        fclose(file);
    }

    printf("END\n");
    mysql_close(connection);
    free(path);
    free(n0Periph);
}










