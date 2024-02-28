package com.example.acessai.classes;

import android.content.Context;
import android.media.MediaPlayer;
import android.net.Uri;
import android.view.View;
import android.widget.FrameLayout;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.appcompat.app.AlertDialog;

import com.example.acessai.enums.Assistencia;

public class Utils {
    public void showAlert(String message, final Context context){
	    //alertdialog - mostra um alerta na tela
        final AlertDialog.Builder builder = new AlertDialog.Builder(context);
        builder.setMessage(message);
        builder.setTitle("Aviso");
        builder.setPositiveButton("OK", null).create().show();
    }

    //metodo video
    public void showVideo(VideoView videoView, String videoPath){
        //String videoPath = "android.resource://" + getPackageName() + "/" + R.raw.video;
        Uri uri = Uri.parse(videoPath);
        videoView.setVideoURI(uri);
        videoView.start();
        videoView.setOnPreparedListener(new MediaPlayer.OnPreparedListener() {
            @Override
            public void onPrepared(MediaPlayer mediaPlayer) {
                mediaPlayer.setLooping(true);
            }
        });
    }

    //metodo chamar libras
    public void mostrarLibras(FrameLayout frameLayout, ToggleButton toggleButton, String assistencia){
	    //mantem as botoes invisiveis
        frameLayout.setVisibility(View.INVISIBLE);
        toggleButton.setVisibility(View.INVISIBLE);
	    //verifica a assistencia
        if (assistencia.equals("Auditiva")){
            toggleButton.setVisibility(View.VISIBLE);
        }
    }
}
