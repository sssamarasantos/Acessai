package com.example.acessai.fragments;

import android.content.Context;
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
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.classes.Metodos;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

public class DisciplinaFragment extends Fragment {

    private ImageButton disc1, disc2, disc3, disc4, disc5, disc6, disc7, disc8, disc9, disc10, disc11, disc12;
    public static String nome_disc;
    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private String host = "http://acessai.000webhostapp.com/app/";
    //private String host = "http://192.168.15.9/tcc/";
    private String url = "", ret="";
    Metodos metodo = new Metodos();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_disciplina, container, false);
        final Context context = inflater.getContext();

        disc1 = (ImageButton) view.findViewById(R.id.btnImgDisc1);
        disc2 = (ImageButton) view.findViewById(R.id.btnImgDisc2);
        disc3 = (ImageButton) view.findViewById(R.id.btnImgDisc3);
        disc4 = (ImageButton) view.findViewById(R.id.btnImgDisc4);
        disc5 = (ImageButton) view.findViewById(R.id.btnImgDisc5);
        disc6 = (ImageButton) view.findViewById(R.id.btnImgDisc6);
        disc7 = (ImageButton) view.findViewById(R.id.btnImgDisc7);
        disc8 = (ImageButton) view.findViewById(R.id.btnImgDisc8);
        disc9 = (ImageButton) view.findViewById(R.id.btnImgDisc9);
        disc10 = (ImageButton) view.findViewById(R.id.btnImgDisc10);
        disc11 = (ImageButton) view.findViewById(R.id.btnImgDisc11);
        disc12 = (ImageButton) view.findViewById(R.id.btnImgDisc12);
        frameLogin = (FrameLayout) view.findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);

        disc1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Português";
                chamarDisciplina();
            }
        });
        disc2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Matemática";
                chamarDisciplina();
            }
        });
        disc3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "História";
                chamarDisciplina();
            }
        });
        disc4.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Geografia";
                chamarDisciplina();
            }
        });
        disc5.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Biologia";
                chamarDisciplina();
            }
        });
        disc6.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Física";
                chamarDisciplina();
            }
        });
        disc7.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Química";
                chamarDisciplina();
            }
        });
        disc8.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Filosofia";
                chamarDisciplina();
            }
        });
        disc9.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Sociologia";
                chamarDisciplina();
            }
        });
        disc10.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Arte";
                chamarDisciplina();
            }
        });
        disc11.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Educação Física";
                chamarDisciplina();
            }
        });
        disc12.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome_disc = "Inglês";
                chamarDisciplina();
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

    public void chamarDisciplina(){
        url = host + "/verificarDisciplina.php";
        Ion.with(getContext())
                .load(url)
                .setBodyParameter("nome_disc", nome_disc)
                .setBodyParameter("assistencia_videoaula", HomeFragment.assistenciaAluno)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception e, JsonObject result) {
                        ret = result.get("status").getAsString();

                        if (ret.equals("ok")) {
                            FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                            FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                            fragmentTransaction.replace(R.id.fragment_container, new AssuntoFragment()).addToBackStack(null).commit();
                            //Intent objIt = new Intent(DisciplinaActivity.this, AssuntoActivity.class);
                            //startActivity(objIt);
                        } else {
                            metodo.alerta("Nenhuma aula adicionada", getContext());
                        }
                    }
                });
    }
}