package pa.mission2.db;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

public class ConnectDB
{

    public void connection() throws Exception {
        getConnection();
    }

    public static Connection getConnection() throws Exception
    {

        try{
            String driver = "com.mysql.jdbc.Driver";

            String url="jdbc:mysql://localhost:3308/projet_annuel?zeroDateTimeBehavior=CONVERT_TO_NULL&serverTimezone=UTC";
            String username = "root";
            String password = "root";
            Class.forName(driver);

            Connection connexion = DriverManager.getConnection(url, username, password);
            System.out.println("Connected");

            /* Création de l'objet gérant les requêtes */
            Statement statement = connexion.createStatement();

            /* Exécution d'une requête de lecture */
            ResultSet resultat = statement.executeQuery( "SELECT *  FROM users;" );

            /* Récupération des données du résultat de la requête de lecture */
            while ( resultat.next() )
            {
                int id_users = resultat.getInt( "id" );
                String name_users = resultat.getString( "name" );
                String firstname_users = resultat.getString( "firstname" );
                String email_users = resultat.getString( "email" );

                /* Traiter ici les valeurs récupérées. */
                System.out.print("| "  + id_users + " - ");
                System.out.print(name_users + " - ");
                System.out.print(firstname_users + " - ");
                System.out.println(email_users + " |");
            }


        }catch (Exception e){

            System.out.println(e);

        }

        return null;

    }

}
