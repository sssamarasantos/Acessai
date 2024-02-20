package com.example.acessai.rest;

import android.content.Context;

import com.example.acessai.classes.Disciplina;
import com.example.acessai.classes.Host;
import com.google.gson.reflect.TypeToken;
import com.koushikdutta.ion.Ion;

import java.util.List;
import java.util.concurrent.CompletableFuture;

public class DisciplinaHttpClient {
    private final String HOST_API = new Host().getUrlApi();
    private final String urlBase = HOST_API + "/api/Disciplina";

    public CompletableFuture<List<Disciplina>> buscar(Context context) {
        TypeToken<List<Disciplina>> type = new TypeToken<List<Disciplina>>() {};
        CompletableFuture<List<Disciplina>> response = new CompletableFuture<>();

        Ion.with(context)
                .load("GET", urlBase)
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
