package dao;

import javazoom.jl.player.Player;
import java.io.InputStream;

public class test {
    public static void main(String[] args) {
        try {
          InputStream is = test.class
        .getClassLoader()
        .getResourceAsStream("music/Nina.mp3");


            
            if (is == null) {
                System.out.println("File lagu tidak ditemukan");
                return;
            }

            Player player = new Player(is);
            player.play();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}

