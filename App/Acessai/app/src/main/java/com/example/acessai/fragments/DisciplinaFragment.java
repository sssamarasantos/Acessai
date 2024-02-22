package com.example.acessai.fragments;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.GridView;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.adapters.GridAdapterDisciplinas;
import com.example.acessai.classes.Disciplina;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
import com.example.acessai.rest.DisciplinaHttpClient;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;

public class DisciplinaFragment extends Fragment {

    public static String nome_disc;
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private GridView gridView;
    private GridAdapterDisciplinas gridAdapter;
    private final String HOST_APP = new Host().getUrlApp();

    private ArrayList<Disciplina> disciplinas;

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_disciplinav2, container, false);
        final Context context = inflater.getContext();

        disciplinas = buscarDisciplinas(context);

        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        gridView = (GridView) view.findViewById(R.id.gridView);

        utils.mostrarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

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

        gridAdapter = new GridAdapterDisciplinas(context, disciplinas);
        gridView.setAdapter(gridAdapter);



            return view;

    }

    private ArrayList<Disciplina> buscarDisciplinas(final Context context) {
        ArrayList<Disciplina> disciplinas = new ArrayList<>();

        DisciplinaHttpClient disciplinaHttpClient = new DisciplinaHttpClient();
        disciplinaHttpClient.buscar(context).thenAccept(disciplinas::addAll);
        disciplinas.add(new Disciplina(0, "a", "a"));

        return disciplinas;
    }

    private void listSubjects(final Context context) {
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