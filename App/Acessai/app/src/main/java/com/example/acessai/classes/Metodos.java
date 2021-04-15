//pacote
package com.example.acessai.classes;
//classes importadas
import android.content.Context;
import android.media.MediaPlayer;
import android.net.Uri;
import android.view.View;
import android.widget.FrameLayout;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.appcompat.app.AlertDialog;

import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
//metodo
public class Metodos {
    //atribuir variaveis
    String host = "http://acessai.000webhostapp.com/app/";
    //private String host = "http://192.168.15.9/tcc/";
    String url = "", ret = "";
    String id, nomeu, emailu, senhau, assistenciau;
    //metodo alerta
    public void alerta(String mensagem, final Context context){
	//alertdialog - mostra um alerta na tela
        final AlertDialog.Builder builder = new AlertDialog.Builder(context);
        builder.setMessage(mensagem);
        builder.setTitle("Aviso");
        builder.setPositiveButton("OK", null).create().show();
    }
    //metodo video
    public void video(VideoView v, String videoPath){
        //String videoPath = "android.resource://" + getPackageName() + "/" + R.raw.video;
        Uri uri = Uri.parse(videoPath);
        v.setVideoURI(uri);
        v.start();
        v.setOnPreparedListener(new MediaPlayer.OnPreparedListener() {
            @Override
            public void onPrepared(MediaPlayer mp) {
                mp.setLooping(true);
            }
        });
    }
    //metodo chamar libras
    public void chamarLibras(FrameLayout fl, ToggleButton tb, String assis){
	//mantem as botoes invisiveis
        fl.setVisibility(View.INVISIBLE);
        tb.setVisibility(View.INVISIBLE);
	//verifica a assistencia
        if (assis.equals("Auditiva")){
            tb.setVisibility(View.VISIBLE);
        }
    }
}
