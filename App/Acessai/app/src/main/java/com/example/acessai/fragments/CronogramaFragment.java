package com.example.acessai.fragments;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.adapters.ListaAdapterCrono;
import com.example.acessai.classes.Cronograma;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.gson.JsonObject;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;

public class CronogramaFragment extends Fragment {

    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private ListView listaCrono;
    private List<Cronograma> cronogramas;
    private List<String> idVideoaula;
    private ArrayAdapter<Cronograma> adaptador;
    private ListaAdapterCrono listAdapter;
    public static String iVideoaula, nVideoaula;
    private final String HOST_APP = new Host().getUrlApp();

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_cronograma, container, false);
        final Context context = inflater.getContext();

        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        listaCrono = (ListView) view.findViewById(R.id.listaCrono);
        FloatingActionButton addCrono = (FloatingActionButton) view.findViewById(R.id.flAdd);
        cronogramas = new ArrayList<>();
        idVideoaula = new ArrayList<>();

        listSchedule(context);

        listaCrono.setOnItemClickListener((parent, view1, position, id) -> {
            iVideoaula = idVideoaula.get(position);
            nVideoaula = listaCrono.getItemAtPosition(position).toString();

            VideoaulaFragment vf = new VideoaulaFragment();
            Bundle bundle = new Bundle();
            bundle.putString("tipo", "crono");
            vf.setArguments(bundle);
            FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
            FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, vf).addToBackStack(null).commit();
        });

        addCrono.setOnClickListener(v -> {
            CriarCronoFragment cf = new CriarCronoFragment();
            Bundle bundle = new Bundle();
            bundle.putString("tipo", "adicionar");
            cf.setArguments(bundle);
            FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
            FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, cf).commit();
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
    public void listSchedule(final Context context){
        String url = HOST_APP + "/listarCrono.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .asJsonArray()
                .setCallback((e, result) -> {
                    for (int i = 0; i < result.size(); i++){
                        JsonObject response = result.get(i).getAsJsonObject();

                        Cronograma cronograma = new Cronograma();
                        cronograma.setIdCronograma(response.get("ID_CRONO").getAsInt());
                        cronograma.setDisciplina(response.get("NOME_DISC").getAsString());
                        cronograma.setData(response.get("DTA_CRONO").getAsString());
                        cronograma.setHora(response.get("HORA_CRONO").getAsString());
                        cronograma.setDisciplina(response.get("NOME_DISC").getAsString());
                        idVideoaula.add(response.get("ID_VIDEOAULA").getAsString());
                        cronograma.setVideo(response.get("NOME_VIDEOAULA").getAsString());
                        cronogramas.add(cronograma);
                    }

                    adaptador = new ArrayAdapter<>(context, android.R.layout.simple_list_item_1, cronogramas);
                    adaptador.setDropDownViewResource(android.R.layout.simple_list_item_checked);
                    listAdapter = new ListaAdapterCrono(context, cronogramas);
                    listaCrono.setAdapter(listAdapter);
                });
    }
}