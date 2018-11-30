package JsonBook;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class Book {
    public String id;
    public String title;
    public String imageUrl;
    public String description;
    public String forSale;
    public Double price;
    public String currency;
    public List<String> author;

    public Book(String id, List<String> author,String title, String imageUrl, String description, String forSale, String currency, Double price) {
        this.id = id;
        this.title = title;
        this.author = author;
        this.imageUrl = imageUrl;
        this.description = description;
        this.currency = currency;
        this.forSale = forSale;
        this.price = price;
    }

    public String getForSale() {
		return forSale;
	}

	public String getCurrency() {
		return currency;
	}

	public String getId() {
        return id;
    }

    public List<String> getAuthor() {
        return author;
    }

    public String getTitle() {
        return title;
    }

    public String getImageUrl() {
        return imageUrl;
    }

    public String getDescription() {
        return description;
    }

    public Double getPrice() {
        return price;
    }

    public static Book convertFromJson(JSONObject json) throws JSONException {
    	String id = "0";
    	String title = "";
    	ArrayList<String> author = new ArrayList<>();
    	String description = "";
    	String imageUrl = "";
    	String forSale = "";
    	String currency = "-";
    	Double price = (double) 0;
    	JSONArray authorsJson = new JSONArray();
    	try {
    		id = (String) json.get("id");
    	} catch (Exception e) {
			// TODO: handle exception
		}
    	try {
    		title = json.getJSONObject("volumeInfo").getString("title");
    	} catch (Exception e) {
			// TODO: handle exception
		}
        
        try {
        	authorsJson = json.getJSONObject("volumeInfo").getJSONArray("authors");
        	for (int i = 0; i < authorsJson.length(); i++) {
                author.add((String) authorsJson.get(i));
            }
        } catch (Exception e) {
        	author.add("");
        }
        
        try {
        	description = (String) json.getJSONObject("volumeInfo").get("description");
        } catch (Exception e) {
        	
        }
        try {
        	imageUrl = (String) json.getJSONObject("volumeInfo").getJSONObject("imageLinks").get("thumbnail");
        } catch (Exception e) {
        	
        }
        
        try {
        	forSale = (String) json.getJSONObject("saleInfo").get("saleability");
        } catch (Exception e) {
        	
        }
        if (forSale.equals("FOR_SALE")) {
        	price = (Double) json.getJSONObject("saleInfo").getJSONObject("listPrice").get("amount");
        	currency = (String) json.getJSONObject("saleInfo").getJSONObject("listPrice").get("currencyCode");
        }
        
        return new Book(id, author, title, imageUrl, description, forSale, currency, price);
    }


}
