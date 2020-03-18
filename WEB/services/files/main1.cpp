// gcc main.cpp -o main -lopengl32 -lglu32 -lglut32


/************************************************************/
/*            TP3: Mod�lisation d'un bras articul�                 */
/************************************************************/
/*                                                            */
/*        ESGI: algorithmique pour l'infographie            */
/*                                                            */
/************************************************************/
/*                                                            */
/*  Objectif: afficher des formes 3D et illuminer la sc�ne  */
/*                                                            */
/************************************************************/





#include<windows.h>

#ifdef __APPLE__
#include <GLUT/glut.h>
#else
#include <GL/glut.h>
#endif

#include <math.h>
#include <stdlib.h>
#include <stdio.h>



static int bgAngle = 0, cgAngle = 0, bdAngle = 180, cdAngle = 180;
static int cuisseDroitAngle = 90, jambeDroitAngle = 90, cuisseGaucheAngle = 90, jambeGaucheAngle = 90;
static int torseAngle = 0, ventreAngle = 90;
float cameraAngle = 10.0;

/* prototypes de fonctions */
void initRendering();                           // Initialisation du rendu
void display();                             // mod�lisation
void reshape(int w,int h);                      // visualisation
                      // mise � jour: appelle Timer pour l'animation de la sc�ne
void keyboard(unsigned char key, int x, int y); // fonction clavier

void corps();
void brasDroit();
void brasGauche();
void jambeDroit();
void jambeGauche();

/* Programme principal */
int main(int argc,       // argc: nombre d'arguments, argc vaut au moins 1
         char **argv){  // argv: tableau de chaines de caract�res, argv[0] contient le nom du programme lanc� (plus un �ventuel chemin)


    /* Initialisation de glut et creation de la fenetre */
    glutInit(&argc, argv);                       // Initialisation
    glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB | GLUT_DEPTH); // mode d'affichage RGB, et test prafondeur
    glutInitWindowSize(800 , 600);                // dimension fen�tre
    glutInitWindowPosition (100, 100);           // position coin haut gauche
    glutCreateWindow("Projet Infographie 2I2");  // nom

    /* Initialisation d'OpenGL */
    initRendering();

    /* Enregistrement des fonctions de rappel
     => initialisation des fonctions callback appel�es par glut */
    glutDisplayFunc(display);
    glutReshapeFunc(reshape);
    glutKeyboardFunc(keyboard);

    /* rq: le callback de fonction (fonction de rappel) est une fonction qui est pass�e en argument � une
     autre fonction. Ici, le main fait usage des deux fonctions de rappel (qui fonctionnent en m�me temps)
     alors qu'il ne les conna�t pas par avance.*/



    /* Entr�e dans la boucle principale de glut, traitement des �v�nements */
    glutMainLoop();// lancement de la boucle de r�ception des �v�nements
    return 0;               // pour finir
}


/* Initialisation d'OpenGL pour le rendu de la sc�ne */
void initRendering() {

    /* Active le z-buffer */
    glEnable(GL_DEPTH_TEST);

    /* Activation des couleurs */
    glEnable(GL_COLOR_MATERIAL);

    /* d�finit la couleur d'effacement et la couleur de fond */
    glClearColor(0.0, 0.0, 0.0, 0.0);

    /*  d�finit la taille d'un pixel*/
    glPointSize(2.0);

}

/* Creation des cubes */
void wirecube(GLdouble width, GLdouble height, GLdouble depth){
    glPushMatrix();
    glScalef(width, height, depth);
    glutWireCube(1.0);
    glPopMatrix();
}

void hexagone(GLdouble width, GLdouble height, GLdouble depth){
    glPushMatrix();
        glScalef(width, height, depth);
        glBegin(GL_POLYGON);
            for (GLint i=0 ; i<6 ; i++)
                glVertex2f(cos(2*i*M_PI/6), sin(2*i*M_PI/6));
        glEnd();
    glPopMatrix();
}

void cylindre(GLdouble base, GLdouble top, GLdouble height, GLint slices, GLint stacks){
    GLUquadric* quad = gluNewQuadric();
    gluCylinder(quad, base, top, height, slices, stacks);
}

