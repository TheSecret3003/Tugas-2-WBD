package BookService;

import java.util.ArrayList;

import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;
import org.json.JSONObject;
import Database.Database;
import JsonBook.Book;
import JsonBook.BookResponse;
import JsonBook.ListBook;

@WebService
public class GetRecomendedBook {
	@WebMethod
	public JSONObject getRecomendedBook(@WebParam(name="category") String category) throws Exception {
		Database db = new Database();
		db.makeJDBCConnection();
		String query = "SELECT * FROM transaction WHERE category='"+category+"' ORDER BY amount DESC;";
		
		ArrayList<String> Response= db.getDataFromDB(query);
		
		if (Response.size()==0) {
			String url = "https://www.googleapis.com/books/v1/volumes?q=subject:" + category;
			String BooksResponseStr = HttpCon.HttpRequest.getRespondFrom(url);
			System.out.println(BooksResponseStr);
			JSONObject jsonObj = new JSONObject(BooksResponseStr);
			return jsonObj;
		} else {
			for (int i = 0; i<Response.size(); i++) {
				System.out.println(Response.get(i));
			}
			JSONObject ret = new JSONObject(Response);
			return ret;
		}
	}
}
