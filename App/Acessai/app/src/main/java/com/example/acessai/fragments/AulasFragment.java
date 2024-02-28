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
import com.example.acessai.adapters.ListAdapterAulas;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
import com.example.acessai.classes.Videoaulas;
import com.google.gson.JsonObject;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;

public class AulasFragment extends Fragment {

    private ListView lVideoaulas;
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private List<Videoaulas> videoaula;
    private List<String> idVideoaula;
    private ArrayAdapter<Videoaulas> adaptador;
    private ListAdapterAulas listAdapter;
    private final String HOST_APP = new Host().getUrlApp();
    public static String nVideoaula, iVideoaula;

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_aulas, container, false);
        final Context context = inflater.getContext();

        lVideoaulas = (ListView) view.findViewById(R.id.listaVideoaulas);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        videoaula = new ArrayList<>();
        idVideoaula = new ArrayList<>();

        list(context);
        utils.mostrarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        lVideoaulas.setOnItemClickListener((parent, view1, position, id) -> {
            iVideoaula = idVideoaula.get(position);
            nVideoaula = lVideoaulas.getItemAtPosition(position).toString();

            VideoaulaFragment vf = new VideoaulaFragment();
            Bundle bundle = new Bundle();
            bundle.putString("tipo", "assistir");
            vf.setArguments(bundle);
            FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
            FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, vf).addToBackStack(null).commit();
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

    private void list(final Context context) {
        String url = HOST_APP + "/aulas.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("id_aula", AssuntoFragment.iAssunto)
                .setBodyParameter("assistencia_aluno", HomeFragment.assistenciaAluno)
                .asJsonArray()
                .setCallback((e, result) -> {
                    for (int i = 0; i < result.size(); i++){
                        JsonObject response = result.get(i).getAsJsonObject();

                        Videoaulas videoaulas = new Videoaulas();
                        idVideoaula.add(response.get("ID_VIDEOAULA").getAsString());
                        videoaulas.setIdVideoaula(response.get("ID_VIDEOAULA").getAsInt());
                        videoaulas.setNomeVideoaula(response.get("NOME_VIDEOAULA").getAsString());
                        videoaula.add(videoaulas);
                    }

                    adaptador = new ArrayAdapter<>(context, android.R.layout.simple_list_item_1, videoaula);
                    adaptador.setDropDownViewResource(android.R.layout.simple_list_item_checked);
                    listAdapter = new ListAdapterAulas(context, videoaula);
                    lVideoaulas.setAdapter(listAdapter);
                });
    }
}