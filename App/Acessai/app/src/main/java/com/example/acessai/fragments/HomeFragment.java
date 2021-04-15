//pacote
package com.example.acessai.fragments;
//classes importadas
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
import com.example.acessai.classes.Session;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.HashMap;
//classe principal do fragmento
public class HomeFragment extends Fragment {
    //declaração das variaveis
    private ImageButton infos, aulas, cronograma;
    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private String host = "http://acessai.000webhostapp.com/app/";
    //private String host = "http://192.168.15.9/tcc/";
    private String url = "", ret = "";
    public static String idAluno, assistenciaAluno;
    Session session;
    //instancia do metodo Metodos
    Metodos metodo = new Metodos();
    //classe responsavel por criar o fragmento
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_home, container, false);
        final Context context = inflater.getContext();
        session = new Session(context);
	//instância dos elementos da tela
        infos = (ImageButton) view.findViewById(R.id.btnImgInfos);
        aulas = (ImageButton) view.findViewById(R.id.btnImgAulas);
        cronograma = (ImageButton) view.findViewById(R.id.btnImgCrono);
        frameLogin = (FrameLayout) view.findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);
	//recupera os valores da "sessao"
        session = new Session(getActivity());
        HashMap<String, String> usuario = session.getUserDetails();
        String user = usuario.get(Session.KEY_EMAIL);
	//chama o metodo usuario
        chamarUsuario(user);
	//evento do botao infos
        infos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
		//rediciona para o fragmento infos
                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, new InfosFragment()).addToBackStack(null).commit();
            }
        });
	//evento do botao aulas
        aulas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
		//rediciona para o fragmento aulas
                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, new DisciplinaFragment()).addToBackStack(null).commit();
            }
        });
	//evento do botão cronograma
        cronograma.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
		//rediciona para o fragmento cronograma
                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, new CronogramaFragment()).addToBackStack(null).commit();
            }
        });
	//mantem o botão e video de libras escondidos
        libras.setVisibility(View.INVISIBLE);
        frameLibras.setVisibility(View.INVISIBLE);
	//evento do botão libras
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
    //metodo chamar usuário
    public void chamarUsuario(String user) {
        url = host + "/usuario.php";
        Ion.with(getActivity())
                .load(url)
                .setBodyParameter("usuario", user)
                .asJsonArray()
                .setCallback(new FutureCallback<JsonArray>() {
                    @Override
                    public void onCompleted(Exception e, JsonArray result) {
			//recebe os valores e atribui para cada variavel
                        for (int i = 0; i < result.size(); i++){
                            JsonObject ret = result.get(i).getAsJsonObject();
                            idAluno = ret.get("ID_ALUNO").getAsString();
                            assistenciaAluno = ret.get("ASSISTENCIA_ALUNO").getAsString();
                        }
                        metodo.chamarLibras(frameLibras, libras, assistenciaAluno);
                    }
                });
    }
}