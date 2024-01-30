package com.example.acessai.fragments;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
import com.google.gson.JsonObject;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;

public class AssuntoFragment extends Fragment {

    private ImageView fotoDisc;
    private TextView nomeDisc;
    private ListView listaAulas;
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private List<String> listaa;
    private List<String> listaId;
    private ArrayAdapter<String> adaptador;
    private final String HOST_APP = new Host().getUrlApp();
    public static String iAssunto, nAssunto;

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_assunto, container, false);
        final Context context = inflater.getContext();

        fotoDisc = (ImageView) view.findViewById(R.id.imgDisc);
        nomeDisc = (TextView) view.findViewById(R.id.lblDisciplina);
        listaAulas = (ListView) view.findViewById(R.id.listaItens);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        listaa = new ArrayList<>();
        listaId = new ArrayList<>();

        listClassSubject(context);
        utils.showLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        listaAulas.setOnItemClickListener((parent, view1, position, id) -> {
            nAssunto = listaAulas.getItemAtPosition(position).toString();
            iAssunto = listaId.get(position);

            FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
            FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, new AulasFragment()).addToBackStack(null).commit();
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

    private void listClassSubject(final Context context){
        String url = HOST_APP + "/disciplinaAula.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("nome_disc",DisciplinaFragment.nome_disc)
                .setBodyParameter("assistencia_videoaula", HomeFragment.assistenciaAluno)
                .asJsonArray()
                .setCallback((e, result) -> {
                    String disciplina = "";
                    for (int i = 0; i < result.size(); i++){
                        JsonObject response = result.get(i).getAsJsonObject();
                        disciplina = response.get("NOME_DISC").getAsString();
                        listaId.add(response.get("ID_AULA").getAsString());
                        listaa.add(response.get("NOME_AULA").getAsString());
                    }
                    nomeDisc.setText(disciplina);

                    switch (disciplina) {
                        case "Português":
                            fotoDisc.setImageResource(R.drawable.imgport);
                            break;
                        case "Matemática":
                            fotoDisc.setImageResource(R.drawable.imgmat);
                            break;
                        case "História":
                            fotoDisc.setImageResource(R.drawable.imghist);
                            break;
                        case "Geografia":
                            fotoDisc.setImageResource(R.drawable.imggeo);
                            break;
                        case "Biologia":
                            fotoDisc.setImageResource(R.drawable.imgbio);
                            break;
                        case "Física":
                            fotoDisc.setImageResource(R.drawable.imgfisic);
                            break;
                        case "Química":
                            fotoDisc.setImageResource(R.drawable.imgquim);
                            break;
                        case "Filosofia":
                            fotoDisc.setImageResource(R.drawable.imgfilo);
                            break;
                        case "Sociologia":
                            fotoDisc.setImageResource(R.drawable.imgsocio);
                            break;
                        case "Arte":
                            fotoDisc.setImageResource(R.drawable.imgart);
                            break;
                        case "Educação Física":
                            fotoDisc.setImageResource(R.drawable.imgedfisic);
                            break;
                        case "Inglês":
                            fotoDisc.setImageResource(R.drawable.imging);
                            break;
                        default:
                            utils.showAlert("Nenhuma aula foi encontrada!", getContext());
                    }

                    adaptador = new ArrayAdapter<>(context, android.R.layout.simple_list_item_1, listaa);
                    adaptador.setDropDownViewResource(android.R.layout.simple_list_item_checked);
                    listaAulas.setAdapter(adaptador);
                });
    }
}