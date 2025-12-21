/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package controller;

/**
 *
 * @author LENOVO
 */
import Dao.wrapedDao;
import java.io.File;
import java.io.FileInputStream;
import model.wrapped;
import view.wrappedView;
import javazoom.jl.player.Player;
import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.util.List;

public class WrappedController {
    private wrappedView view;
    private wrapedDao dao;
    private DefaultTableModel tabelmodel;
    private Player player;
    private Thread playThread;
    
    public WrappedController(wrappedView view) {
        this.view = view;
        dao = new wrapedDao();
        inittablemodel();
        tampildata();
        settableclick();
        setbutonlistener();
    }
    
    private void inittablemodel(){
        tabelmodel = new DefaultTableModel(
                new Object[]{"id_wrapped", "id_song", "id_user", "title"},0);
        view.getTabel_wrapped().setModel(tabelmodel);
    }
    public void tampildata(){
        clearform();
        List<wrapped> list = dao.getAll();
        DefaultTableModel model = (DefaultTableModel) view.getTabel_wrapped().getModel();
        model.setRowCount(0);
        for (wrapped w: list) {
            Object[] row = {
                w.getId_wrapped(),
                w.getId_song(),
                w.getId_user(),
                w.getTitle(),
               
            };
            model.addRow(row);
        }
    }
    public void settableclick(){
        view.getTabel_wrapped().getSelectionModel().addListSelectionListener(e ->{
            int row = view.getTabel_wrapped().getSelectedRow();
            if (row != -1) {
                view.getTxtid_wrapped().setText(tabelmodel.getValueAt(row, 0).toString());
                view.getTxtid_song().setText(tabelmodel.getValueAt(row, 1).toString());
                view.getTxtid_user().setText(tabelmodel.getValueAt(row, 2).toString());
                view.getTxtTitle().setText(tabelmodel.getValueAt(row, 3).toString());
                
            }
        }
        
        );
    }
    public void clearform(){
        view.getTxtid_wrapped().setText("");
        view.getTxtid_song().setText("");
        view.getTxtid_user().setText("");
        view.getTxtTitle().setText("");
        
    }
    
    public void simpandata(){
        wrapped w = new wrapped();
        
        w.setId_wrapped(Integer.parseInt(view.getTxtid_wrapped().getText()));
        w.setId_song(view.getTxtid_song().getText());
        w.setId_user(view.getTxtid_user().getText());
        w.setTitle(view.getTxtTitle().getText());
        
        if (dao.insert(w)){
            JOptionPane.showMessageDialog(view, "Lagu Tersimpan");
            tampildata();
            clearform();
        }else{
            JOptionPane.showMessageDialog(view, "Gagal Menyimpan Lagu");
        }
    }
     public void hapusdata(){
        int baris = view.getTabel_wrapped().getSelectedRow();
        if (baris != -1) {
            String id = view.getTabel_wrapped().getValueAt(baris, 0).toString();
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
        view.getBtn_addLagu().addActionListener(e -> simpandata());
        view.getBtn_refresh().addActionListener(e -> tampildata());
        view.getBtn_delete().addActionListener(e-> hapusdata());
    }
}
