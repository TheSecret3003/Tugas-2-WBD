package BookService;

import JsonBook.BookResponse;
import JsonBook.ListBook;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;
import org.json.JSONObject;

@WebService
public class GetBooksByTitle {
	@WebMethod
	public JSONObject getBookByTitle(@WebParam(name="title") String title) throws Exception {
		String url_book = title.replace(" ", "+");
		String url = "https://www.googleapis.com/books/v1/volumes?q=" + url_book;
		
		String BooksResponseStr = HttpCon.HttpRequest.getRespondFrom(url);
		System.out.println(BooksResponseStr);
		JSONObject jsonObj = new JSONObject(BooksResponseStr);
		return jsonObj;
	}
}
