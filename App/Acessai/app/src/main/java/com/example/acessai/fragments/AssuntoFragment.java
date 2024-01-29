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
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.acessai.R;
import com.example.acessai.classes.Metodos;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;

public class AssuntoFragment extends Fragment {

    private ImageView fotoDisc;
    private TextView nomeDisc;
    private ListView listaAulas;
    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private List<String> listaa;
    private List<String> listaId;
    private ArrayAdapter<String> adaptador;
    private String host = "http://acessai1.000webhostapp.com/app/";
    //private String host = "http://192.168.15.9/tcc/";
    private String url = "", ret="", disc;
    public static String iAssunto, nAssunto;
    Metodos metodo = new Metodos();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_assunto, container, false);
        final Context context = inflater.getContext();

        fotoDisc = (ImageView) view.findViewById(R.id.imgDisc);
        nomeDisc = (TextView) view.findViewById(R.id.lblDisciplina);
        listaAulas = (ListView) view.findViewById(R.id.listaItens);
        frameLogin = (FrameLayout) view.findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
        listaa = new ArrayList<String>();
        listaId = new ArrayList<String>();

        listarAssuntos();
        metodo.chamarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        listaAulas.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                nAssunto = listaAulas.getItemAtPosition(position).toString();
                iAssunto = listaId.get(position);

                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, new AulasFragment()).addToBackStack(null).commit();

                //Intent objLista = new Intent(AssuntoActivity.this, AulasActivity.class);
                //startActivity(objLista);
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

    public void listarAssuntos(){
        url = host + "/disciplinaAula.php";
        Ion.with(getContext())
                .load(url)
                .setBodyParameter("nome_disc",DisciplinaFragment.nome_disc)
                .setBodyParameter("assistencia_videoaula", HomeFragment.assistenciaAluno)
                .asJsonArray()
                .setCallback(new FutureCallback<JsonArray>() {
                    @Override
                    public void onCompleted(Exception e, JsonArray result) {
                        for (int i = 0; i < result.size(); i++){
                            JsonObject ret = result.get(i).getAsJsonObject();
                            disc = ret.get("NOME_DISC").getAsString();
                            listaId.add(ret.get("ID_AULA").getAsString());
                            listaa.add(ret.get("NOME_AULA").getAsString());
                        }
                        nomeDisc.setText(disc);

                        if(disc.equals("Português")){
                            fotoDisc.setImageResource(R.drawable.imgport);
                        }

                        else if(disc.equals("Matemática")){
                            fotoDisc.setImageResource(R.drawable.imgmat);
                        }

                        else if(disc.equals("História")){
                            fotoDisc.setImageResource(R.drawable.imghist);
                        }

                        else if(disc.equals("Geografia")){
                            fotoDisc.setImageResource(R.drawable.imggeo);
                        }

                        else if(disc.equals("Biologia")){
                            fotoDisc.setImageResource(R.drawable.imgbio);
                        }

                        else if(disc.equals("Física")){
                            fotoDisc.setImageResource(R.drawable.imgfisic);
                        }

                        else if(disc.equals("Química")){
                            fotoDisc.setImageResource(R.drawable.imgquim);
                        }

                        else if(disc.equals("Filosofia")){
                            fotoDisc.setImageResource(R.drawable.imgfilo);
                        }

                        else if(disc.equals("Sociologia")){
                            fotoDisc.setImageResource(R.drawable.imgsocio);
                        }

                        else if(disc.equals("Arte")){
                            fotoDisc.setImageResource(R.drawable.imgart);
                        }

                        else if(disc.equals("Educação Física")){
                            fotoDisc.setImageResource(R.drawable.imgedfisic);
                        }

                        else if(disc.equals("Inglês")){
                            fotoDisc.setImageResource(R.drawable.imging);
                        }

                        adaptador = new ArrayAdapter<String>(getContext(), android.R.layout.simple_list_item_1, listaa);
                        adaptador.setDropDownViewResource(android.R.layout.simple_list_item_checked);
                        listaAulas.setAdapter(adaptador);
                    }
                });
    }
}