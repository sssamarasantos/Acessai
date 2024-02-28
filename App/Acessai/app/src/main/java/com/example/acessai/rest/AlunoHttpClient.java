package com.example.acessai.rest;

import android.content.Context;

import com.example.acessai.classes.Host;
import com.example.acessai.classes.Usuario;
import com.google.gson.JsonObject;
import com.google.gson.reflect.TypeToken;
import com.koushikdutta.ion.Ion;

import java.util.concurrent.CompletableFuture;

public class AlunoHttpClient {
    private final String HOST_API = new Host().getUrlApi();
    private final String urlBase = HOST_API + "/api/Aluno";

    public CompletableFuture<Usuario> buscar(Context context, String email) {
        TypeToken<Usuario> type = new TypeToken<Usuario>() {};
        CompletableFuture<Usuario> response = new CompletableFuture<>();

        Ion.with(context)
                .load("GET", urlBase + "?email=" + email)
                .as(type)
                .setCallback((e, usuario) -> {
                    if (e == null) {
                        response.complete(usuario);
                    } else {
                        response.completeExceptionally(e);
                    }
                });

        return response;
    }

    public CompletableFuture<Boolean> cadastrar(Context context, Usuario aluno) {
        CompletableFuture<Boolean> response = new CompletableFuture<>();

        JsonObject json = new JsonObject();
        json.addProperty("nome", aluno.getNome());
        json.addProperty("email", aluno.getEmail());
        json.addProperty("senha", aluno.getSenha());
        json.addProperty("assistencia", aluno.getAssistencia());

        Ion.with(context)
                .load(urlBase + "/cadastro")
                .setJsonObjectBody(json)
                .asString()
                .setCallback((e, result) -> {
                    if (e == null) {
                        response.complete(Boolean.parseBoolean(result));
                    } else {
                        response.completeExceptionally(e);
                    }
                });

        return response;
    }

    public CompletableFuture<Boolean> logar(Context context, String email, String password) {
        CompletableFuture<Boolean> response = new CompletableFuture<>();

        JsonObject json = new JsonObject();
        json.addProperty("email", email);
        json.addProperty("senha", password);

        Ion.with(context)
                .load(urlBase + "/Login")
                .setJsonObjectBody(json)
                .asString()
                .setCallback((e, result) -> {
                    if (e == null) {
                        response.complete(Boolean.parseBoolean(result));
                    } else {
                        response.completeExceptionally(e);
                    }
                });

        return response;
    }

    public CompletableFuture<Boolean> atualizar(Context context, Usuario aluno){
        CompletableFuture<Boolean> response = new CompletableFuture<>();

        JsonObject json = new JsonObject();
        json.addProperty("nome", aluno.getNome());
        json.addProperty("email", aluno.getEmail());
        json.addProperty("senha", aluno.getSenha());
        json.addProperty("assistencia", aluno.getAssistencia());

        Ion.with(context)
                .load("PUT", urlBase + "/" + aluno.getId())
                .setJsonObjectBody(json)
                .asString()
                .setCallback((e, result) -> {
                    if (e == null) {
                        response.complete(Boolean.parseBoolean(result));
                    } else {
                        response.completeExceptionally(e);
                    }
                });

        return response;
    }
}
