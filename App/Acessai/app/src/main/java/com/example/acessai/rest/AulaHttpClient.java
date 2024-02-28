package com.example.acessai.rest;

import android.content.Context;

import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.fragments.AssuntoFragment;
import com.example.acessai.fragments.HomeFragment;
import com.google.gson.reflect.TypeToken;
import com.koushikdutta.ion.Ion;

import java.util.concurrent.CompletableFuture;

public class AulaHttpClient {
    private final String HOST_API = new Host().getUrlApi();
    private final String urlBase = HOST_API + "/api/Aula";

    public CompletableFuture<Boolean> contemAulas(final Context context, long id){
        TypeToken<Boolean> type = new TypeToken<Boolean>() {};
        CompletableFuture<Boolean> response = new CompletableFuture<>();

        Ion.with(context)
                .load(urlBase + "/Verificar/" + id)
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
