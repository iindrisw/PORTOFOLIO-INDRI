/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package model;


public class song {
    private String id_song;
    private String title;
    private String artist;
    private String filePath;
    private int duration;
            
    public song (String id_song, String title, String artist, String filePath, int duration) {
        this.id_song = id_song;
        this.title = title;
        this.artist = artist;
        this.filePath = filePath;
        this.duration = duration;
    }

    public song() {
    
    }

    public String getId_song() {
        return id_song;
    }

    public void setId_song(String id_song) {
        this.id_song = id_song;
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

    public int getDuration() {
        return duration;
    }

    public void setDuration(int duration) {
        this.duration = duration;
    }

}
    

    