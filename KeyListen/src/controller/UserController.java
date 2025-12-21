/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package controller;
import dao.UserDao;
import model.user;
import view.userView;
import javax.swing.AbstractAction.*;
import java.util.AbstractCollection.*;
import java.util.List;
import javax.swing.JOptionPane;
import javax.swing.plaf.OptionPaneUI;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;

public class UserController {
    private userView view;
    private UserDao dao;
    private DefaultTableModel tabelModel;
    
    public UserController(userView v) {
        this.view = v;
        dao = new UserDao();
        inittabelmodel();
        tampildata();
        settableclick();
        setbutonlistener();
    }
    public void inittabelmodel(){
    tabelModel = new DefaultTableModel(
            new Object[]{"ID User","Nickname","Password"},0);
    view.getTabel_user().setModel(tabelModel);
    }
    public void tampildata(){
        
        List<user> list = dao.getAll();
        DefaultTableModel model = (DefaultTableModel) view.getTabel_user().getModel();
        model.setRowCount(0);
        for (user u:list) {
            Object[] row = {
                u.getId_user(),
                u.getNickname(),
                u.getPassword()
            
        };
            model.addRow(row);
        }
        
    }
    public void simpandata(){
        user u = new user();
        u.setId_user(view.getTxtid_user().getText());
        u.setNickname(view.getTxtNickname().getText());
        u.setPassword(view.getTxtPassword().getText());
  
        if (dao.insert(u)) {
            u.setId_user(view.getTxtid_user().getText());
            clearform();
            tampildata();
            
        }else{
            JOptionPane.showMessageDialog(view, "Gagal Menyimpan Data");
        }
    }
    public void settableclick(){
        view.getTabel_user().getSelectionModel().addListSelectionListener(e ->{
            int row = view.getTabel_user().getSelectedRow();
            if (row != -1) {
                view.getTxtid_user().setText(tabelModel.getValueAt(row, 0).toString());
                view.getTxtNickname().setText(tabelModel.getValueAt(row, 1).toString());
                view.getTxtPassword().setText(tabelModel.getValueAt(row, 2).toString());             
                
            }
        }
        
        );
    }
    
    public void ubahdata(){
    int baris = view.getTabel_user().getSelectedRow();
    if (baris != -1) {

        
        String idUser = view.getTabel_user().getValueAt(baris, 0).toString();

        user u = new user();
        u.setId_user(idUser);
        u.setNickname(view.getTxtNickname().getText());
        u.setPassword(view.getTxtPassword().getText());

        if (dao.update(u)){
            JOptionPane.showMessageDialog(view, "Data Terupdate");
            tampildata();
            clearform();
        } else {
            JOptionPane.showMessageDialog(view, "Gagal Mengupdate Data");
        }

    } else {
        JOptionPane.showMessageDialog(view, "Pilih baris data yang ingin diupdate");
    }
}

    
     public void hapusdata(){
        int baris = view.getTabel_user().getSelectedRow();
        if (baris != -1) {
            String id = view.getTabel_user().getValueAt(baris, 0).toString();
            if (dao.delete(id)) {
                JOptionPane.showMessageDialog(view, "Baris Data Dihapus");
                tampildata();
                clearform();
            }else{
                JOptionPane.showMessageDialog(view, "Gagal Menghapus Data");
            }
    }else{
            JOptionPane.showMessageDialog(view, "pilih baris data yang ingin di hapus");
        }
    }
     public void setbutonlistener(){
        view.getBtn_update().addActionListener(e -> ubahdata());
        view.getBtnTambah().addActionListener(e -> simpandata());
        view.getBtnRefresh().addActionListener(e -> tampildata());
        
    }
    public void clearform(){
        view.getTxtid_user().setText("");
        view.getTxtNickname().setText("");
        view.getTxtPassword().setText("");

    }
    
}
