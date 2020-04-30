package Gui;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.*;
import java.util.ArrayList;

public class Window extends JFrame{
      private JPanel container = new JPanel();
      private JPanel panButtons = new JPanel();
      //private JPanel panInputs = new JPanel();
      private PanInputs panInputs = new PanInputs();
      private JTextField selectField = new JTextField();
      private String contentSelectField;
      private JComboBox fromComboBox;
      private String contentFromComboBox;
      private JTextField whereField = new JTextField();
      private String contentWhereField;
      private Button requestButton = new Button("REQUETER");

    public Window(){
        //fenêtre
        this.setTitle("Call-Out Duty");
        this.setSize(600, 500);
        this.setLocationRelativeTo(null);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.setResizable(false);
        this.setUndecorated(false);

        //Panel Inputs
        selectField = panInputs.getSelectField();
        fromComboBox = panInputs.getFromComboBox();
        whereField = panInputs.getWhereField();
        contentSelectField = panInputs.getContentSelectField();
        contentFromComboBox = panInputs.getContentFromComboBox();
        contentWhereField = panInputs.getContentWhereField();

        //Panel Buttons
        //requestButton.setEnabled(false);
        panButtons.add(requestButton);

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

        requestButton.addActionListener(new RequestBoutonListener());

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
    class RequestBoutonListener implements ActionListener{
        //Redéfinition de la méthode actionPerformed()
        public void actionPerformed(ActionEvent arg0) {
            //Boîte du message d'information
            //JOptionPane jop1 = new JOptionPane();
            String request = "SELECT " + contentSelectField + " FROM " + contentFromComboBox;
            if(contentWhereField != null) request += " WHERE " + contentWhereField + " ;";

            /* REQUEST BDD */
            ConnectDB connect = new ConnectDB();
            Connection connexion = null;

            ArrayList<ArrayList<String>> data = new ArrayList<ArrayList<String>>();
            ArrayList<String> headersData = new ArrayList<String>();

            /* Création de l'objet gérant les requêtes */
            Statement statement = null;
            /* Exécution d'une requête de lecture */
            ResultSet resultat = null;
            /* Récupération des données du résultat de la requête de lecture */
            //On récupère les MetaData
            ResultSetMetaData resultMeta = null;
            int numberOfColumns;
            /* Nom des entêtes récupérées */
            String[] resultHeaders;
            /* Fenêtre qui affichera toutes les données des requêtes avec un tableau*/
            RequestTable requestTable;

            try {
                connexion = connect.connect();
                statement = connexion.createStatement();
                resultat = statement.executeQuery( request );
                resultMeta = resultat.getMetaData();
                numberOfColumns = resultMeta.getColumnCount();
                resultHeaders = new String[numberOfColumns];

                //On stocke le nom des colonnes
                for(int i = 1; i <= numberOfColumns; i++) {
                    resultHeaders[i-1] = resultMeta.getColumnName(i).toUpperCase();
                }

                requestTable = new RequestTable(resultHeaders);

                while(true){
                    if (!resultat.next()) break;
                    String[] resultData = new String[numberOfColumns];
                    for(int i = 1; i <= numberOfColumns; i++) {
                        Object col = resultat.getObject(i);
                        resultData[i-1] = col == null ? "" : col.toString();
                    }
                    requestTable.addData(resultData);

                }
                requestTable.setVisible(true);

            } catch(SQLException e){
                e.printStackTrace();
            } catch (Exception e) {
                e.printStackTrace();
            } finally {
                try {
                    resultat.close();
                } catch (SQLException e) {
                    e.printStackTrace();
                }
                try {
                    statement.close();
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            }
            request = "";
        }
    }

}
