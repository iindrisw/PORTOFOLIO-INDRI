/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package config;
import java.sql.*;

public class koneksiKey {
    private static final String url =
"jdbc:sqlite:C:/Users/LENOVO/Downloads/KeyListen/KeyListen/database/database_key/database_key.db";

    private static Connection con;
    
    public Connection getConnection(){
        try {
            con = DriverManager.getConnection(url);
            System.out.println("koneksi berhasil");
            
        } catch (Exception e) {
            System.out.println("koneksi gagal: "+e.getMessage());
        }
        return con;
       }
        
    }
    

