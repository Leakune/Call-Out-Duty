#include <gtk/gtk.h>
#include <stdio.h>
#include <errno.h>
#include <stdlib.h>
#include <sys/types.h>
#include <signal.h>
#include <gtk/gtkx.h>
#include <libgen.h>
#include <sys/mman.h>
#include <ctype.h>
#include <time.h>
#include <gdk-pixbuf/gdk-pixbuf.h>
#include <gobject/gobject.h>
#include <mysql.h>
#include "login.c"
#include "qrcode-png.c"


typedef struct {
    GtkWidget *w_comboboxtext_options;
  //  GtkWidget *w_lbl_sel_num;
  //  GtkWidget *w_lbl_sel_text;
    GtkWidget *ScrollWindow;
    GtkWidget *ViewPort;
    GtkWidget *TextView;
  //  GtkWidget *fixed;
    GtkWidget *movie;
} app_widgets;

char *tmp;
GtkWidget 		*pVBox;
GtkWidget       *pwindow;
GtkWidget 		*pHBox;
GtkWidget       *column1;
GtkWidget       *column2;
GtkWidget       *pFrame;
GtkWidget       *pVBoxFrame;
GtkWidget       *pLabel;
GtkWidget       *pEntry, *pLastname, *pFirstname, *pBirthdate, *pAddress, *pPc, *pCity, *pNumdomicile, *pNumpro, *pNumperso, *pNumId, *pAddressId, *pdateId;
gchar           *sUtf8;
GtkWidget       *pSeparator;
GtkWidget       *pImage;
GdkPixbuf       *pPixbuf;
GError * error = NULL;
GtkWidget       *pbtn_save;
GtkWidget       *pbtn_clean;
GtkWidget       *pbtn_logOut;

GtkWidget       *pmail;
GtkWidget       *ppassword;

char mail[20];
char password[10];
char filename[20]="qrcodes/";

//static const char* const name_inputs[]={"name", "prenom", "birthdate", "address", "postalcode", "city", "numhome", "numpro", "numperso", "numid", "addressid", "dateid"};




//char *mail=NULL;
//char *password=NULL;

char *mailtest= "med@mail.com";
char *passwordtest="medomedomedo";
const gchar *stockage;
long unsigned int small_hash_len = 40;
int fields;
MYSQL_BIND ps_params[2];

int connection=0;

void on_activate_entry(GtkWidget *pbtn_signin, gpointer data);
void on_signin_button(GtkWidget *pbtn_signin, gpointer data);
void on_logOut_button(GtkWidget *pbtn_logOut, gpointer data);
void on_save_button(GtkWidget *pbtn_save, gpointer data);
void on_clean_button(GtkWidget *pbtn_clean, gpointer data);


