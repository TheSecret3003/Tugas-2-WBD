package book;

import org.json.JSONObject;

public class JSONRead {
    public static void main(String[] args) throws Exception
    {
        // parsing file "JSONExample.json"

        // typecasting obj to JSONObject
        JSONObject jo = new JSONObject();

        // getting id
        String id = (String) jo.get("id");
        System.out.println(id);

        // getting volumeInfo

        JSONObject volumeInfo = ((JSONObject)jo.get("volumeInfo"));

        String title = (String) volumeInfo.get("title");
        System.out.println(title);
        String authors = (String) volumeInfo.get("authors");
        System.out.println(authors);


        // getting description
        String description = (String) jo.get("description");
        System.out.println(description);

        // getting price info
        JSONObject retailPrice = ((JSONObject)jo.get("retailPrice"));

        // getting amount
        String amount = (String) retailPrice.get("amount");
        System.out.println(amount);
    }
}
