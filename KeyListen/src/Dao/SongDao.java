/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package dao;

import model.song;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import config.koneksiKey; 

public class SongDao {

    private koneksiKey k = new koneksiKey();
    private Connection con;
    private Statement st;
    private ResultSet rs;

    public List<song> getAll() {
        List<song> list = new ArrayList<>();
        String sql = "SELECT * FROM song";

        try {
            con = k.getConnection();
            st = con.createStatement();
            rs = st.executeQuery(sql);

            while (rs.next()) {
                song s = new song(
                    rs.getString("id_song"),
                    rs.getString("title"),
                    rs.getString("artist"),
                    rs.getString("filePath"),
                    rs.getInt("duration"));

                list.add(s);
            }
        } catch (Exception e) {
            e.printStackTrace();
            
        }

        return list;
    }
    
    public boolean insert (song s){
        String sql = "insert into  song(id_song, title, artist, filePath, duration) values (?,?,?,?,?)";
        try {
            con = k.getConnection();
            PreparedStatement ps = con.prepareStatement(sql);
            ps.setString(1, s.getId_song());
            ps.setString(2, s.getTitle());
            ps.setString(3, s.getArtist());
            ps.setString(4, s.getFilePath());
            ps.setInt(5, s.getDuration());
            ps.executeUpdate();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        } 
    }
}
