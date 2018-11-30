package JsonBook;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class BookResponse {
    public String kind;
    public Integer totalItems;
    public ListBook items;
	
    public BookResponse(String kind, Integer totalItems, ListBook items) {
    	this.kind = kind;
    	this.totalItems = totalItems;
    	this.items = items;
    }
    
    public String getKind() {
		return kind;
	}
	public Integer getTotalItems() {
		return totalItems;
	}
	public ListBook getItems() {
		return items;
	}
    
	public static BookResponse toBookService(JSONObject json) throws JSONException {
		String kind = (String) json.get("kind");
		Integer totalItems = (Integer) json.get("totalItems");
		ListBook items = ListBook.toListBook((JSONArray) json.get("items"));
		BookResponse aBookResponse = new BookResponse(kind, totalItems, items);
		return aBookResponse;
	}
}
