package Gui;

import javax.swing.*;
import java.awt.*;

public class PanInputs extends JPanel{
    private JTextField selectField = new JTextField();
    private String contentSelectField;
    private JComboBox fromComboBox;
    private String contentFromComboBox;
    private JTextField whereField = new JTextField();
    private String contentWhereField;
    private JLabel labelSelect = new JLabel("SELECT");
    private JLabel labelFrom = new JLabel("FROM");
    private JLabel labelWhere = new JLabel("WHERE");

    public PanInputs() {
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
        this.setLayout(new GridLayout(3,1));
        this.setBackground(Color.white);
        this.setPreferredSize(new Dimension(220, 60));
        this.setBorder(BorderFactory.createTitledBorder("Formulaire pour réaliser une requête de la base de données"));
        //SELECT
        JPanel panSelect = new JPanel();
        selectField.setFont(fontField);
        selectField.setPreferredSize(new Dimension(250, 30));
        selectField.setForeground(Color.BLUE);
        panSelect.setBorder(BorderFactory.createLineBorder(Color.black));
        panSelect.setLayout(new BorderLayout());
        panSelect.add(labelSelect, BorderLayout.WEST);
        panSelect.add(selectField, BorderLayout.CENTER);
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
        panFrom.setBorder(BorderFactory.createLineBorder(Color.black));
        panFrom.add(labelFrom);
        panFrom.add(fromComboBox);
        //WHERE
        JPanel panWhere = new JPanel();
        whereField.setFont(fontField);
        whereField.setPreferredSize(new Dimension(250, 30));
        whereField.setForeground(Color.BLUE);
        panWhere.setBorder(BorderFactory.createLineBorder(Color.black));
        panWhere.add(labelWhere);
        panWhere.add(whereField);

        this.add(panSelect);
        this.add(panFrom);
        this.add(panWhere);
    }

    public JTextField getSelectField() {
        return selectField;
    }

    public void setSelectField(JTextField selectField) {
        this.selectField = selectField;
    }

    public String getContentSelectField() {
        return contentSelectField;
    }

    public void setContentSelectField(String contentSelectField) {
        this.contentSelectField = contentSelectField;
    }

    public JComboBox getFromComboBox() {
        return fromComboBox;
    }

    public void setFromComboBox(JComboBox fromComboBox) {
        this.fromComboBox = fromComboBox;
    }

    public String getContentFromComboBox() {
        return contentFromComboBox;
    }

    public void setContentFromComboBox(String contentFromComboBox) {
        this.contentFromComboBox = contentFromComboBox;
    }

    public JTextField getWhereField() {
        return whereField;
    }

    public void setWhereField(JTextField whereField) {
        this.whereField = whereField;
    }

    public String getContentWhereField() {
        return contentWhereField;
    }

    public void setContentWhereField(String contentWhereField) {
        this.contentWhereField = contentWhereField;
    }
}