int main(int argc, char *argv[])
{
    //GtkWidget       *pwindow;
    //GtkWidget 		*pVBox;
    GtkWidget 		*plabeltitle;
  //  GtkWidget 		*pmail;
   // GtkWidget 		*ppassword;
    GtkWidget 		*plabelmail;
    GtkWidget 		*plabelpassword;
    GtkWidget 		*pbtn_signin;


    gtk_init(&argc, &argv);

  
    pwindow = gtk_window_new(GTK_WINDOW_TOPLEVEL);
    gtk_container_set_border_width(GTK_CONTAINER(pwindow), 10);
    gtk_window_set_title(GTK_WINDOW(pwindow), "Call Out duty - RH");
    gtk_window_set_default_size(GTK_WINDOW(pwindow), 320,400);
    g_signal_connect(G_OBJECT(pwindow), "destroy", G_CALLBACK(gtk_main_quit), NULL);

    //Partie Connexion
   
    pVBox= gtk_box_new(TRUE, 0);

    gtk_container_add(GTK_CONTAINER(pwindow), pVBox);

    //title
    plabeltitle=gtk_label_new(NULL);
    gtk_label_set_text(GTK_LABEL(plabeltitle), "Bienvenue dans votre RH platforme !");
    gtk_box_pack_start(GTK_BOX(pVBox), plabeltitle, TRUE, FALSE, 0);
    //mail and password entry and their labels
    plabelmail=gtk_label_new(NULL);
    gtk_label_set_text(GTK_LABEL(plabelmail), "Adresse mail:");
    gtk_box_pack_start(GTK_BOX(pVBox), plabelmail, TRUE, FALSE, 0);
    pmail=gtk_entry_new();
    gtk_entry_set_input_purpose(pmail, GTK_INPUT_PURPOSE_EMAIL);
    gtk_box_pack_start(GTK_BOX(pVBox), pmail, TRUE, FALSE, 0);

    plabelpassword=gtk_label_new(NULL);
    gtk_label_set_text(GTK_LABEL(plabelpassword), "Mot de passe:");
    gtk_box_pack_start(GTK_BOX(pVBox), plabelpassword, TRUE, FALSE, 0);
    ppassword=gtk_entry_new();
    gtk_entry_set_visibility(GTK_ENTRY(ppassword),FALSE);
    gtk_entry_set_invisible_char(GTK_ENTRY(ppassword), '*');
    gtk_entry_set_input_purpose(ppassword, GTK_INPUT_PURPOSE_PASSWORD);
    gtk_box_pack_start(GTK_BOX(pVBox), ppassword, TRUE, FALSE, 0);
    //Connexion button
    pbtn_signin=gtk_button_new_with_label("Connexion");
    gtk_box_pack_start(GTK_BOX(pVBox), pbtn_signin, TRUE, FALSE, 0);

    g_signal_connect(G_OBJECT(pmail), "activate",G_CALLBACK(on_activate_entry), NULL);
    g_signal_connect(G_OBJECT(ppassword), "activate",G_CALLBACK(on_activate_entry), NULL);
    g_signal_connect(G_OBJECT(pbtn_signin), "clicked", G_CALLBACK(on_signin_button), (GtkWidget*) pwindow);
   	
   	gtk_widget_show_all(pwindow);
    gtk_main();


    

  //  stockage= gtk_entry_get_text(GTK_ENTRY(pmail));
    //strcpy(mail, stockage);
    
    //printf("mail apres stockage: %s\n", mail);
    //printf("stockage apres free: %s\n", stockage);
    

  //  stockage=gtk_entry_get_text(GTK_ENTRY(ppassword));
  //  strcpy(password, stockage);
   
  //  printf("password apres stockage: %s\n", password);
 //   printf("stockage apres free: %s\n", stockage);

   /* // partie saisie (apres la connexion)

    pHBox = gtk_box_new(GTK_ORIENTATION_HORIZONTAL, 0);
    gtk_container_add(GTK_CONTAINER(pwindow), pHBox);

    // Creation des deux colonnes
    column1=gtk_box_new(TRUE, 0);
    gtk_container_add(GTK_CONTAINER(pHBox), column1);
    column2=gtk_box_new(TRUE, 0);
    gtk_container_add(GTK_CONTAINER(pHBox), column2);
    //Création du frame pour Etat civil
    pFrame= gtk_frame_new("Etat civil");
    gtk_box_pack_start(GTK_BOX(column1), pFrame, TRUE, FALSE, 0);
    //Création et insertion d'une boite pour le 1er frame
    pVBoxFrame= gtk_box_new(TRUE, 0);
    gtk_container_add(GTK_CONTAINER(pFrame), pVBoxFrame);
    //Creation et insertion des elements contenus dans le 1er frame
    pLabel= gtk_label_new("Nom :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pEntry= gtk_entry_new();
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pEntry, TRUE, FALSE, 0);
    sUtf8= g_locale_to_utf8("Prénom :", -1, NULL, NULL, NULL);
    pLabel=gtk_label_new(sUtf8);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pEntry= gtk_entry_new();
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pEntry, TRUE, FALSE, 0);
    //Creation d'un GtkSeparator
    pSeparator= gtk_separator_new(GTK_ORIENTATION_HORIZONTAL);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pSeparator, TRUE, FALSE, 0);

    pLabel= gtk_label_new("Date de naissance :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pEntry= gtk_entry_new();
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pEntry, TRUE, FALSE, 0);

    */

    
    return EXIT_SUCCESS;
}

