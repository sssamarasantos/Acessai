package com.example.acessai.fragments;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.CompoundButton;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.adapters.ListAdapterAulas;
import com.example.acessai.classes.Metodos;
import com.example.acessai.classes.Videoaulas;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;

public class AulasFragment extends Fragment {

    private ListView lVideoaulas;
    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private List<Videoaulas> videoaula;
    private List<String> idVideoaula;
    private ArrayAdapter<Videoaulas> adaptador;
    private ListAdapterAulas listAdapter;
    private String host = "http://acessai.000webhostapp.com/app/";
    private String url = "", ret = "";
    public static String nVideoaula, iVideoaula;
    Metodos metodo = new Metodos();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_aulas, container, false);
        final Context context = inflater.getContext();

        lVideoaulas = (ListView) view.findViewById(R.id.listaVideoaulas);
        frameLogin = (FrameLayout) view.findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        videoaula = new ArrayList<Videoaulas>();
        idVideoaula = new ArrayList<String>();

        listar(context);
        metodo.chamarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        lVideoaulas.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                iVideoaula = idVideoaula.get(position);
                nVideoaula = lVideoaulas.getItemAtPosition(position).toString();

                VideoaulaFragment vf = new VideoaulaFragment();
                Bundle bundle = new Bundle();
                bundle.putString("tipo", "assistir");
                vf.setArguments(bundle);
                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, vf).addToBackStack(null).commit();

                //Intent trocar = new Intent(AulasActivity.this, VideoaulaActivity.class);
                //startActivity(trocar);
                //AulasActivity.this.finish();
            }
        });

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

    private void listar(final Context con) {
        url = host + "/aulas.php";
        Ion.with(getContext())
                .load(url)
                .setBodyParameter("id_aula", AssuntoFragment.iAssunto)
                .setBodyParameter("assistencia_aluno", HomeFragment.assistenciaAluno)
                .asJsonArray()
                .setCallback(new FutureCallback<JsonArray>() {
                    @Override
                    public void onCompleted(Exception e, JsonArray result) {
                        for (int i = 0; i < result.size(); i++){
                            JsonObject ret = result.get(i).getAsJsonObject();

                            Videoaulas videoaulas = new Videoaulas();
                            idVideoaula.add(ret.get("ID_VIDEOAULA").getAsString());
                            videoaulas.setIdVideoaula(ret.get("ID_VIDEOAULA").getAsInt());
                            videoaulas.setNomeVideoaula(ret.get("NOME_VIDEOAULA").getAsString());
                            videoaula.add(videoaulas);
                        }

                        adaptador = new ArrayAdapter<Videoaulas>(con, android.R.layout.simple_list_item_1, videoaula);
                        adaptador.setDropDownViewResource(android.R.layout.simple_list_item_checked);
                        listAdapter = new ListAdapterAulas(con, videoaula);
                        lVideoaulas.setAdapter(listAdapter);
                    }
                });
    }
}