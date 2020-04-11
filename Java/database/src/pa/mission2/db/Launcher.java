package pa.mission2.db;

import java.sql.Connection;

public class Launcher
{
    public static void main(String[] args) throws Exception
    {

        ConnectDB test = new ConnectDB();

        test.connection();


    }
}
