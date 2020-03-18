
class Robot
{
  public:
      Robot();
      Robot(float x, float y, float z);
      void wirecube(GLdouble width, GLdouble height, GLdouble depth);
      void octogone(GLdouble width, GLdouble height);
      void triangle_isocele(GLdouble width, GLdouble height);
      void sphere(GLdouble radius, GLint slices, GLint stacks, GLfloat red, GLfloat green, GLfloat blue);
      void cylindre(GLdouble base, GLdouble top, GLdouble height, GLint slices, GLint stacks, GLfloat red, GLfloat green, GLfloat blue);
      void disque(GLdouble inner, GLdouble outer, GLint slices, GLint loops, GLfloat red, GLfloat green, GLfloat blue);
      void parallelo(GLfloat width, GLfloat length);
      void sphere(GLdouble radius);
      void quart_de_sphere(GLdouble radius);
      void cylindre(GLdouble base, GLdouble top, GLdouble height);
      void head(GLdouble radius);
      void cou();
      void capteurBouche();
      void eye(GLdouble radius);
      void hands();
      void oreille_gauche(GLdouble radius);
      void oreille_droite(GLdouble radius);
      void right_upper_leg();
      void right_lower_leg();
      int bgAngle;
      int cgAngle;
      int bdAngle;
      int headAngle;
      int cdAngle;
      int couAngle;
      int handAngle;
      int jambe_gauche_angle;
      int jambe_droite_angle;
      int fingersAngle;
      int hands_left;
      int hands_right;
      float orseAngle;
      float ventreAngle;
      GLUquadricObj *rul;
      GLUquadricObj *rll;
      GLUquadricObj *quadratic;
      GLUquadricObj *disk;
      
}
