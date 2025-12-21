/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package controller;
import view.usersign;
import dao.UserDao;
import javax.swing.JOptionPane;
import view.mainView;
import model.user;

/**
 *
 * @author LENOVO
 */
public class loginController {
    private usersign view;
    private UserDao dao;  
    
    public loginController(usersign view){
        this.view = view;
        dao = new UserDao();
    }
    
    public void  login(){
        String nickname = view.getTxtNick().getText();
        String password = view.getTxtPass().getText();
        if (nickname.isEmpty() || password.isEmpty()) {
            JOptionPane.showMessageDialog(null, "Nickname dan Password tidak boleh kosong!");
            return;
            
        }
        user u = dao.login(nickname, password);
        if (u != null) {
            JOptionPane.showMessageDialog(null, "Login berhasil! selamat datang "+u.getNickname());
            new mainView().setVisible(true);
            view.dispose();
            
        }else{
            JOptionPane.showMessageDialog(null, "Nickname dan pasword salah");
        }
    }
}
