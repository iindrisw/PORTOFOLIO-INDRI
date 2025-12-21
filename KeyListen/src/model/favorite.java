/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package model;

public class favorite {
    private String id_fav;
    private String title;
    private String artist;
    private String filePath;
    private String nickname;

    public favorite(String id_fav, String title, String artist, String filePath, String nickname) {
        this.id_fav = id_fav;
        this.title = title;
        this.artist = artist;
        this.filePath = filePath;
        this.nickname = nickname;
    }
    public favorite(){
        
    }    
    public String getId_fav() {
        return id_fav;
    }

    public void setId_fav(String id_fav) {
        this.id_fav = id_fav;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getArtist() {
        return artist;
    }

    public void setArtist(String artist) {
        this.artist = artist;
    }

    public String getFilePath() {
        return filePath;
    }

    public void setFilePath(String filePath) {
        this.filePath = filePath;
    }

    public String getNickname() {
        return nickname;
    }

    public void setNickname(String nickname) {
        this.nickname = nickname;
    }

    
    
    
    
}

