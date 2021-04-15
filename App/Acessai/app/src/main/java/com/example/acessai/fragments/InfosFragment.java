package com.example.acessai.fragments;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CompoundButton;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.fragment.app.Fragment;

import com.example.acessai.R;
import com.example.acessai.classes.Metodos;

public class InfosFragment extends Fragment {

    private ImageButton contato, sobreNos;
    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    Metodos metodo = new Metodos();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_infos, container, false);
        final Context context = inflater.getContext();

        sobreNos = (ImageButton) view.findViewById(R.id.btnImgSobre);
        contato = (ImageButton) view.findViewById(R.id.btnImgContato);
        frameLogin = (FrameLayout) view.findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);

        sobreNos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Uri acessar = Uri.parse("http://acessai.000webhostapp.com/site/sobre.php");
                Intent i = new Intent(Intent.ACTION_VIEW, acessar);
                startActivity(i);
            }
        });
        contato.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Uri acessar = Uri.parse("http://acessai.000webhostapp.com/site/contato.php");
                Intent i = new Intent(Intent.ACTION_VIEW, acessar);
                startActivity(i);
            }
        });

        metodo.chamarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        libras.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked) {
                    libras.setText("");
                    frameLibras.setVisibility(View.VISIBLE);
                    //video
                    String videoPath = "android.resource://" + context.getPackageName() + "/" + R.raw.video_demonstrar;
                    metodo.video(videoLibras, videoPath);
                } else {
                    libras.setText("");
                    frameLibras.setVisibility(View.INVISIBLE);
                }
            }
        });
        return view;
    }
}