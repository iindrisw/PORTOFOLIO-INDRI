/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package controller;
import dao.SongDao;
import model.song;
import view.songView;
import javax.swing.AbstractAction.*;
import java.util.AbstractCollection.*;
import java.util.List;
import javax.swing.JOptionPane;
import javax.swing.plaf.OptionPaneUI;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;
import java.io.InputStream;
import java.io.File;
import java.io.FileInputStream;
import javazoom.jl.player.Player;

public class SongController {
    private songView view;
    private SongDao dao;
    private DefaultTableModel tabelmodel;
    private Player player;
    private Thread playThread;

    

    public SongController(songView view) {
        this.view = view;
        dao = new SongDao();
        inittablemodel();
        tampildata();
        settableclick();
        setbutonlistener();
    }
    
    private void inittablemodel(){
        tabelmodel = new DefaultTableModel(
                new Object[]{"ID Song", "Title", "Artist", "FilePath", "Duration"},0);
        view.getTabel_lagu().setModel(tabelmodel);
    }
    public void tampildata(){
        clearform();
        List<song> list = dao.getAll();
        DefaultTableModel model = (DefaultTableModel) view.getTabel_lagu().getModel();
        model.setRowCount(0);
        for (song s: list) {
            Object[] row = {
                s.getId_song(),
                s.getTitle(),
                s.getArtist(),
                s.getFilePath(),
                s.getDuration()
            };
            model.addRow(row);
        }
    }
    public void settableclick(){
        view.getTabel_lagu().getSelectionModel().addListSelectionListener(e ->{
            int row = view.getTabel_lagu().getSelectedRow();
            if (row != -1) {
                view.getTxtid_song().setText(tabelmodel.getValueAt(row, 0).toString());
                view.getTxtjudul().setText(tabelmodel.getValueAt(row, 1).toString());
                view.getTxtartist().setText(tabelmodel.getValueAt(row, 2).toString());
                view.getTxtfilepath().setText(tabelmodel.getValueAt(row, 3).toString());
                view.getTxtduration().setText(tabelmodel.getValueAt(row, 4).toString());
                
            }
        }
        
        );
    }
    public void clearform(){
        view.getTxtid_song().setText("");
        view.getTxtjudul().setText("");
        view.getTxtartist().setText("");
        view.getTxtfilepath().setText("");
        view.getTxtduration().setText("");
    }
    
    public void simpandata(){
        song s = new song();
        s.setId_song(view.getTxtid_song().getText());
        s.setTitle(view.getTxtjudul().getText());
        s.setArtist(view.getTxtartist().getText());
        s.setFilePath(view.getTxtfilepath().getText());
        s.setDuration(Integer.parseInt(view.getTxtduration().getText()));
        if (dao.insert(s)){
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
