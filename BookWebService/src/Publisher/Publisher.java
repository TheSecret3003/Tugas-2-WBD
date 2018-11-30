package Publisher;
import javax.xml.ws.Endpoint;


public class Publisher {
	public static void getBookByIDPublisher() {
		Endpoint.publish("http://localhost:9901/GetBookByID", new BookService.GetBookByID());
	}
	
	public static void getBookByTitlePublisher() {
		Endpoint.publish("http://localhost:9901/GetBookByTitle", new BookService.GetBooksByTitle());
	}
	
	public static void getRecomendedBookPublisher() {
		Endpoint.publish("http://localhost:9901/GetRecomendedBook", new BookService.GetRecomendedBook());
	}
	
	public static void buyBookByIDPublisher() {
		Endpoint.publish("http://localhost:9901/BuyBookByID", new BookService.BuyBookByID());
	}
	
}
