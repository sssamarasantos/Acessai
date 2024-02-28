package com.example.acessai.rest;

import android.content.Context;

import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.classes.Disciplina;
import com.example.acessai.classes.Host;
import com.example.acessai.fragments.AssuntoFragment;
import com.example.acessai.fragments.HomeFragment;
import com.google.gson.reflect.TypeToken;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.CompletableFuture;

public class DisciplinaHttpClient {
    private final String HOST_API = new Host().getUrlApi();
    private final String urlBase = HOST_API + "/api/Disciplina";

    public CompletableFuture<ArrayList<Disciplina>> buscar(final Context context) {
        TypeToken<ArrayList<Disciplina>> type = new TypeToken<ArrayList<Disciplina>>() {};
        CompletableFuture<ArrayList<Disciplina>> response = new CompletableFuture<>();

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
