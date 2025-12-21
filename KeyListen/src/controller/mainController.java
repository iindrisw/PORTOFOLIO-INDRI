/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package controller;
import java.awt.CardLayout;
import view.mainView;
import config.koneksiKey;
import java.io.InputStream;
import java.sql.Connection;
import java.util.HashMap;
import java.util.Map;
import net.sf.jasperreports.engine.JasperFillManager;
import net.sf.jasperreports.engine.JasperPrint;
import net.sf.jasperreports.view.JasperViewer;
/**
 *
 * @author LENOVO
 */
public class mainController {
    private mainView view;
    private CardLayout cl;
    
    public mainController(mainView view){
        this.view = view;
        initcontroller();
    }
    
   private void initcontroller(){
    view.getBtn_user().addActionListener(e -> showpanel("user"));
    view.getBtn_fav().addActionListener(e -> showpanel("favorite"));
    view.getBtn_tambah().addActionListener(e -> showpanel("song"));
    view.getBtn_cetak().addActionListener(e -> {
        showpanel("wrapped");
        printReport();
    });


        
    }
    
    private void showpanel(String name){
        CardLayout cl = (CardLayout) view.getMainpanel().getLayout();
        cl.show(view.getMainpanel(), name);
        view.getMainpanel().revalidate();
        view.getMainpanel().repaint();
    }
    
    private void printReport(){
    try {
        koneksiKey koneksi = new koneksiKey();
        Connection con = koneksi.getConnection();

        InputStream reportStream =
            getClass().getResourceAsStream("/report/cetak_wrapped.jasper");

        Map<String, Object> parameter = new HashMap<>();

        JasperPrint print =
            JasperFillManager.fillReport(reportStream, parameter, con);

        JasperViewer.viewReport(print, false);

    } catch (Exception e) {
        e.printStackTrace();
        System.out.println("Gagal mencetak wrapped: " + e.getMessage());
    }
}

}
