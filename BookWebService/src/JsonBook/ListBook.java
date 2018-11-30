package JsonBook;

import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;

public class ListBook {
	ArrayList<Book> listBook;
	
	public ListBook(ArrayList<Book> listBook) {
		this.listBook = listBook;
	}

	public ArrayList<Book> getListBook() {
		return listBook;
	}
	
	public static ListBook toListBook(JSONArray items) throws JSONException {
		ArrayList<Book> aListBook = new ArrayList<>();
		for (int i = 0; i < items.length(); i++) {
			Book aBook = Book.convertFromJson(items.getJSONObject(i));
			aListBook.add(aBook);
		}
		return (new ListBook(aListBook)); 
	}
}