/* Cr�ation de la sc�ne */
void display(){

    /* Efface les tampons de couleur et de profondeur de l'image avec la couleur de fond.
     rq: buffer: m�moire tampon, c'est donc une surface en memoire utilis�e pour stocker une image*/
    glClear(GL_COLOR_BUFFER_BIT|GL_DEPTH_BUFFER_BIT);

    /* la mat de visualisation-mod�lisation est modifiable par d�faut */
    glMatrixMode(GL_MODELVIEW);

    /* on charge l'identit� dans la matrice de mod�lisation-visualisation*/
   // glLoadIdentity();

    /* Permet de cr�er un point de vue. D�finit une matrice de mod�lisation-visualisation et la multiplie
     � droite de lma matrice active, ici l'identit�*/
    gluLookAt(1.0, 2.0, 10.0,      // position cam�ra
              0.0, 0.0, 0.0,      // point de mire
              0.0, 1.0, 0.0);     // vecteur d'orientation cam�ra


//-------------------------------------------------------------------------//

    //Code cr�ation du robot humano�de (nao)


    glPushMatrix(); // Début robot


    /*------------------corps---------------------*/

    //torse
    glPushMatrix(); // debut torse
        glTranslatef(0.0, 0.0, 0.0);
        glRotatef((GLfloat) torseAngle, 1.0, 0.0, 0.0);
        hexagone(1.0, 1.0, 1.5);
        glTranslatef(0.0, 0.0, 0.0);
    //ventre
        glTranslatef(0.0, 0.0, -1.0);
        glRotatef((GLfloat) ventreAngle, 1.0, 0.0, 0.0);
        cylindre(0.8, 0.8, 1.5, 50, 50);
    glPopMatrix();
    //slip de guerre


    /*-------------------bras---------------------*/

    // brasDroit();
    // brasGauche();

    /*------------------jambes--------------------*/

    //jambeDroit();
    //jambeGauche();


    glPopMatrix(); //Fin robot



//-------------------------------------------------------------------------//



    /* On swap (�change) les buffers, c�d, on fait passer l'image calcul�e et dessin�e
     dans le back buffer au buffer qui va l'afficher: le front buffer (en g�n�ral), c'est le bouble buffering
     Cela �vite une image anim�e sacad�e, si elle �tait directement trac�e dans le front buffer*/
    glutSwapBuffers();

    /* On force l'affichage */
    glFlush(); // nettoie les fen�tres pr�c�dentes
}



/*  Mise en forme de la sc�ne pour l'affichage */
void reshape(int w,  // w: largeur fen�tre
             int h)  // h: hauteur fen�tre
{
    /* Viewport: cadrage. Sp�cifie la r�gion (position et taille en px) que l'image observ�e de la sc�ne occupe
     � l'�cran => r�duction et agrandissement de l'image possible*/
    glViewport(0, 0,(GLsizei) w, (GLsizei) h);

    /* Sp�cifie que la matrice de projection va �tre modifi�e  */
    glMatrixMode(GL_PROJECTION);
    glLoadIdentity();             // matrice courante: l'identit�
    //glOrtho(-2.0, 2.0, -2.0, 2.0, 1.5, 20.0);
    //glFrustum(-1.0, 1.0, -1.0, 1.0, 1.5, 20.0);

    /* Perspective avec point de fuite */
    gluPerspective(60.0,                       // angle d'ouverture vertical cam�ra
                   (GLfloat) w / (GLfloat) h,  // ratio largeur-hauteur
                   1.0,                           // plan proche z=1
                   200.0);                     // plan �loign� z=200


}

