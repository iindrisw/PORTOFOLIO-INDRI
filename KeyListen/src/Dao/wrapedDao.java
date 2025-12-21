/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Dao;

/**
 *
 * @author Lenovo
 */

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import config.koneksiKey; 
import model.wrapped;

public class wrapedDao {
    private koneksiKey k = new koneksiKey();
    private Connection con;
    private Statement st;
    private ResultSet rs;
    
    public List<wrapped> getAll() {
        List<wrapped> list = new ArrayList<>();
        String sql = "SELECT * FROM wrapped";

        try {
            con = k.getConnection();
            st = con.createStatement();
            rs = st.executeQuery(sql);
            while (rs.next()) {
                wrapped w = new wrapped(
                    rs.getInt("id_wrapped"),
                    rs.getString("id_song"),
                    rs.getString("id_user"),
                    rs.getString("title"));

                list.add(w);
            }
        } catch (Exception e) {
            e.printStackTrace();
            
        }

        return list;
    }
    
    public boolean insert (wrapped w){
        String sql = "insert into  wrapped (id_wrapped, id_song, id_user, title) values (?,?,?,?)";
        try {
            con = k.getConnection();
            PreparedStatement ps = con.prepareStatement(sql);
            ps.setInt(1, w.getId_wrapped());
            ps.setString(2, w.getId_song());
            ps.setString(3, w.getId_user());
            ps.setString(4, w.getTitle());
            ps.executeUpdate();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        } 
    }
    public boolean delete(String id_wrapped){
        String sql = "delete from wrapped where id_wrapped=?";
        try {
            con = k.getConnection();
            PreparedStatement ps = con.prepareStatement(sql);
            ps.setString(1, id_wrapped);
            ps.executeUpdate();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        }
    }
}
