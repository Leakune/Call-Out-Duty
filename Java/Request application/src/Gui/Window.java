package Gui;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.*;

public class Window extends JFrame{
      private JPanel container = new JPanel();
      private JPanel panButtons = new JPanel();
      private JPanel panInputs = new JPanel();
      private JTextField selectField = new JTextField();
      private String contentSelectField;
      private JComboBox fromComboBox;
      private String contentFromComboBox;
      private JTextField whereField = new JTextField();
      private String contentWhereField;
      private Button okButton = new Button("OK");
      private JLabel labelSelect = new JLabel("SELECT");
      private JLabel labelFrom = new JLabel("FROM");
      private JLabel labelWhere = new JLabel("WHERE");
      private String displayResults="";

    public Window(){
        //fenêtre
        this.setTitle("Call-Out Duty");
        this.setSize(600, 500);
        this.setLocationRelativeTo(null);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.setResizable(false);
        this.setUndecorated(false);

        //label
        Font fontLabel = new Font("Arial", Font.BOLD, 16);
        labelSelect.setFont(fontLabel);
        labelFrom.setFont(fontLabel);
        labelWhere.setFont(fontLabel);
        labelSelect.setForeground(Color.RED);
        labelFrom.setForeground(Color.BLUE);
        labelWhere.setForeground(Color.BLACK);
        //label.setHorizontalAlignment(JLabel.CENTER);

        //Panel Inputs
        Font fontField = new Font("Arial", Font.PLAIN, 12);
        panInputs.setLayout(new GridLayout(3,1));
        panInputs.setBackground(Color.white);
        panInputs.setPreferredSize(new Dimension(220, 60));
        panInputs.setBorder(BorderFactory.createTitledBorder("Formulaire pour réaliser une requête de la base de données"));
            //SELECT
             JPanel panSelect = new JPanel();
             selectField.setFont(fontField);
             selectField.setPreferredSize(new Dimension(250, 30));
             selectField.setForeground(Color.BLUE);
             panSelect.add(labelSelect);
             panSelect.add(selectField);
            //FROM
             JPanel panFrom = new JPanel();
             String[] fromComBoxList = {
                     "users",
                     "services",
                     "category",
                     "subscription",
                     "subscription_offer",
                     "address",
                     "city",
                     "region",
                     "bill",
                     "cost_estimate",
                     "reservation"
             };
             fromComboBox = new JComboBox(fromComBoxList);
             fromComboBox.setFont(fontField);
             fromComboBox.setPreferredSize(new Dimension(150, 30));
             fromComboBox.setForeground(Color.BLUE);
             panFrom.add(labelFrom);
             panFrom.add(fromComboBox);
            //WHERE
             JPanel panWhere = new JPanel();
             whereField.setFont(fontField);
             whereField.setPreferredSize(new Dimension(250, 30));
             whereField.setForeground(Color.BLUE);
             panWhere.add(labelWhere);
             panWhere.add(whereField);

        panInputs.add(panSelect);
        panInputs.add(panFrom);
        panInputs.add(panWhere);

        //Panel Buttons
        //okButton.setEnabled(false);
        panButtons.add(okButton);

        //Panel container
        container.setLayout(new BorderLayout());
        container.add(panInputs, BorderLayout.CENTER);
        container.add(panButtons, BorderLayout.SOUTH);

        //listener
        selectField.addActionListener(new SelectFieldListener());
        fromComboBox.addActionListener(new FromComboBoxListener());
        whereField.addActionListener(new WhereFieldListener());
//        if(contentSelectField != null && contentFromComboBox != null)
//            okButton.setEnabled(true);

        okButton.addActionListener(new OkBoutonListener());
//        button.addActionListener(new BoutonListener());
//        button.addActionListener(new Bouton3Listener());
//        button2.addActionListener(new Bouton2Listener());

        this.setContentPane(container);

        this.setVisible(true);
    }
    class SelectFieldListener implements ActionListener{
        //Redéfinition de la méthode actionPerformed()
        public void actionPerformed(ActionEvent arg0) {
            contentSelectField = selectField.getText();
            System.out.println("In select field: " + contentSelectField);
        }
    }
    class FromComboBoxListener implements ActionListener{
        //Redéfinition de la méthode actionPerformed()
        public void actionPerformed(ActionEvent arg0) {
            contentFromComboBox = fromComboBox.getSelectedItem().toString();
            System.out.println("In from ComboBox: " + contentFromComboBox);
        }
    }
    class WhereFieldListener implements ActionListener{
        //Redéfinition de la méthode actionPerformed()
        public void actionPerformed(ActionEvent arg0) {
            contentWhereField = whereField.getText();
            System.out.println("In select field: " + contentWhereField);
        }
    }
    class OkBoutonListener implements ActionListener{
        //Redéfinition de la méthode actionPerformed()
        public void actionPerformed(ActionEvent arg0) {
            //Boîte du message d'information
            JOptionPane jop1 = new JOptionPane();
            String request = "SELECT " + contentSelectField + " FROM " + contentFromComboBox;
            if(contentWhereField != null) request += " WHERE " + contentWhereField + " ;";

            /* REQUEST BDD */
            ConnectDB connect = new ConnectDB();
            Connection connexion = null;
            try {
                connexion = connect.connect();
            } catch (Exception e) {
                e.printStackTrace();
            }
            /* Création de l'objet gérant les requêtes */
            Statement statement = null;
            try {
                statement = connexion.createStatement();
            } catch (SQLException e) {
                e.printStackTrace();
            }

            /* Exécution d'une requête de lecture */
            ResultSet resultat = null;
            try {
                resultat = statement.executeQuery( request );
            } catch (SQLException e) {
                e.printStackTrace();
            }

            /* Récupération des données du résultat de la requête de lecture */
            //On récupère les MetaData
            ResultSetMetaData resultMeta = null;
            int numberOfColumns = 0;
            try {
                resultMeta = resultat.getMetaData();
                numberOfColumns = resultMeta.getColumnCount();
            } catch (SQLException e) {
                e.printStackTrace();
            }

            displayResults += "\n**********************************";
            //On affiche le nom des colonnes
            for(int i = 1; i <= numberOfColumns; i++) {
                try {
                    displayResults += "\t" + resultMeta.getColumnName(i).toUpperCase() + "\t *";
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            }

            displayResults += "\n**********************************";

            while(true){
                try {
                    if (!resultat.next()) break;
                } catch (SQLException e) {
                    e.printStackTrace();
                }
                for(int i = 1; i <= numberOfColumns; i++) {
                    String resultatObject = "";

                    try {
                        resultatObject = resultat.getObject(i).toString();
                    } catch (SQLException e) {
                        e.printStackTrace();
                    }
                    System.out.println(resultatObject);
                        displayResults += "\t" + resultatObject + "\t |";

//                    System.out.println(displayResults);
                }

                displayResults += "\n---------------------------------";

            }

            try {
                resultat.close();
                statement.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
            jop1.showMessageDialog(null, displayResults, "Request Information", JOptionPane.INFORMATION_MESSAGE);
            request = "";
        }
    }
//
//    //Classe écoutant notre second bouton
//    class Bouton2Listener implements ActionListener{
//        //Redéfinition de la méthode actionPerformed()
//        public void actionPerformed(ActionEvent e) {
//            label.setText("Vous avez cliqué sur le bouton 2");
//            button2.setEnabled(false); //Le bouton n'est plus cliquable
//            button.setEnabled(true);  //Le bouton est de nouveau cliquable
//        }
//    }
//    //3ème classe écoutant aussi le premier bouton mais qui affiche un message en +
//    class Bouton3Listener implements ActionListener{
//        //Redéfinition de la méthode actionPerformed()
//        public void actionPerformed(ActionEvent e) {
//            System.out.println("Ma classe interne numéro 3 écoute bien !");
//        }
//    }
}
