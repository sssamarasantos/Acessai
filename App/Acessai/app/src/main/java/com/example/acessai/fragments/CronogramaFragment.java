package com.example.acessai.fragments;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.CompoundButton;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.adapters.ListaAdapterCrono;
import com.example.acessai.classes.Cronograma;
import com.example.acessai.classes.Metodos;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;

public class CronogramaFragment extends Fragment {

    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private ImageButton falar;
    private ListView listaCrono;
    private FloatingActionButton addCrono;
    private List<Cronograma> cronogramas;
    private List<String> idVideoaula;
    private ArrayAdapter<Cronograma> adaptador;
    private ListaAdapterCrono listAdapter;
    public static String iVideoaula, nVideoaula;
    private String host = "http://acessai1.000webhostapp.com/app/";
    private String url = "", ret="", s="";
    Metodos metodo = new Metodos();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_cronograma, container, false);
        final Context context = inflater.getContext();

        frameLogin = (FrameLayout) view.findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        listaCrono = (ListView) view.findViewById(R.id.listaCrono);
        addCrono = (FloatingActionButton) view.findViewById(R.id.flAdd);
        cronogramas = new ArrayList<Cronograma>();
        idVideoaula = new ArrayList<String>();

        listarCrono(context);

        listaCrono.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                iVideoaula = idVideoaula.get(position);
                nVideoaula = listaCrono.getItemAtPosition(position).toString();

                VideoaulaFragment vf = new VideoaulaFragment();
                Bundle bundle = new Bundle();
                bundle.putString("tipo", "crono");
                vf.setArguments(bundle);
                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, vf).addToBackStack(null).commit();
            }
        });

        addCrono.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                CriarCronoFragment cf = new CriarCronoFragment();
                Bundle bundle = new Bundle();
                bundle.putString("tipo", "adicionar");
                cf.setArguments(bundle);
                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, cf).commit();
                //Intent trocar = new Intent(CronogramaActivity.this, CriarCronoActivity.class);
                //startActivity(trocar);
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
    public void listarCrono(final Context con){
        url = host + "/listarCrono.php";
        Ion.with(con)
                .load(url)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .asJsonArray()
                .setCallback(new FutureCallback<JsonArray>() {
                    @Override
                    public void onCompleted(Exception e, JsonArray result) {
                        for (int i = 0; i < result.size(); i++){
                            JsonObject ret = result.get(i).getAsJsonObject();

                            Cronograma cronograma = new Cronograma();
                            cronograma.setIdCronograma(ret.get("ID_CRONO").getAsInt());
                            cronograma.setDisciplina(ret.get("NOME_DISC").getAsString());
                            cronograma.setData(ret.get("DTA_CRONO").getAsString());
                            cronograma.setHora(ret.get("HORA_CRONO").getAsString());
                            cronograma.setDisciplina(ret.get("NOME_DISC").getAsString());
                            idVideoaula.add(ret.get("ID_VIDEOAULA").getAsString());
                            cronograma.setVideo(ret.get("NOME_VIDEOAULA").getAsString());
                            cronogramas.add(cronograma);
                        }

                        adaptador = new ArrayAdapter<Cronograma>(con, android.R.layout.simple_list_item_1, cronogramas);
                        adaptador.setDropDownViewResource(android.R.layout.simple_list_item_checked);
                        listAdapter = new ListaAdapterCrono(con, cronogramas);
                        listaCrono.setAdapter(listAdapter);
                    }
                });
    }
}