void on_signin_button(GtkWidget *pbtn_signin, gpointer data){

 /*   // Récuperer le mail et mot de passe saisies
    
    char *mail;
    char *password;
    char *stockage;

    stockage= gtk_entry_get_text(pmail);
    strcpy(mail, stockage);
    free(stockage);
/*
    stockage=gtk_entry_get_text(ppassword);
    strcpy=(password, stockage);
    free(stockage);

/**
    // connexion bdd
    MYSQL *conn;
    MYSQL_RES *res;
    MYSQL_ROW row;

    char *server= "localhost";
    char *user= "med";
    char *password_db="medmet";
    char *database= "calloutduty";
    conn= mysql_init(NULL);

    // connection à la bdd

    if (!mysql_real_connect(conn, server, user, password_db, database, 0, NULL, 0))
    {
        fprintf(stderr, "%s\n", mysql_error(conn));
        exit(1);
    }
    

   
   

    MYSQL_STMT *stmt;
    //MYSQL_BIND ps_params[2];
    int status;

    

    char *query="SELECT id FROM rhs WHERE mail = ? AND password = ?";
    char *query_test="SELECT id FROM rhs WHERE password = ?";

    stmt=mysql_stmt_init(conn);
    status= mysql_stmt_prepare(stmt, query_test, strlen(query_test));
    memset(ps_params, 0, sizeof(ps_params));

    ps_params[0].buffer_type=MYSQL_TYPE_STRING;
    ps_params[0].buffer=&passwordtest;
    ps_params[0].buffer_length=small_hash_len;
    ps_params[0].is_null=0;
    ps_params[0].length=&small_hash_len;
  

  /*  ps_params[1].buffer_type=MYSQL_TYPE_STRING;
    ps_params[1].buffer=&passwordtest;
    ps_params[1].buffer_length=small_hash_len;
    ps_params[1].is_null=0;
    ps_params[1].length=&small_hash_len;*/
   
  /*  printf("Params0: %s\n", passwordtest);
    //printf("Params1: %s\n", mailtest);
    status= mysql_stmt_bind_param(stmt, ps_params);
    status= mysql_stmt_execute(stmt);


    // READ Results

    

    fields= mysql_stmt_field_count(stmt);
    printf("status: %d\n", status );
    printf("Fields found : %d\n", fields );


    if(mysql_stmt_field_count(stmt)){
        connection=1;
    }
    mysql_stmt_close(stmt);
    mysql_close(conn);*/
    
    strcpy(mail, gtk_entry_get_text(GTK_ENTRY(pmail)));
    strcpy(password, gtk_entry_get_text(GTK_ENTRY(ppassword)));
    
    if(gtk_entry_get_text_length(GTK_ENTRY(pmail)) && gtk_entry_get_text_length(GTK_ENTRY(ppassword)) && login(mail,password )) // verifier la connexion
    {
    printf("connection: %d\n", connection );
    printf("%s\n%s\n", gtk_entry_get_text(GTK_ENTRY(pmail)), gtk_entry_get_text(GTK_ENTRY(ppassword)));
    printf("Success Connexion !!\n");
    printf("%s\n",G_OBJECT_TYPE_NAME(pmail) );
    g_object_ref(pVBox);
    gtk_container_remove(GTK_CONTAINER(pwindow), pVBox);


    // partie saisie (apres la connexion)

    pHBox = gtk_box_new(GTK_ORIENTATION_HORIZONTAL, 0);
    gtk_container_add(GTK_CONTAINER(pwindow), pHBox);

    // Creation des deux colonnes
    column1=gtk_box_new(TRUE, 0);
    gtk_container_add(GTK_CONTAINER(pHBox), column1);
    column2=gtk_box_new(TRUE, 0);
    gtk_container_add(GTK_CONTAINER(pHBox), column2);
    //Création du frame pour Etat civil
    pFrame= gtk_frame_new("Etat civil");
    gtk_box_pack_start(GTK_BOX(column1), pFrame, TRUE, FALSE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pFrame), 5);
    //Création et insertion d'une boite pour le 1er frame
    pVBoxFrame= gtk_box_new(TRUE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pVBoxFrame), 5);
    gtk_box_set_spacing(GTK_BOX(pVBoxFrame), 5);
    gtk_container_add(GTK_CONTAINER(pFrame), pVBoxFrame);
    //Creation et insertion des elements contenus dans le 1er frame
    pLabel= gtk_label_new("Nom :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pLastname= gtk_entry_new();
    gtk_widget_set_name(pLastname, "nom");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLastname, TRUE, FALSE, 0);
    sUtf8= g_locale_to_utf8("Prénom :", -1, NULL, NULL, NULL);
    pLabel=gtk_label_new(sUtf8);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pFirstname= gtk_entry_new();
    gtk_widget_set_name(pFirstname, "prenom");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pFirstname, TRUE, FALSE, 0);
    //Creation d'un GtkSeparator
    pSeparator= gtk_separator_new(GTK_ORIENTATION_HORIZONTAL);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pSeparator, TRUE, FALSE, 0);

    pLabel= gtk_label_new("Date de naissance :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pBirthdate= gtk_entry_new();
    gtk_widget_set_name(pBirthdate, "birthdate");
    gtk_entry_set_placeholder_text(pBirthdate, "YYYY-MM-DD");
    gtk_entry_set_max_width_chars(pBirthdate, 10);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pBirthdate, TRUE, FALSE, 0);

    // Creation du frame Domicile
    pFrame= gtk_frame_new("Domicile");
    gtk_box_pack_start(GTK_BOX(column1), pFrame, TRUE, FALSE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pFrame), 5);
    //Création et insertion d'une boite pour le 2er frame
    pVBoxFrame= gtk_box_new(TRUE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pVBoxFrame), 5);
    gtk_box_set_spacing(GTK_BOX(pVBoxFrame), 5);
    gtk_container_add(GTK_CONTAINER(pFrame), pVBoxFrame);  
    //Creation et insertion des elements contenus dans le 1er frame
    pLabel= gtk_label_new("Adresse :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pAddress= gtk_entry_new();
    gtk_widget_set_name(pAddress, "address");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pAddress, TRUE, FALSE, 0);

    pLabel= gtk_label_new("Code postal :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pPc= gtk_entry_new();
    gtk_widget_set_name(pPc, "postalcode");
    gtk_entry_set_max_width_chars(pPc, 5);
    gtk_entry_set_input_purpose(pPc, GTK_INPUT_PURPOSE_NUMBER);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pPc, TRUE, FALSE, 0); 

    pLabel= gtk_label_new("Ville :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pCity= gtk_entry_new();
    gtk_widget_set_name(pCity, "city");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pCity, TRUE, FALSE, 0); 


    sUtf8=g_locale_to_utf8("Téléphones", -1, NULL, NULL, NULL);
    pFrame= gtk_frame_new(sUtf8);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(column1), pFrame, TRUE, FALSE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pFrame), 5);
    //Création et insertion d'une boite pour le 2er frame
    pVBoxFrame= gtk_box_new(TRUE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pVBoxFrame), 5);
    gtk_box_set_spacing(GTK_BOX(pVBoxFrame), 5);
    gtk_container_add(GTK_CONTAINER(pFrame), pVBoxFrame);  
    //Creation et insertion des elements contenus dans le 1er frame
    pLabel= gtk_label_new("Domicile :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pNumdomicile= gtk_entry_new();
    gtk_widget_set_name(pNumdomicile, "numhome");
    gtk_entry_set_max_width_chars(pNumdomicile, 10);
    gtk_entry_set_input_purpose(pNumdomicile, GTK_INPUT_PURPOSE_PHONE);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pNumdomicile, TRUE, FALSE, 0);

    pLabel= gtk_label_new("Professionnel :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pNumpro= gtk_entry_new();
    gtk_widget_set_name(pNumpro, "numpro");
    gtk_entry_set_max_width_chars(pNumpro, 10);
    gtk_entry_set_input_purpose(pNumpro, GTK_INPUT_PURPOSE_PHONE);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pNumpro, TRUE, FALSE, 0); 

    pLabel= gtk_label_new("Portable :");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pNumperso= gtk_entry_new();
    gtk_widget_set_name(pNumperso, "numperso");
    gtk_entry_set_max_width_chars(pNumperso, 10);
    gtk_entry_set_input_purpose(pNumperso, GTK_INPUT_PURPOSE_PHONE);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pNumperso, TRUE, FALSE, 0); 

    sUtf8=g_locale_to_utf8("Carte d'identité", -1, NULL, NULL, NULL);
    pFrame= gtk_frame_new(sUtf8);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(column2), pFrame, TRUE, FALSE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pFrame), 5);
    //Création et insertion d'une boite pour le 2er frame
    pVBoxFrame= gtk_box_new(TRUE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pVBoxFrame), 5);
    gtk_box_set_spacing(GTK_BOX(pVBoxFrame), 5);
    gtk_container_add(GTK_CONTAINER(pFrame), pVBoxFrame);  
    //Creation et insertion des elements contenus dans le 1er frame
    sUtf8=g_locale_to_utf8("Numéro de carte :", -1, NULL, NULL, NULL);
    pLabel= gtk_label_new(sUtf8);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pNumId= gtk_entry_new();
    gtk_widget_set_name(pNumId, "numid");
    gtk_entry_set_input_purpose(pNumId, GTK_INPUT_PURPOSE_NUMBER);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pNumId, TRUE, FALSE, 0);

    sUtf8=g_locale_to_utf8("lieu d'émission :", -1, NULL, NULL, NULL);
    pLabel= gtk_label_new(sUtf8);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pAddressId= gtk_entry_new();
    gtk_widget_set_name(pAddressId, "addressid");
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pAddressId, TRUE, FALSE, 0); 

    sUtf8=g_locale_to_utf8("Date d'émission :", -1, NULL, NULL, NULL);
    pLabel= gtk_label_new(sUtf8);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pLabel, TRUE, FALSE, 0);
    pdateId= gtk_entry_new();
    gtk_widget_set_name(pdateId, "dateid");
    gtk_entry_set_placeholder_text(pdateId, "YYYY-MM-DD");
    gtk_entry_set_max_width_chars(pdateId, 10);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pdateId, TRUE, FALSE, 0);

    pFrame= gtk_frame_new("QRCODE");
    gtk_box_pack_start(GTK_BOX(column2), pFrame, TRUE, FALSE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pFrame), 5);

    pVBoxFrame= gtk_box_new(TRUE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pVBoxFrame), 5);
    gtk_box_set_spacing(GTK_BOX(pVBoxFrame), 5);
    gtk_container_add(GTK_CONTAINER(pFrame), pVBoxFrame); 

    pPixbuf=gdk_pixbuf_new_from_file_at_size("qrcode.png", 200, 400, &error);
    pImage= gtk_image_new_from_pixbuf(pPixbuf);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pImage, FALSE, FALSE, 5);
    sUtf8=g_locale_to_utf8("Génération du QRCODE et sauvegarde des données :", -1, NULL, NULL, NULL);
    pFrame= gtk_frame_new(sUtf8);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(column2), pFrame, TRUE, FALSE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pFrame), 5);

    pVBoxFrame= gtk_box_new(TRUE, 0);
    gtk_container_set_border_width(GTK_CONTAINER(pVBoxFrame), 5);
    gtk_box_set_spacing(GTK_BOX(pVBoxFrame), 5);
    gtk_container_add(GTK_CONTAINER(pFrame), pVBoxFrame);

    
    sUtf8=g_locale_to_utf8("Enregistrer les données", -1, NULL, NULL, NULL);
    pbtn_save=gtk_button_new_with_label(sUtf8);
    gtk_widget_set_margin_top(pbtn_save, 5);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pbtn_save, TRUE, FALSE, 0);
    g_signal_connect(G_OBJECT(pbtn_save), "clicked", G_CALLBACK(on_save_button),(GtkWidget*) pwindow);

    sUtf8=g_locale_to_utf8("Vider les champs", -1, NULL, NULL, NULL);
    pbtn_clean=gtk_button_new_with_label(sUtf8);
    gtk_widget_set_margin_top(pbtn_clean, 5);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pbtn_clean, TRUE, FALSE, 0);
    g_signal_connect(G_OBJECT(pbtn_clean), "clicked", G_CALLBACK(on_clean_button),(GtkWidget*) pwindow);

    pSeparator= gtk_separator_new(GTK_ORIENTATION_HORIZONTAL);
    gtk_widget_set_margin_top(pSeparator, 10);
    gtk_widget_set_margin_bottom(pSeparator, 10);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pSeparator, TRUE, FALSE, 0);


    sUtf8=g_locale_to_utf8("Déconnexion", -1, NULL, NULL, NULL);
    pbtn_logOut=gtk_button_new_with_label(sUtf8);
    gtk_widget_set_margin_bottom(pbtn_logOut, 5);
    g_free(sUtf8);
    gtk_box_pack_start(GTK_BOX(pVBoxFrame), pbtn_logOut, TRUE, FALSE, 0);
    g_signal_connect(G_OBJECT(pbtn_logOut), "clicked", G_CALLBACK(on_logOut_button), (GtkWidget*) pwindow);




      



    gtk_widget_show_all(pwindow);
    }else{

        GtkWidget* connexionfailed = gtk_message_dialog_new(
       GTK_WINDOW(data), GTK_DIALOG_MODAL, GTK_MESSAGE_ERROR, GTK_BUTTONS_OK,
        "Erreur d'authentification !");

        gtk_message_dialog_format_secondary_text(
        GTK_MESSAGE_DIALOG(connexionfailed),
        "mot de passe ou mail incorrect");

        gtk_dialog_run(GTK_DIALOG(connexionfailed));
        gtk_widget_destroy(connexionfailed);
        
    }

}
void on_activate_entry(GtkWidget *pEntry, gpointer data){


}
void on_logOut_button(GtkWidget *pbtn_save, gpointer data){
    connection=0;
 //   printf("mail avant vidage: %s\n", mail);
//    printf("password avant vidage: %s\n", password);
//    mail= NULL;
//    password= NULL;
 //   ps_params[0].buffer=&mail;
//  ps_params[1].buffer=&password;
 //   free((char*)stockage);
    printf("Fields found : %d\n", fields );
    printf("connection: %d\napres vidage:\n", connection );
 //   printf("Mail: %s\npassword: %s\n", mail, password);
 //   printf("stockage apres free: %s\n", stockage);

    printf("_---------------------------_\n");

    GtkWidget *pQuestion;

    pQuestion= gtk_message_dialog_new(GTK_WINDOW(data),GTK_DIALOG_MODAL,
        GTK_MESSAGE_QUESTION,
        GTK_BUTTONS_YES_NO,
        "Confirmation");
    gtk_message_dialog_format_secondary_text(
        GTK_MESSAGE_DIALOG(pQuestion),
        "Voulez-vous vraiment\nse deconnecter?");

     switch(gtk_dialog_run(GTK_DIALOG(pQuestion)))
    {
        case GTK_RESPONSE_YES:
            /* OUI -> on quitte l application */
            clean_inputs();
            memset(password, 0, sizeof(password));
            memset(mail, 0, sizeof(mail));
            gtk_entry_set_text(GTK_ENTRY(pmail), "");
            gtk_entry_set_text(GTK_ENTRY(ppassword),"");
            gtk_widget_destroy(pQuestion);
            gtk_container_remove(GTK_CONTAINER(pwindow), pHBox);
            gtk_container_add(GTK_CONTAINER(pwindow), pVBox);
            gtk_widget_show_all(pwindow);
            break;
        case GTK_RESPONSE_NO:
            /* NON -> on détruit la boite de message */
            gtk_widget_destroy(pQuestion);
            break;
    }


   
}

