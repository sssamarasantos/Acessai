package com.example.acessai.rest;

import android.content.Context;

import com.example.acessai.classes.Host;
import com.example.acessai.classes.Usuario;
import com.google.gson.JsonObject;
import com.koushikdutta.ion.Ion;

import java.util.concurrent.atomic.AtomicBoolean;

public class AlunoHttpClient {
    private final String HOST_API = new Host().getUrlApi();

    String urlBase = HOST_API + "/api/Aluno";

    public boolean cadastrar(Context context, Usuario aluno){
        AtomicBoolean response = new AtomicBoolean(false);

        JsonObject json = new JsonObject();
        json.addProperty("nome", aluno.getNome());
        json.addProperty("email", aluno.getEmail());
        json.addProperty("senha", aluno.getSenha());
        json.addProperty("assistencia", aluno.getAssistencia().toString());

        Ion.with(context)
                .load(urlBase + "/cadastro")
                .setJsonObjectBody(json)
                .asString()
                .setCallback((e, result) -> {
                    response.set(Boolean.parseBoolean(result));
                });

        return response.get();
    }

    public boolean logar(Context context, String email, String password){
        AtomicBoolean response = new AtomicBoolean(false);

        JsonObject json = new JsonObject();
        json.addProperty("email", email);
        json.addProperty("senha", password);

        Ion.with(context)
                .load(urlBase + "/Login")
                .setJsonObjectBody(json)
                .asString()
                .setCallback((e, result) -> {
                    response.set(Boolean.parseBoolean(result));
                });

        return response.get();
    }
}
