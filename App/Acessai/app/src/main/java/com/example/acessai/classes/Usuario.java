package com.example.acessai.classes;

import com.example.acessai.enums.Assistencia;

public class Usuario {
    int id;
    String nome;
    String email;
    String senha;
    String assistencia;
    String dataHoraCriacao;

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

    public String getAssistencia() {
        return assistencia;
    }

    public void setUsuario(String nome, String email, String senha, String assistencia){
        this.nome = nome;
        this.email = email;
        this.senha = senha;
        this.assistencia = assistencia;
    }
}
