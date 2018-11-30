package HttpCon;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import org.json.JSONObject;

public class HttpRequest {
	public static String getRespondFrom(String url_string) throws Exception {
		  
		  URL url = new URL(url_string);
		  HttpURLConnection httpcon = (HttpURLConnection) url.openConnection();
		  
		  // Set the request method and properties
		  httpcon.setRequestMethod("GET");
		  httpcon.setRequestProperty("accept", "application/json");
		  
		  if (httpcon.getResponseCode() != 200) {
		   throw new RuntimeException("HttpURLConnectionError : " + httpcon.getResponseCode());
		  }
		  
//		  System.out.println("Response Code: " + httpcon.getResponseCode());
//		  System.out.println("Response Message: " + httpcon.getResponseMessage());
		  
		  BufferedReader reader = new BufferedReader(new InputStreamReader(httpcon.getInputStream()));		  
		  String line;
		  StringBuilder Result = new StringBuilder();
		  while ((line = reader.readLine()) != null) {
			  Result.append(line);
		  }
		  reader.close();
		  return Result.toString();
		 }
	public static String sendPostTo(String url_string, String param) throws Exception {
		URL url = new URL(url_string);
		System.out.println("S 1");
		HttpURLConnection connection =  (HttpURLConnection) url.openConnection();
	    connection.setRequestMethod("POST");
	    connection.setDoOutput(true);
	    System.out.println("S 2");
	    DataOutputStream wr = new DataOutputStream(connection.getOutputStream());
	    wr.writeBytes(param);
	    wr.flush();
	    wr.close();
	    System.out.println("S 3");
	    BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
	    StringBuffer Result = new StringBuffer();
	    String line;  
	    while ((line = reader.readLine()) != null){
	    	Result.append(line);
	    	System.out.println(line);
	    }
	    System.out.println("S 4");
	    reader.close();
	    
	              
	    return Result.toString();
	 }
}
