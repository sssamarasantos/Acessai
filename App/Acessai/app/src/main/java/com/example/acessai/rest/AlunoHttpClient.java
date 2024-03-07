package com.example.acessai.rest;

import android.content.Context;

import com.example.acessai.classes.Host;
import com.example.acessai.classes.Usuario;
import com.example.acessai.enums.Assistencia;
import com.google.gson.reflect.TypeToken;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.CompletableFuture;

public class AlunoHttpClient {
    private final String urlBase = new Host().getUrlApp() + "/aluno";

    public CompletableFuture<Usuario> buscar(final Context context, String email) {
        TypeToken<Usuario> type = new TypeToken<Usuario>() {};
        CompletableFuture<Usuario> response = new CompletableFuture<>();

        Ion.with(context)
                .load(urlBase + "/buscar.php")
                .setBodyParameter("email", email)
                .as(type)
                .setCallback((e, result) -> {
                    if (e == null) {
                        response.complete(result);
                    } else {
                        response.completeExceptionally(e);
                    }
                });

        return response;
    }

    public CompletableFuture<Assistencia> buscarAssistencia(final Context context, String email){
        TypeToken<Assistencia> type = new TypeToken<Assistencia>() {};
        CompletableFuture<Assistencia> response = new CompletableFuture<>();

        Ion.with(context)
                .load(urlBase + "/buscarAssistencia.php")
                .setBodyParameter("email", email)
                .as(type)
                .setCallback((e, result) -> {
                    if (e == null) {
                        response.complete(result);
                    } else {
                        response.completeExceptionally(e);
                    }
                });

        return response;
    }

    public CompletableFuture<Boolean> inserir(final Context context, Usuario aluno) {
        TypeToken<Boolean> type = new TypeToken<Boolean>() {};
        CompletableFuture<Boolean> response = new CompletableFuture<>();

        Ion.with(context)
                .load(urlBase + "/inserir.php")
                .setBodyParameter("nome", aluno.getNome())
                .setBodyParameter("email", aluno.getEmail())
                .setBodyParameter("senha", aluno.getSenha())
                .setBodyParameter("assistencia", aluno.getAssistencia())
                .as(type)
                .setCallback((e, result) -> {
                    if (e == null) {
                        response.complete(result);
                    } else {
                        response.completeExceptionally(e);
                    }
                });

        return response;
    }

    public CompletableFuture<Boolean> logar(final Context context, String email, String senha) {
        TypeToken<Boolean> type = new TypeToken<Boolean>() {};
        CompletableFuture<Boolean> response = new CompletableFuture<>();

        Ion.with(context)
                .load(urlBase + "/login.php")
                .setBodyParameter("email", email)
                .setBodyParameter("senha", senha)
                .as(type)
                .setCallback((e, result) -> {
                    if (e == null) {
                        response.complete(result);
                    } else {
                        response.completeExceptionally(e);
                    }
                });

        return response;
    }

    public CompletableFuture<Boolean> alterar(final Context context, Usuario aluno) {
        TypeToken<Boolean> type = new TypeToken<Boolean>() {};
        CompletableFuture<Boolean> response = new CompletableFuture<>();

        Ion.with(context)
                .load(urlBase + "/alterar.php")
                .setBodyParameter("id", String.valueOf(aluno.getId()))
                .setBodyParameter("nome", aluno.getNome())
                .setBodyParameter("email", aluno.getEmail())
                .setBodyParameter("senha", aluno.getSenha())
                .setBodyParameter("assistencia", aluno.getAssistencia())
                .as(type)
                .setCallback((e, result) -> {
                    if (e == null) {
                        response.complete(result);
                    } else {
                        response.completeExceptionally(e);
                    }
                });

        return response;
    }
}
