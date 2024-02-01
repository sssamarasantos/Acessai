package com.example.acessai.fragments;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
import com.koushikdutta.ion.Ion;

public class DisciplinaFragment extends Fragment {

    public static String nome_disc;
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private final String HOST_APP = new Host().getUrlApp();

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_disciplina, container, false);
        final Context context = inflater.getContext();

        ImageButton disc1 = (ImageButton) view.findViewById(R.id.btnImgDisc1);
        ImageButton disc2 = (ImageButton) view.findViewById(R.id.btnImgDisc2);
        ImageButton disc3 = (ImageButton) view.findViewById(R.id.btnImgDisc3);
        ImageButton disc4 = (ImageButton) view.findViewById(R.id.btnImgDisc4);
        ImageButton disc5 = (ImageButton) view.findViewById(R.id.btnImgDisc5);
        ImageButton disc6 = (ImageButton) view.findViewById(R.id.btnImgDisc6);
        ImageButton disc7 = (ImageButton) view.findViewById(R.id.btnImgDisc7);
        ImageButton disc8 = (ImageButton) view.findViewById(R.id.btnImgDisc8);
        ImageButton disc9 = (ImageButton) view.findViewById(R.id.btnImgDisc9);
        ImageButton disc10 = (ImageButton) view.findViewById(R.id.btnImgDisc10);
        ImageButton disc11 = (ImageButton) view.findViewById(R.id.btnImgDisc11);
        ImageButton disc12 = (ImageButton) view.findViewById(R.id.btnImgDisc12);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);

        disc1.setOnClickListener(v -> {
            nome_disc = "Português";
            listSubjects(context);
        });
        disc2.setOnClickListener(v -> {
            nome_disc = "Matemática";
            listSubjects(context);
        });
        disc3.setOnClickListener(v -> {
            nome_disc = "História";
            listSubjects(context);
        });
        disc4.setOnClickListener(v -> {
            nome_disc = "Geografia";
            listSubjects(context);
        });
        disc5.setOnClickListener(v -> {
            nome_disc = "Biologia";
            listSubjects(context);
        });
        disc6.setOnClickListener(v -> {
            nome_disc = "Física";
            listSubjects(context);
        });
        disc7.setOnClickListener(v -> {
            nome_disc = "Química";
            listSubjects(context);
        });
        disc8.setOnClickListener(v -> {
            nome_disc = "Filosofia";
            listSubjects(context);
        });
        disc9.setOnClickListener(v -> {
            nome_disc = "Sociologia";
            listSubjects(context);
        });
        disc10.setOnClickListener(v -> {
            nome_disc = "Arte";
            listSubjects(context);
        });
        disc11.setOnClickListener(v -> {
            nome_disc = "Educação Física";
            listSubjects(context);
        });
        disc12.setOnClickListener(v -> {
            nome_disc = "Inglês";
            listSubjects(context);
        });

        utils.showLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        libras.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (isChecked) {
                libras.setText("");
                frameLibras.setVisibility(View.VISIBLE);
                //video
                String videoPath = "android.resource://" + context.getPackageName() + "/" + R.raw.video_demonstrar;
                utils.showVideo(videoLibras, videoPath);
            } else {
                libras.setText("");
                frameLibras.setVisibility(View.INVISIBLE);
            }
        });
        return view;
    }

    private void listSubjects(final Context context){
        String url = HOST_APP + "/verificarDisciplina.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("nome_disc", nome_disc)
                .setBodyParameter("assistencia_videoaula", HomeFragment.assistenciaAluno)
                .asJsonObject()
                .setCallback((e, result) -> {
                    String status = result.get("status").getAsString();

                    if (status.equals("ok")) {
                        FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                        FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                        fragmentTransaction.replace(R.id.fragment_container, new AssuntoFragment()).addToBackStack(null).commit();
                    } else {
                        utils.showAlert("Nenhuma aula adicionada", getContext());
                    }
                });
    }
}