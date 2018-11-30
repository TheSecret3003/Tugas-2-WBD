package book;

import com.squareup.okhttp.OkHttpClient;
import com.squareup.okhttp.Request;
import com.squareup.okhttp.Response;
import org.json.JSONObject;

import javax.jws.WebMethod;
import javax.jws.WebService;
import java.io.IOException;

@WebService
public class SearchBookService {

    @WebMethod
    private void getBookFromGoogleBooksAPI(String title) throws IOException {
        OkHttpClient client = new OkHttpClient();
        Request request = new Request.Builder()
                .url("https://www.googleapis.com/books/v1/volumes/s1gVAAAAYAAJ")
                .build();

        Response response = client.newCall(request).execute();
        return response;
        //System.out.println(response.body().string());
    }

    public static void main(String[] args) throws IOException {
        OkHttpClient client = new OkHttpClient();
        Request request = new Request.Builder()
                .url("https://www.googleapis.com/books/v1/volumes/s1gVAAAAYAAJ")
                .build();

        Response response = client.newCall(request).execute();
        System.out.println(response.body().string());
        Book book = Book.convertFromJson(new JSONObject(response.body().string()));
        System.out.println(book.id);

    }
}


