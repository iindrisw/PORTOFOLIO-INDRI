/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package dao;
import model.user;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import config.koneksiKey; 

public class UserDao {
    private koneksiKey k = new koneksiKey();
    private Connection con;
    private Statement st;
    private ResultSet rs;
    
    public List<user> getAll() {
        List<user> list = new ArrayList<>();
        String sql = "SELECT * FROM user";

        try {
            con = k.getConnection();
            st = con.createStatement();
            rs = st.executeQuery(sql);

            while (rs.next()) {
                user u = new user(
                    rs.getString("id_user"),
                    rs.getString("nickname"),
                    rs.getString("password")
                );

                list.add(u);
            }
        } catch (Exception e) {
            e.printStackTrace();
            
        }

        return list;
    }
    public boolean insert (user u){
        String sql = "insert into user(id_user, nickname, password) values (?,?,?)";
        try {
            con = k.getConnection();
            PreparedStatement ps = con.prepareStatement(sql);
            ps.setString(1, u.getId_user());
            ps.setString(2, u.getNickname());
            ps.setString(3, u.getPassword());
            ps.executeUpdate();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        } 
    }
    public boolean update (user u){
        String sql = "update user set id_user = ?, nickname = ?, password = ? where id_user = ?";
        try {
            con = k.getConnection();
            PreparedStatement ps = con.prepareStatement(sql);
            ps.setString(1, u.getId_user());
            ps.setString(2, u.getNickname());
            ps.setString(3, u.getPassword());
            ps.executeUpdate();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        } 
    }
    
    public boolean delete(String id_user){
        String sql = "delete from user where id_user = ?";
        try {
            PreparedStatement ps = con.prepareStatement(sql);
            ps.setString(1, id_user);
            ps.executeUpdate();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
            return false;
        } 
    }
    
    public user login(String nickname, String password){
        user u = null;
        String sql ="select * from user where nickname = ? and password = ?";
        try {
            con = k.getConnection();
            try(PreparedStatement ps = con.prepareStatement(sql)){
                ps.setString(1, nickname);
                ps.setString(2, password);
                try(ResultSet rs = ps.executeQuery()){
                    if (rs.next()){
                        u = new user(
                            rs.getString("id_user"), 
                            rs.getString("nickname"),
                            rs.getString("password"));
                }
                }
            }           
        } catch (Exception e) {
             e.printStackTrace();
        }
        return u;
    }
}