void on_save_button(GtkWidget *pbtn_save, gpointer data){

    if(check_input() && check_bdd()){
        printf("Successfully check input\n");
        char qrcode_content[40]="Prestataire :";
        strcat(strcat(strcat(qrcode_content, gtk_entry_get_text(GTK_ENTRY(pLastname)))," , carte d identite N :" ), gtk_entry_get_text(GTK_ENTRY(pNumId)));

        QRcode *myqrcode;
        myqrcode = QRcode_encodeString(qrcode_content, 4, QR_ECLEVEL_H, QR_MODE_8,1);
        
        strcat(strcat(filename, gtk_entry_get_text(GTK_ENTRY(pLastname))), ".png");
        writePNG(myqrcode,filename);
        QRcode_free(myqrcode);


        GdkPixbuf  *pPixbuf2=gdk_pixbuf_new_from_file_at_size(filename, 200, 400, &error);
        gtk_image_set_from_pixbuf(pImage, pPixbuf2);

        gtk_widget_show_all(pwindow);
        if(save_data()){
            printf("SUCESS DATA SAVED TO DATABASE\n");
        GtkWidget* confirmation = gtk_message_dialog_new(
       GTK_WINDOW(data), GTK_DIALOG_MODAL, GTK_MESSAGE_INFO, GTK_BUTTONS_OK,
        "Confirmation Saisie");

          gtk_message_dialog_format_secondary_text(
        GTK_MESSAGE_DIALOG(confirmation),
        "Votre prestataire a été bien enregistré");

        gtk_dialog_run(GTK_DIALOG(confirmation));
        gtk_widget_destroy(confirmation);

            
        }

    }else{
        printf("failed check input\n");
        GtkWidget* failedsaisie = gtk_message_dialog_new(
       GTK_WIDGET(data), GTK_DIALOG_MODAL, GTK_MESSAGE_INFO, GTK_BUTTONS_OK,
        "Champs vides !\n%s", "Veuillez remplir tous les champs");

        gtk_dialog_run(GTK_DIALOG(failedsaisie));
        gtk_widget_destroy(failedsaisie);
    }


}

