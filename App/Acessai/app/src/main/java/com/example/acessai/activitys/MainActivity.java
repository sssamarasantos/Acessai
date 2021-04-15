package com.example.acessai.activitys;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.ProgressBar;

import com.example.acessai.R;
import com.example.acessai.classes.Session;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.HashMap;

public class MainActivity extends AppCompatActivity {

    private ProgressBar carregar;
    Session session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        carregar = (ProgressBar) findViewById(R.id.progressBar);

        //Iniciar a contagem
        new Thread(new Runnable() {
            @Override
            public void run() {
                trabalho();
                chamarTela();
            }
        }).start();
    }
    //Método que irá executar algo durante o funcionamento da barra
    private void trabalho() {
        //Percorrer os valores da barra
        for (int p = 0; p < 100; p += 5)
        {
            try {
                Thread.sleep(100);
                carregar.setProgress(p);
            } catch (Exception erro) {
                erro.printStackTrace();
            }
        }
    }

    //Método para chamr a outra trla, quando carregamento for concluído
    void chamarTela() {
        session = new Session(this);
        if (session.checarLogin()){
            Intent i = new Intent(MainActivity.this, HomeActivity.class);
            startActivity(i);
            MainActivity.this.finish();
        } else {
            Intent in = new Intent(MainActivity.this, LoginActivity.class);
            startActivity(in);
            MainActivity.this.finish();
        }
    }
}
