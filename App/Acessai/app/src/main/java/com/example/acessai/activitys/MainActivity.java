package com.example.acessai.activitys;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ProgressBar;

import androidx.appcompat.app.AppCompatActivity;

import com.example.acessai.R;
import com.example.acessai.classes.Session;

public class MainActivity extends AppCompatActivity {
    private ProgressBar progressBar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        progressBar = (ProgressBar) findViewById(R.id.progressBar);

        //Iniciar a contagem
        new Thread(() -> {
            progressBar();
            redirect();
        }).start();
    }

    //Método que irá executar algo durante o funcionamento da barra
    private void progressBar() {
        //Percorrer os valores da barra
        for (int p = 0; p < 100; p += 5)
        {
            try {
                Thread.sleep(100);
                progressBar.setProgress(p);
            } catch (Exception error) {
                error.printStackTrace();
            }
        }
    }

    //Método para redirecionar para outra tela, quando carregamento for concluído
    void redirect() {
        Intent intent;
        Session session = new Session(this);
        if (session.isLoggedIn()){
            intent = new Intent(MainActivity.this, HomeActivity.class);
        } else {
            intent = new Intent(MainActivity.this, LoginActivity.class);
        }

        startActivity(intent);
        MainActivity.this.finish();
    }
}
