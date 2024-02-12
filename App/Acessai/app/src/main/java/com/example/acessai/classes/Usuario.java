package com.example.acessai.classes;

import com.example.acessai.enums.Assistencia;

public class Usuario {
    int id;
    String nome;
    String email;
    String senha;
    Assistencia assistencia;

    public int getId(){
        return id;
    }

    public String getNome(){
        return nome;
    }

    public String getEmail() {
        return email;
    }

    public String getSenha() {
        return senha;
    }

    public Assistencia getAssistencia() {
        return assistencia;
    }

    public void setUsuario(String nome, String email, String senha, Assistencia assistencia){
        this.nome = nome;
        this.email = email;
        this.senha = senha;
        this.assistencia = assistencia;
    }
}
