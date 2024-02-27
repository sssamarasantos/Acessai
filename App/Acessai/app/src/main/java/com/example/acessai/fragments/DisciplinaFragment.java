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
import com.example.acessai.classes.Utils;
import com.example.acessai.rest.AulaHttpClient;
import com.example.acessai.rest.DisciplinaHttpClient;

import java.util.ArrayList;
import java.util.function.Consumer;

public class DisciplinaFragment extends Fragment {

    public static String nome_disc;
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private GridView gridView;
    private GridAdapterDisciplinas gridAdapter;
    private ArrayList<Disciplina> disciplinas;

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_disciplinav2, container, false);
        final Context context = inflater.getContext();

        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        gridView = (GridView) view.findViewById(R.id.gridView);

        utils.mostrarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        buscarDisciplinas(context, disciplinas -> {
            this.disciplinas = disciplinas;
            gridAdapter = new GridAdapterDisciplinas(context, this.disciplinas);
            gridView.setAdapter(gridAdapter);
        });

        gridView.setOnItemClickListener((parent, view1, position, id) -> {
            contemAulas(context, position);
        });

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

    private void buscarDisciplinas(final Context context, final Consumer<ArrayList<Disciplina>> callback) {
        DisciplinaHttpClient disciplinaHttpClient = new DisciplinaHttpClient();
        disciplinaHttpClient.buscar(context).thenAccept(disciplinas -> {
            requireActivity().runOnUiThread(() -> {
                callback.accept(disciplinas);
            });
        });
    }

    private void contemAulas(final Context context, long id) {
        AulaHttpClient aulaHttpClient = new AulaHttpClient();
        aulaHttpClient.contemAulas(context, id).thenAccept(result -> {
            if (result) {
                FragmentManager fragmentManager = requireActivity().getSupportFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, new AssuntoFragment()).addToBackStack(null).commit();
            } else {
                utils.showAlert("Nenhuma aula adicionada", getContext());
            }
        });
    }
}