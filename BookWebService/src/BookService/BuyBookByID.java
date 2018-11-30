package BookService;

import java.io.IOException;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;
import Database.Database;
import HttpCon.HttpRequest;

@WebService
public class BuyBookByID {
	@WebMethod
	public String buyBookByID(@WebParam(name = "id") String id, @WebParam(name="amount")int amount, @WebParam(name="Rekening") String rek, @WebParam(name="category") String category, @WebParam(name="price") double price, @WebParam(name="ordertime") String ordertime) throws IOException {
		System.out.println("F 1");
		String url = "http://localhost:8081/transfer"; 
		Double totalPrice = amount*price;
		String param = "card_num=" + rek + "&" + "amount=" + totalPrice.toString();
		
		String Response = "";
		System.out.println("F 2");
		try {
			Response = HttpRequest.sendPostTo(url, param);
			System.out.println("F 3");
		} catch (Exception e) {
			System.out.println("F F");
			// TODO: handle exception
			System.out.print(e.getMessage());
			System.out.print(e.getStackTrace());
		}
		System.out.println("F 4");
		System.out.println("RESPONS : " + Response);
		if (Response.equals("")) {
			return "FAILED";
		} else {
			System.out.println("F 5");
			try {
				// DB here
				Database db = new Database();
				db.makeJDBCConnection();
				String query = "INSERT INTO transaction (`nama`, `book_id`, `amount`, `price`, `category`, `order_time`) VALUES ('" + Response + "','"+id+"',"+amount+","+(int)price+",'"+category+"','"+ordertime+"');";
				db.log(query);
				db.addDataToDB(query);
				return "SUCCESS";
			}catch (Exception e) {
				return ("DBFAIL" + e.getMessage());
			}
		}
//		Call transfer
		
	}
}
