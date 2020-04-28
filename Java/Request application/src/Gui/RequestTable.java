package Gui;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.ArrayList;

public class RequestTable extends JFrame {
    //private ArrayList<ArrayList<String>> data = new ArrayList<ArrayList<String>>();
    private JPanel container = new JPanel();
    private JPanel containerTable = new JPanel();
    private JPanel panButton = new JPanel();
    private Button okButton = new Button("OK");

    private String[] headersData;
    private DefaultTableModel tableModel; // Modèle d'une table qui va définir les en-têtes pour une JTable
    private JTable tableRequest;

    public RequestTable(String[] header){
        super();

        this.setTitle("Request");
        this.setSize(600, 500);
        this.setLocationRelativeTo(null);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.setResizable(true);
        this.setUndecorated(false);

        headersData = header;
        tableModel = new DefaultTableModel(headersData, 0);
        tableRequest = new JTable(tableModel);

        //Panel Table
        containerTable.add(new JScrollPane(tableRequest));

        //Panel Button
        panButton.add(okButton);

        //Panel container
        container.setLayout(new BorderLayout());
        //container.setPreferredSize();
        container.add(containerTable, BorderLayout.CENTER);
        container.add(panButton, BorderLayout.SOUTH);

        //listener
        okButton.addActionListener(new RequestButtonListener());

        this.setContentPane(container);
        //this.setVisible(true);
        for (int i = 0; i < headersData.length; i++) {
            System.out.println(headersData[i]);
        }
    }
    public void addData(String[] resultData){
        tableModel.addRow(resultData);
    }

    class RequestButtonListener implements ActionListener {
        @Override
        public void actionPerformed(ActionEvent actionEvent) {
            setVisible(false);
        }
    }
//    public RequestTable(ArrayList<ArrayList<String>> d, ArrayList<String> header){
//        super();
//
//
//
//        this.data = d;
//        this.headersData = header;
//
//        String[] entetes = {"Prénom", "Nom", "Couleur favorite", "Homme", "Sport"};
//
//        JTable tableau = new JTable(data, headersData);
//
//        getContentPane().add(tableau.getTableHeader(), BorderLayout.NORTH);
//        getContentPane().add(tableau, BorderLayout.CENTER);
//
//        pack();
//    }

}
