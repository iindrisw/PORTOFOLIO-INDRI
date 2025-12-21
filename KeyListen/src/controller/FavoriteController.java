package controller;

import dao.FavDao;
import java.io.File;
import java.io.FileInputStream;
import model.favorite;
import view.favView;
import javazoom.jl.player.Player;
import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.util.List;

public class FavoriteController {
    private favView view;
    private FavDao dao;
    private DefaultTableModel tabelmodel;
    private Player player;
    private Thread playThread;
    
    public FavoriteController(favView view) {
        this.view = view;
        dao = new FavDao();
        inittablemodel();
        tampildata();
        settableclick();
        setbutonlistener();
    }
    
    private void inittablemodel(){
        tabelmodel = new DefaultTableModel(
                new Object[]{"ID favorite", "Title", "Artist", "FilePath", "nickname"},0);
        view.getTabel_lagu().setModel(tabelmodel);
    }
    public void tampildata(){
        clearform();
        List<favorite> list = dao.getAll();
        DefaultTableModel model = (DefaultTableModel) view.getTabel_lagu().getModel();
        model.setRowCount(0);
        for (favorite f: list) {
            Object[] row = {
                f.getId_fav(),
                f.getTitle(),
                f.getArtist(),
                f.getFilePath(),
                f.getNickname()
            };
            model.addRow(row);
        }
    }
    public void settableclick(){
        view.getTabel_lagu().getSelectionModel().addListSelectionListener(e ->{
            int row = view.getTabel_lagu().getSelectedRow();
            if (row != -1) {
                view.getId_fav().setText(tabelmodel.getValueAt(row, 0).toString());
                view.getTxtjudul().setText(tabelmodel.getValueAt(row, 1).toString());
                view.getTxtartist().setText(tabelmodel.getValueAt(row, 2).toString());
                view.getTxtfilepath().setText(tabelmodel.getValueAt(row, 3).toString());
                view.getTxtuser().setText(tabelmodel.getValueAt(row, 4).toString());
                
            }
        }
        
        );
    }
    public void clearform(){
        view.getId_fav().setText("");
        view.getTxtjudul().setText("");
        view.getTxtartist().setText("");
        view.getTxtfilepath().setText("");
        view.getTxtuser().setText("");
    }
    
    public void simpandata(){
        favorite f = new favorite();
        
        f.setId_fav(view.getId_fav().getText());
        f.setTitle(view.getTxtjudul().getText());
        f.setArtist(view.getTxtartist().getText());
        f.setFilePath(view.getTxtfilepath().getText());
        f.setNickname(view.getId_fav().getText());
        
        if (dao.insert(f)){
            JOptionPane.showMessageDialog(view, "Lagu Tersimpan");
            tampildata();
            clearform();
        }else{
            JOptionPane.showMessageDialog(view, "Gagal Menyimpan Lagu");
        }
    }
    
    

public void playLagu() {
    try {
        String path = view.getTxtfilepath().getText();

        if (path == null || path.isEmpty()) {
            JOptionPane.showMessageDialog(view, "Pilih lagu dulu!");
            return;
        }

        File file = new File(path);
        if (!file.exists()) {
            JOptionPane.showMessageDialog(
                view,
                "File lagu TIDAK ADA:\n" + path
            );
            return;
        }

        stopLagu();

        player = new Player(new FileInputStream(file));

        playThread = new Thread(() -> {
            try {
                player.play();
            } catch (Exception e) {
                e.printStackTrace();
            }
        });

        playThread.start();

    } catch (Exception e) {
        e.printStackTrace();
        JOptionPane.showMessageDialog(view, "Gagal memutar lagu");
    }
}

public void stopLagu() {
    try {
        if (player != null) {
            player.close();   // STOP LAGU
            player = null;
        }

        if (playThread != null) {
            playThread.interrupt();
            playThread = null;
        }
    } catch (Exception e) {
        e.printStackTrace();
    }
}

    public void setbutonlistener(){
        view.getBtn_addsong().addActionListener(e -> simpandata());
        view.getBtn_play().addActionListener(e -> playLagu());
        view.getBtn_refresh().addActionListener(e -> tampildata());
        view.getBtn_stop().addActionListener(e -> stopLagu());
    }
}
