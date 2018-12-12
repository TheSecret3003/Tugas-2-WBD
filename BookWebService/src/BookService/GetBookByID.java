package BookService;

import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;

import org.json.JSONObject;

import JsonBook.Book;
@WebService
public class GetBookByID {
	@WebMethod
	public String getBookByID(@WebParam(name="id") String id) throws Exception {
		String url = "https://www.googleapis.com/books/v1/volumes/" + id;
		
		String BookStr = HttpCon.HttpRequest.getRespondFrom(url);
		return BookStr; 
	}
}
