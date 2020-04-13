package Gui;

import javax.swing.*;
import java.awt.*;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;

public class Button extends JButton implements MouseListener {
        private String name;
        private String color1;
        private String color2;
        private GradientPaint gp = new GradientPaint(0, 0, Color.BLUE, 0, 20, Color.CYAN, true);
        public Button(String str){
            super(str);
            this.name = str;
        }
        public void paintComponent(Graphics g){
            Graphics2D g2d = (Graphics2D)g;
            g2d.setPaint(gp);
            g2d.fillRect(0, 0, this.getWidth(), this.getHeight());
            g2d.setColor(Color.white);
            g2d.drawString(this.name, this.getWidth() / 2 - (this.getWidth()/ 2 /4), (this.getHeight() / 2) + 5);
        }
        //Méthode appelée lors du clic de souris

        public void mouseClicked(MouseEvent event) { }

        //Méthode appelée lors du survol de la souris
        public void mouseEntered(MouseEvent event) { }

        //Méthode appelée lorsque la souris sort de la zone du bouton
        public void mouseExited(MouseEvent event) { }

        //Méthode appelée lorsque l'on presse le bouton gauche de la souris
        public void mousePressed(MouseEvent event) { }

        //Méthode appelée lorsque l'on relâche le clic de souris
        public void mouseReleased(MouseEvent event) { }
}
