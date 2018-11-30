package Database;
 
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
 
/**
 * @author Crunchify.com 
 * Simple Hello World MySQL Tutorial on how to make JDBC connection, Add and Retrieve Data by App Shah
 * 
 */
 
public class Database {
 
	public static Connection conn = null;
	public static PreparedStatement stat = null;
 
	public void makeJDBCConnection() {
 
		try {
			Class.forName("com.mysql.jdbc.Driver");
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
			return;
		}
 
		try {
			// DriverManager: The basic service for managing a set of JDBC drivers.
			conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/webservice", "root", "");
			if (conn != null) {
				log("Connection Successful! Enjoy. Now it's time to push data");
			} else {
				log("Failed to make connection!");
			}
		} catch (SQLException e) {
			log("MySQL Connection Failed!");
			e.printStackTrace();
			return;
		}
 
	}
 
	public void addDataToDB(String query) {
 
		try {
			stat = conn.prepareStatement(query);
 
			// execute insert SQL statement
			stat.executeUpdate();
		} catch (
 
		SQLException e) {
			e.printStackTrace();
		}
	}
 
	public ArrayList<String> getDataFromDB(String query) {
 
		try {
 
			stat = conn.prepareStatement(query);
 
			// Execute the Query, and get a java ResultSet
			ResultSet rs = stat.executeQuery();
 
			// Let's iterate through the java ResultSet
			ArrayList<String> Ret = new ArrayList<>();
			while (rs.next()) {
				String book_id = rs.getString("book_id");
				Ret.add(book_id);
			}
			return Ret;
		} catch (
 
		SQLException e) {
			e.printStackTrace();
		}
		return null;
	}
 
	// Simple log utility
	public void log(String string) {
		System.out.println(string);
	}
}