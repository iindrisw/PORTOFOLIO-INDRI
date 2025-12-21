/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package Main;

import config.koneksiKey;
import model.user;
import dao.UserDao;
import model.wrapped;
import Dao.wrapedDao;

public class main {
    public static void main(String[] args) {
    wrapped f = new wrapped(11, "666", "8877", "Nina");
    wrapedDao dao = new wrapedDao();
    dao.insert(f);
    
    }
}



