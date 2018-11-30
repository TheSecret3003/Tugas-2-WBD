package main.java.bookservice.model;


import main.java.bookservice.database.DbConnection;

import javax.xml.bind.annotation.*;
import java.lang.reflect.Array;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name="", propOrder = {
        "googlebook_id",
        "title",
        "author",
        "is_for_sale",
        "list_price",
        "retail_price",
        "category_id",
        "search_info",
        "image_url"
})
@XmlRootElement(name = "Book")
public class Book {
    @XmlElement(required = true)
    public String googlebook_id;
    @XmlElement(required = true)
    public String title;
    @XmlElement(required = true)
    public String author;
    @XmlElement(required = true)
    public int is_for_sale;
    @XmlElement(required = true)
    public int list_price;
    @XmlElement(required = true)
    public int retail_price;
    @XmlElement(required = true)
    public int category_id;
    @XmlElement(required = true)
    public String search_info;
    @XmlElement(required = true)
    public String image_url;

    public Book() {}

    public Book(String googlebook_id, String title, String author, int is_for_sale, int list_price, int retail_price, int category_id, String search_info, String image_url) {
        this.googlebook_id = googlebook_id;
        this.title = title;
        this.author = author;
        this.is_for_sale = is_for_sale;
        this.list_price = list_price;
        this.retail_price = retail_price;
        this.category_id = category_id;
        this.search_info = search_info;
        this.image_url = image_url;
    }

//    public ArrayList<Book> getAll() {
//        try {
//            Connection db = DbConnection.getConnection();
//            PreparedStatement stmt = db.prepareStatement("SELECT * FROM `books`");
//            ResultSet rs = stmt.executeQuery();
//            return
//        } catch(Exception e) {
//            e.printStackTrace();
//        }
//    }

    public boolean isAvailable(String googlebook_id) {
        try {
            Connection db = DbConnection.getConnection();
            PreparedStatement stmt = db.prepareStatement("SELECT * FROM `books` WHERE `googlebook_id` = ?");
            stmt.setString(1, googlebook_id);
            ResultSet rs = stmt.executeQuery();
            return rs.next();
        } catch (Exception e) {
            e.printStackTrace();
        }
        return false;
    }

    public void save(Book book) {
        if(!isAvailable(book.googlebook_id)) {
            try {
                Connection db = DbConnection.getConnection();
                PreparedStatement stmt = db.prepareStatement(
                        "INSERT INTO `books` (`googlebook_id`, `title`, `is_for_sale`," +
                                "`list_price`, `retail_price`) VALUES (?,?,?,?,?)");
                stmt.setString(1, book.googlebook_id);
                stmt.setString(2, book.title);
                stmt.setInt(3, book.is_for_sale);
                stmt.setInt(4, book.list_price);
                stmt.setInt(5, book.retail_price);
                stmt.executeUpdate();
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

//    public void update(Book book ) {
//        if(isAvailable(book.googlebook_id)) {
//            try {
//                Connection db = DbConnection.getConnection();
//                PreparedStatement stmt = db.prepareStatement(
//                        "INSERT INTO `books` (`googlebook_id`, `title`, `is_for_sale`," +
//                                "`list_price`, `retail_price`, `category_id`) VALUES (?,?,?,?,?,?)");
//                stmt.setString(1, book.googlebook_id);
//                stmt.setString(2, book.title);
//                stmt.setInt(3, book.is_for_sale);
//                stmt.setInt(4, book.list_price);
//                stmt.setInt(5, book.retail_price);
//                stmt.setInt(6, book.category_id);
//                ResultSet rs;
//                rs = stmt.executeQuery();
//                rs.next();
//            } catch (Exception e) {
//                e.printStackTrace();
//            }
//        }
//    }
}
