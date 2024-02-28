//pacote
package com.example.acessai.fragments;
//classes importadas

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
import com.example.acessai.classes.Session;
import com.example.acessai.classes.Utils;
import com.example.acessai.rest.AlunoHttpClient;

import java.util.HashMap;

public class HomeFragment extends Fragment {
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    public static String idAluno, assistenciaAluno;
    Session session;

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_home, container, false);
        final Context context = inflater.getContext();
        session = new Session(context);
	    //instância dos elementos da tela
        //declaração das variaveis
        ImageButton infos = (ImageButton) view.findViewById(R.id.btnImgInfos);
        ImageButton aulas = (ImageButton) view.findViewById(R.id.btnImgAulas);
        ImageButton cronograma = (ImageButton) view.findViewById(R.id.btnImgCrono);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);

	    //recupera os valores da "sessao"
        session = new Session(getActivity());
        HashMap<String, String> usuario = session.getUserDetails();
        String email = usuario.get(Session.KEY_EMAIL);
	    //chama o metodo usuario
        chamarAssistencia(email);

        //mantem o botão e video de libras escondidos
        libras.setVisibility(View.INVISIBLE);
        frameLibras.setVisibility(View.INVISIBLE);

        infos.setOnClickListener(v -> {
            //rediciona para o fragmento infos
            FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
            FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, new InfosFragment()).addToBackStack(null).commit();
        });

	    //evento do botao aulas
        aulas.setOnClickListener(v -> {
            //rediciona para o fragmento aulas
            FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
            FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, new DisciplinaFragment()).addToBackStack(null).commit();
        });

	    //evento do botão cronograma
        cronograma.setOnClickListener(v -> {
            //rediciona para o fragmento cronograma
            FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
            FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, new CronogramaFragment()).addToBackStack(null).commit();
        });

	    //evento do botão libras
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

    //metodo chamar usuário
    private void chamarAssistencia(String email) {
        AlunoHttpClient alunoHttpClient = new AlunoHttpClient();
        alunoHttpClient.buscar(getActivity(), email).thenAccept(result -> {
            assistenciaAluno = result.getAssistencia();

            utils.mostrarLibras(frameLibras, libras, assistenciaAluno);
        });
    }
}