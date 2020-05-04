#include <stdio.h>
#include <stdlib.h>
#include "MySQL.h"

#define END 5
int main(int argc, char **argv)
{
    int choice;//Choix d'une option pour le menu
    printf("\n**************** Welcome! ****************\n");
    do{
        printf("\nWhat do you want? Tap a digit in order to do the corresponding instructions:\n"
               "1/ Display the list of the users of peripheral 1.\n"
               "2/ Display the list of the users of peripheral 2.\n"
               "3/ Display the list of the users of central.\n"
               "4/ Import data from peripheral in the central.\n"
               "5/ Quit the program.\n");

        scanf("%d", &choice);

        switch(choice){
            /* AFFICHAGE DE LA LISTE DES DONNEES DES PERIPHERIQUES */
            case 1:
                display_data_MySQL("p1"); //appel de la fonction pour afficher les utilisateurs du périphérique
                break;
            case 2:
                display_data_MySQL("p2"); //appel de la fonction pour afficher les utilisateurs du périphérique
                break;
            case 3:
            /* AFFICHAGE DE LA LISTE DES DONNEES DU CENTRAL */
                display_data_MySQL("central"); //appel de la fonction pour afficher les données du central
                break;
            /* IMPORT */
            case 4:
                import_MySQL();
                break;
            /* FIN DE L'UTILISATION DU LOGICIEL DAEMON */
            case END:
                printf("You have chosen to quit. See you soon!\n");
                break;

            /* ERREUR LORS DU CHOIX */
            default:
                printf("Wrong answer, please choose a right one!\n");
                break;
        }

    }
    while(choice != END);

    return EXIT_SUCCESS;
}