/* Fonction de gestion du clavier */
void keyboard(unsigned char key,       // Touche qui a �t� press�e
              int x, int y) {    // Coordonn�es courante de la souris

    switch (key){

        case 'w':   /* affichage du carr� plein*/
            (cgAngle += 5)%= 360;
            break;

        case 'c':   /* affichage en mode fil de fer*/
            (cgAngle -= 5)%= 360;
            break;

        case 's':   /* affichage en mode sommets seuls*/
            (bgAngle += 5)%= 360;
            break;

        case 'x':/* Quitter le programme */
            (bgAngle -= 5)%= 360;
            break;

        case 'a':/* Quitter le programme */
            (bdAngle += 5)%= 360;
            break;

        case 'z':/* Quitter le programme */
            (bdAngle -= 5)%= 360;
            break;

        case 'e':   /* affichage du carr� plein*/
            (cdAngle += 5)%= 360;
            break;

        case 'r':   /* affichage en mode fil de fer*/
            (cdAngle -= 5)%= 360;
            break;
        case 't':   /* torse */
            (torseAngle -= 5)%= 360;
            break;

        default:return;
    }
    glutPostRedisplay();
}
void corps(){

    //torse
    glPushMatrix();
        glTranslatef(0.0, 0.0, 0.0);
        glRotatef((GLfloat) torseAngle, 1.0, 0.0, 0.0);
        hexagone(1.0, 1.0, 1.5);
        glTranslatef(0.0, 0.0, 0.0);

        glTranslated(0.0, 0.0, -1.0);
        glRotatef((GLfloat) torseAngle, 1.0, 0.0, 0.0);
        hexagone(1.0, 1.0, 1.5);
        glTranslated(0.0, 0.0, 0.0);
    //ventre
        glTranslatef(0.0, 0.0, -1.0);
        glRotatef((GLfloat) ventreAngle, 1.0, 0.0, 0.0);
        cylindre(0.8, 0.8, 1.5, 50, 50);
    glPopMatrix();
    //slip de guerre
}
void brasDroit(){

    glPushMatrix();
        glTranslatef(-1.0, 1.4, 0.0);
        glRotatef((GLfloat) bdAngle, 0.0, 0.0, 1.0);
        glutWireSphere(0.3, 50, 50);
        glTranslatef(1.0, 0.0, 0.0);
        wirecube(2.0, 0.4, 1.0);

        glTranslatef(1.0, 0.0, 0.0);
        glRotatef((GLfloat) cdAngle, 0.0, 0.0, 1.0);
        glutWireSphere(0.3, 50, 50);
        glTranslatef(1.0, 0.0, 0.0);
        wirecube(2.0, 0.4, 1.0);
    glPopMatrix();
}

void brasGauche(){

    glPushMatrix();
        glTranslatef(1.0, 1.4, 0.0);
        glRotatef((GLfloat) bgAngle, 0.0, 0.0, 1.0);
        glutWireSphere(0.3, 50, 50);
        glTranslatef(1.0, 0.0, 0.0);
        wirecube(2.0, 0.4, 1.0);


        glTranslatef(1.0, 0.0, 0.0);
        glRotatef((GLfloat) cgAngle, 0.0, 0.0, 1.0);
        glutWireSphere(0.3, 50, 50);
        glTranslatef(1.0, 0.0, 0.0);
        wirecube(2.0, 0.4, 1.0);
    glPopMatrix();
}

void jambeDroit(){

    glPushMatrix();
        glTranslatef(-1.0, 1.4, 0.0);
        glRotatef((GLfloat) cuisseDroitAngle, 0.0, 0.0, 1.0);
        glutWireSphere(0.3, 50, 50);
        glTranslatef(1.0, 0.0, 0.0);
        wirecube(2.0, 0.4, 1.0);

        glTranslatef(1.0, 0.0, 0.0);
        glRotatef((GLfloat) jambeDroitAngle, 0.0, 0.0, 1.0);
        glutWireSphere(0.3, 50, 50);
        glTranslatef(1.0, 0.0, 0.0);
        wirecube(2.0, 0.4, 1.0);
    glPopMatrix();
}
void jambeGauche(){

    glPushMatrix();
        glTranslatef(1.0, 1.4, 0.0);
        glRotatef((GLfloat) cuisseGaucheAngle, 0.0, 0.0, 1.0);
        glutWireSphere(0.3, 50, 50);
        glTranslatef(1.0, 0.0, 0.0);
        wirecube(2.0, 0.4, 1.0);


        glTranslatef(1.0, 0.0, 0.0);
        glRotatef((GLfloat) jambeGaucheAngle, 0.0, 0.0, 1.0);
        glutWireSphere(0.3, 50, 50);
        glTranslatef(1.0, 0.0, 0.0);
        wirecube(2.0, 0.4, 1.0);
    glPopMatrix();
}





