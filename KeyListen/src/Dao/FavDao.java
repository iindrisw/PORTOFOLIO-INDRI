package dao;

import model.favorite;
import model.song;
import config.koneksiKey;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class FavDao {

    private koneksiKey k = new koneksiKey();
    private Connection con;
    private Statement st;
    private ResultSet rs;

    public List<favorite> getAll() {
        List<favorite> list = new ArrayList<>();
        String sql = "SELECT * FROM favorite";

        try {
            con = k.getConnection();
            st = con.createStatement();
            rs = st.executeQuery(sql);

            while (rs.next()) {
                favorite f = new favorite(
                    rs.getString("id_fav"),
                    rs.getString("title"),
                    rs.getString("artist"),
                    rs.getString("filePath"),
                    rs.getString("nickname"));
                list.add(f);
            }
        } catch (Exception e) {
            e.printStackTrace();
            
        }

        return list;
    }
    
    public boolean insert (favorite f){
        String sql = "insert into  favorite(id_fav, title, artist, filePath, nickname) values (?,?,?,?,?)";
        try {
            con = k.getConnection();
            PreparedStatement ps = con.prepareStatement(sql);
            ps.setString(1, f.getId_fav());
            ps.setString(2, f.getTitle());
            ps.setString(3, f.getArtist());
            ps.setString(4, f.getFilePath());
            ps.setString(5, f.getNickname());
            ps.executeUpdate();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        } 
    }
    
    
    public boolean delete(String id_fav){
        String sql = "delete from favorite where id_fav= ?";
        try {
            PreparedStatement ps = con.prepareStatement(sql);
            ps.setString(1, id_fav);
            ps.executeUpdate();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        } 
    }
}