void on_clean_button(GtkWidget *pbtn_clean, gpointer data){

    GtkWidget *pQuestionclean;

    pQuestionclean= gtk_message_dialog_new(GTK_WINDOW(data),GTK_DIALOG_MODAL,
        GTK_MESSAGE_QUESTION,
        GTK_BUTTONS_YES_NO,
        "Voulez-vous vraiment\nvider les champs ?");


     switch(gtk_dialog_run(GTK_DIALOG(pQuestionclean)))
    {
        case GTK_RESPONSE_YES:
            /* OUI -> on quitte l application */
            clean_inputs();
            gtk_widget_destroy(pQuestionclean);
            break;
        case GTK_RESPONSE_NO:
            /* NON -> on détruit la boite de message */
            gtk_widget_destroy(pQuestionclean);
            break;
    }


   
}


int check_input(){

GtkWidget *entries[12]={ pLastname, pFirstname, pBirthdate, pAddress, pPc, pCity, pNumdomicile, pNumpro, pNumperso, pNumId, pAddressId, pdateId};

    for(int i=0; i<12; i++){
        if(!gtk_entry_get_text_length(GTK_ENTRY(entries[i]))){
            return 0;
        }
    }
    return 1;
    

}
void clean_inputs(){
GtkWidget *inputs[12]={ pLastname, pFirstname, pBirthdate, pAddress, pPc, pCity, pNumdomicile, pNumpro, pNumperso, pNumId, pAddressId, pdateId};

     for(int i=0; i<12; i++){
       gtk_entry_set_text(GTK_ENTRY(inputs[i]), "");
    }
    gtk_image_set_from_pixbuf(pImage, pPixbuf);
}
int check_bdd(){
     char sqlStr[150];


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

    strcpy (sqlStr, "SELECT prestataire_id FROM prestataire WHERE numid=?");

    if (mysql_stmt_prepare(statement, sqlStr, strlen(sqlStr))) {
        fprintf(stderr, "ERROR:mysql_stmt_prepare() failed. Error:%s\nsql:%s\n", mysql_stmt_error(statement), sqlStr);
        exit(1);
    }

    MYSQL_BIND ps_params[1];
    memset(ps_params, 0, sizeof(ps_params));
    char card_id[12];
    strcpy(card_id, gtk_entry_get_text(GTK_ENTRY(pNumId)));
    long unsigned int  small_hash_len = strlen(card_id);
    ps_params[0].buffer_type = MYSQL_TYPE_STRING;
    ps_params[0].buffer = &card_id;
    ps_params[0].buffer_length = small_hash_len;
    ps_params[0].length = &small_hash_len;
    ps_params[0].is_null =0;


    if (mysql_stmt_bind_param(statement, ps_params)) {
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
        boolean=0;
        
    }else{
        boolean=1;

    }
    return boolean;

}
int save_data(){
   char savestr[300];
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

    strcpy (savestr, "INSERT INTO prestataire (lastname, firstname, birth_date, address, cp, city, phonehome, phonepro, phonepers, numid, placeid, dateid, qrcode) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");

    if (mysql_stmt_prepare(statement, savestr, strlen(savestr))) {
        fprintf(stderr, "ERROR:mysql_stmt_prepare() failed. Error:%s\nsql:%s\n", mysql_stmt_error(statement), savestr);
        exit(1);
    }

    MYSQL_BIND input_bind[13];
    memset(input_bind, 0, sizeof(input_bind));
    printf("bind data: lastname\n");
    char lastname_value[20];
    strcpy(lastname_value, gtk_entry_get_text(GTK_ENTRY(pLastname)));
    long unsigned int  small_hash_len = strlen(lastname_value);
    input_bind[0].buffer_type = MYSQL_TYPE_STRING;
    input_bind[0].buffer = &lastname_value;
    input_bind[0].buffer_length = small_hash_len;
    input_bind[0].length = &small_hash_len;
    input_bind[0].is_null =0;

    printf("bind data: firstname\n");
    char firstname_value[20];
    strcpy(firstname_value, gtk_entry_get_text(GTK_ENTRY(pFirstname)));
    long unsigned int  small_hash_len1 = strlen(firstname_value);
    input_bind[1].buffer_type = MYSQL_TYPE_STRING;
    input_bind[1].buffer = &firstname_value;
    input_bind[1].buffer_length = small_hash_len1;
    input_bind[1].length = &small_hash_len1;
    input_bind[1].is_null =0;

    printf("bind data: birthdate\n");
    char birthdate_value[20];
    strcpy(birthdate_value, gtk_entry_get_text(GTK_ENTRY(pBirthdate)));
    long unsigned int  small_hash_len2 = strlen(birthdate_value);
    input_bind[2].buffer_type = MYSQL_TYPE_STRING;
    input_bind[2].buffer = &birthdate_value;
    input_bind[2].buffer_length = small_hash_len2;
    input_bind[2].length = &small_hash_len2;
    input_bind[2].is_null =0;

    printf("bind data: address\n");
    char address_value[40];
    strcpy(address_value, gtk_entry_get_text(GTK_ENTRY(pAddress)));
    long unsigned int  small_hash_len3 = strlen(address_value);
    input_bind[3].buffer_type = MYSQL_TYPE_STRING;
    input_bind[3].buffer = &address_value;
    input_bind[3].buffer_length = small_hash_len3;
    input_bind[3].length = &small_hash_len3;
    input_bind[3].is_null =0;

    printf("bind data: cp_value\n");
    char cp_value[12];
    strcpy(cp_value, gtk_entry_get_text(GTK_ENTRY(pPc)));
    long unsigned int  small_hash_len4 = strlen(cp_value);
    input_bind[4].buffer_type = MYSQL_TYPE_STRING;
    input_bind[4].buffer = &cp_value;
    input_bind[4].buffer_length = small_hash_len4;
    input_bind[4].length = &small_hash_len4;
    input_bind[4].is_null =0;

    printf("bind data: city\n");
    char city_value[20];
    strcpy(city_value, gtk_entry_get_text(GTK_ENTRY(pCity)));
    long unsigned int  small_hash_len5 = strlen(city_value);
    input_bind[5].buffer_type = MYSQL_TYPE_STRING;
    input_bind[5].buffer = &city_value;
    input_bind[5].buffer_length = small_hash_len5;
    input_bind[5].length = &small_hash_len5;
    input_bind[5].is_null =0;

    printf("bind data: numhome\n");
    char numhome_value[12];
    strcpy(numhome_value, gtk_entry_get_text(GTK_ENTRY(pNumdomicile)));
    long unsigned int  small_hash_len6 = strlen(numhome_value);
    input_bind[6].buffer_type = MYSQL_TYPE_STRING;
    input_bind[6].buffer = &numhome_value;
    input_bind[6].buffer_length = small_hash_len6;
    input_bind[6].length = &small_hash_len6;
    input_bind[6].is_null =0;
  

    printf("bind data: numpro\n");
    char numpro_value[12];
    strcpy(numpro_value, gtk_entry_get_text(GTK_ENTRY(pNumpro)));
    long unsigned int  small_hash_len7 = strlen(numpro_value);
    input_bind[7].buffer_type = MYSQL_TYPE_STRING;
    input_bind[7].buffer = &numpro_value;
    input_bind[7].buffer_length = small_hash_len7;
    input_bind[7].length = &small_hash_len7;
    input_bind[7].is_null =0;

    printf("bind data: numperso\n");
    char numperso_value[12];
    strcpy(numperso_value, gtk_entry_get_text(GTK_ENTRY(pNumperso)));
    long unsigned int  small_hash_len8 = strlen(numperso_value);
    input_bind[8].buffer_type = MYSQL_TYPE_STRING;
    input_bind[8].buffer = &numperso_value;
    input_bind[8].buffer_length = small_hash_len8;
    input_bind[8].length = &small_hash_len8;
    input_bind[8].is_null =0;

    printf("bind data: card_id\n");
    char card_id[12];
    strcpy(card_id, gtk_entry_get_text(GTK_ENTRY(pNumId)));
    long unsigned int  small_hash_len9 = strlen(card_id);
    input_bind[9].buffer_type = MYSQL_TYPE_STRING;
    input_bind[9].buffer = &card_id;
    input_bind[9].buffer_length = small_hash_len9;
    input_bind[9].length = &small_hash_len9;
    input_bind[9].is_null =0;

    printf("bind data: addressid\n");
    char addressid_value[50];
    strcpy(addressid_value, gtk_entry_get_text(GTK_ENTRY(pAddressId)));
    long unsigned int  small_hash_len10 = strlen(addressid_value);
    input_bind[10].buffer_type = MYSQL_TYPE_STRING;
    input_bind[10].buffer = &addressid_value;
    input_bind[10].buffer_length = small_hash_len10;
    input_bind[10].length = &small_hash_len10;
    input_bind[10].is_null =0;

    printf("bind data: dateid\n");
    char dateid_value[20];
    strcpy(dateid_value, gtk_entry_get_text(GTK_ENTRY(pdateId)));
    long unsigned int  small_hash_len11 = strlen(dateid_value);
    input_bind[11].buffer_type = MYSQL_TYPE_STRING;
    input_bind[11].buffer = &dateid_value;
    input_bind[11].buffer_length = small_hash_len11;
    input_bind[11].length = &small_hash_len11;
    input_bind[11].is_null =0;

    printf("bind data: qrcode\n");
    char qrcode_value[30];
    strcpy(qrcode_value, filename);
    long unsigned int  small_hash_len12 = strlen(qrcode_value);
    input_bind[12].buffer_type = MYSQL_TYPE_STRING;
    input_bind[12].buffer = &qrcode_value;
    input_bind[12].buffer_length = small_hash_len12;
    input_bind[12].length = &small_hash_len12;
    input_bind[12].is_null =0;


    if (mysql_stmt_bind_param(statement, input_bind)) {
        fprintf(stderr, "ERROR:mysql_stmt_bind_param failed\n");
        exit(1);
    }

    if (mysql_stmt_execute(statement)) {
        fprintf(stderr, "mysql_stmt_execute(), failed. Error:%s\n", mysql_stmt_error(statement));
        exit(1);
        
    }else{

    return 1;
    }
   
}

void on_window_main_destroy()
{
    gtk_main_quit();
}
