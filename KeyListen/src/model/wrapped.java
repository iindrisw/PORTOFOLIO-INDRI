/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package model;

import java.util.List;

public class wrapped {

    private int id_wrapped;
    private String id_song;
    private String id_user;
    private String title;

    public wrapped (){
        
    }
    public wrapped(int id_wrapped, String id_song, String id_user, String title) {
        this.id_wrapped = id_wrapped;
        this.id_song = id_song;
        this.id_user = id_user;
        this.title = title;
    }

    public int getId_wrapped() {
        return id_wrapped;
    }

    public void setId_wrapped(int id_wrapped) {
        this.id_wrapped = id_wrapped;
    }

    public String getId_song() {
        return id_song;
    }

    public void setId_song(String id_song) {
        this.id_song = id_song;
    }

    public String getId_user() {
        return id_user;
    }

    public void setId_user(String id_user) {
        this.id_user = id_user;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }
    
    
}