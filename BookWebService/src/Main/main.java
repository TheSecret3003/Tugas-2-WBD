package Main;

import org.json.JSONObject;

import BookService.BuyBookByID;
import BookService.GetBookByID;
import BookService.GetBooksByTitle;
import BookService.GetRecomendedBook;
import JsonBook.Book;
import JsonBook.ListBook;
import Publisher.Publisher;


public class Main {
	public static void main(String[] args) throws Exception {
//		Book aBook = BookService.GetBookByID.getBookByID("zyTCAlFPjgYC");
		Publisher.getBookByIDPublisher();
		Publisher.getBookByTitlePublisher();
		Publisher.getRecomendedBookPublisher();
		Publisher.buyBookByIDPublisher();
		
		GetBooksByTitle service1 = new GetBooksByTitle();
		GetBookByID service2 = new GetBookByID();
		GetRecomendedBook s3 = new GetRecomendedBook();
		BuyBookByID s4 = new BuyBookByID();
		
//		ListBook aListBook= service1.getBookByTitle("magic");
//		Book aBook = service2.getBookByID("qGCWDgAAQBAJ");
		JSONObject bListBook = s3.getRecomendedBook("Action");
//		System.out.println(bListBook.getListBook().size())
		
//		String resp = s4.buyBookByID("NKk4DwAAQBAJ", 1, "1111222233334444", "Self-Help", 30000.00, "30 November 2018");
		
	}
}
