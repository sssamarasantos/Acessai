package com.example.acessai.fragments;

import android.annotation.SuppressLint;
import android.content.ActivityNotFoundException;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.text.TextUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.CheckedTextView;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.MediaController;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.example.acessai.R;
import com.example.acessai.adapters.ListAdapterDuvidas;
import com.example.acessai.classes.Duvidas;
import com.example.acessai.classes.Metodos;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import static androidx.core.provider.FontsContractCompat.FontRequestCallback.RESULT_OK;

public class VideoaulaFragment extends Fragment {

    private VideoView videoAula;
    private TextView titulo, autor, data, classifica;
    private CheckedTextView visto, rever;
    private RatingBar classificar;
    private ListView listComent;
    private List<Duvidas> lComentarios;
    private ArrayAdapter<Duvidas> adaptador;
    private ListAdapterDuvidas listAdapterDuvidas;
    private EditText comentar;
    private ImageButton enviar, falar;
    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private String url = "", ret = "", nStatus, aStatus, nClassificar, classificacao;
    public static String nVideo, nTitulo, nAutor, nData, idAutor, idVideoula;
    private String host = "http://acessai.000webhostapp.com/app/";
    private final int ID_TEXTO_PARA_VOZ = 100;
    boolean dadosValidados;
    Metodos metodo = new Metodos();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_videoaula, container, false);
        final Context context = inflater.getContext();

        videoAula = (VideoView) view.findViewById(R.id.videoAula);
        titulo = (TextView) view.findViewById(R.id.lblTitulo);
        autor = (TextView) view.findViewById(R.id.lblAutor);
        data = (TextView) view.findViewById(R.id.lblData);
        visto = (CheckedTextView) view.findViewById(R.id.chTextVisto);
        rever = (CheckedTextView) view.findViewById(R.id.chTextRever);
        classificar = (RatingBar) view.findViewById(R.id.ratingBar);
        classifica = (TextView) view.findViewById(R.id.lblClassificacao);
        listComent = (ListView) view.findViewById(R.id.listaComent);
        comentar = (EditText) view.findViewById(R.id.txtComent);
        enviar = (ImageButton) view.findViewById(R.id.btnImgEnviar);
        falar = (ImageButton) view.findViewById(R.id.btnImgFalarV);
        frameLogin = (FrameLayout) view.findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);

        String tipo = this.getArguments().getString("tipo");

        if (tipo.equals("crono")){
            idVideoula = CronogramaFragment.iVideoaula;
        } else {
            idVideoula = AulasFragment.iVideoaula;
        }

        lComentarios = new ArrayList<Duvidas>();

        chamarVideo(context);
        verificarItem();
        exibirComentarios(context);
        metodo.chamarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        visto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                visto.toggle();
                if(visto.isChecked()) {
                    if (nStatus.equals("nenhum")) {
                        inserirItem();
                    } else{
                        aStatus = "Visto";
                        alterarStatus();
                        rever.setChecked(false);
                    }
                }
            }
        });
        rever.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                rever.toggle();
                if(rever.isChecked()){
                    if (nStatus.equals("nenhum")){
                        inserirItem();
                    } else {
                        aStatus = "Rever";
                        alterarStatus();
                        visto.setChecked(false);
                    }
                }
            }
        });

        classificar.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {
            @Override
            public void onRatingChanged(RatingBar ratingBar, float rating, boolean fromUser) {
                if (nClassificar.equals("nenhum")) {
                    inserirItem();
                }
                classifica.setText(String.valueOf(rating));
                classificacao = String.valueOf(rating);
                classificar();
            }
        });

        enviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                comentar();
            }
        });

        falar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent iVoz = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
                iVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);
                iVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());
                iVoz.putExtra(RecognizerIntent.EXTRA_PROMPT, "Fale agora");

                try {
                    startActivityForResult(iVoz, ID_TEXTO_PARA_VOZ);
                } catch (ActivityNotFoundException a){
                    metodo.alerta("Dispositivo não suporta!", context);
                }
            }
        });

        metodo.chamarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        libras.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked) {
                    libras.setText("");
                    //libras.setBackgroundResource(R.drawable.logo);
                    frameLibras.setVisibility(View.VISIBLE);
                    //video
                    String videoPath = "android.resource://" + context.getPackageName() + "/" + R.raw.video_demonstrar;
                    metodo.video(videoLibras, videoPath);
                } else {
                    libras.setText("");
                    //libras.setBackgroundResource(R.drawable.teste);
                    frameLibras.setVisibility(View.INVISIBLE);
                }
            }
        });
        return view;
    }

    private void chamarVideo(final Context con){
        url = host + "/chamarVideo.php";
        Ion.with(con)
                .load(url)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonArray()
                .setCallback(new FutureCallback<JsonArray>() {
                    @SuppressLint("SetTextI18n")
                    @Override
                    public void onCompleted(Exception e, JsonArray result) {
                        for (int i = 0; i < result.size(); i++){
                            JsonObject ret = result.get(i).getAsJsonObject();

                            nTitulo = ret.get("NOME_VIDEOAULA").getAsString();
                            nVideo = ret.get("VIDEO_VIDEOAULA").getAsString();
                            nData = ret.get("DTA_POST_VIDEOAULA").getAsString();
                            nAutor = ret.get("NOME_PROF").getAsString();
                            idAutor = ret.get("ID_PROF").getAsString();
                        }
                        titulo.setText(nTitulo);
                        autor.setText("Professor: " + nAutor);
                        data.setText("Data do envio: " + nData);

                        Uri uri = Uri.parse("http://acessai.000webhostapp.com/videoaulas/" + nVideo);
                        videoAula.setVideoURI(uri);
                        videoAula.start();

                        MediaController mediaController = new MediaController(con);
                        videoAula.setMediaController(mediaController);
                        mediaController.setAnchorView(videoAula);
                    }
                });
    }

    private void verificarItem(){
        url = host + "/verificar.php";
        Ion.with(getContext())
                .load(url)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonArray()
                .setCallback(new FutureCallback<JsonArray>() {
                    @Override
                    public void onCompleted(Exception e, JsonArray result) {
                        for (int i = 0; i < result.size(); i++){
                            JsonObject ret = result.get(i).getAsJsonObject();
                            nStatus = ret.get("STATUS_ITEM_AULA").getAsString();
                            nClassificar = ret.get("CLASSIFICAR_ITEM_AULA").getAsString();
                        }

                        if (nStatus.equals("Rever")) {
                            rever.setChecked(true);
                        }
                        if (nStatus.equals("Visto")) {
                            visto.setChecked(true);
                        }
                        if (nStatus.equals("-") || nStatus.equals("nenhum")) {
                            rever.setChecked(false);
                            visto.setChecked(false);
                        }

                        if (!nClassificar.equals("-") && !nClassificar.equals("nenhum")) {
                            classificar.setRating(Float.parseFloat(nClassificar));
                            classifica.setText(String.valueOf(nClassificar));
                        } else {
                            classificar.setRating(0);
                            classifica.setText("");
                        }
                    }
                });
    }

    private void inserirItem(){
        url = host + "/inserirItem.php";
        Ion.with(getContext())
                .load(url)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception e, JsonObject result) {
                        ret = result.get("status").getAsString();
                    }
                });
    }

    private void alterarStatus(){
        url = host + "/alterarStatus.php";
        Ion.with(getContext())
                .load(url)
                .setBodyParameter("status_item_aula", aStatus)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception e, JsonObject result) {
                        ret = result.get("status").getAsString();
                    }
                });
    }

    private void classificar(){
        url = host + "/classificar.php";
        Ion.with(getContext())
                .load(url)
                .setBodyParameter("classificar_item_aula", classificacao)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception e, JsonObject result) {
                        ret = result.get("status").getAsString();
                    }
                });
    }

    private void exibirComentarios(final Context con){
        lComentarios.clear();
        url = host + "/exibirComentarios.php";
        Ion.with(con)
                .load(url)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonArray()
                .setCallback(new FutureCallback<JsonArray>() {
                    @Override
                    public void onCompleted(Exception e, JsonArray result) {
                        for (int i = 0; i < result.size(); i++){
                            JsonObject ret = result.get(i).getAsJsonObject();

                            Duvidas duvidas = new Duvidas();
                            duvidas.setIdDuvida(ret.get("ID_DUVIDA").getAsInt());
                            duvidas.setNomeAluno(ret.get("NOME_ALUNO").getAsString());
                            duvidas.setMsgDuvida(ret.get("MSG_DUVIDA").getAsString());
                            duvidas.setDataHoraMsg(ret.get("DTAHR_MSG_DUVIDA").getAsString());
                            duvidas.setNomeProf(ret.get("NOME_PROF").getAsString());
                            duvidas.setRespDuvida(ret.get("RESP_DUVIDA").getAsString());
                            duvidas.setDataHoraResp(ret.get("DTAHR_RESP_DUVIDA").getAsString());
                            lComentarios.add(duvidas);
                        }

                        adaptador = new ArrayAdapter<Duvidas>(con, android.R.layout.simple_list_item_1, lComentarios);
                        adaptador.setDropDownViewResource(android.R.layout.simple_list_item_checked);
                        listAdapterDuvidas= new ListAdapterDuvidas(con, lComentarios);
                        listComent.setAdapter(listAdapterDuvidas);
                    }
                });
    }

    private void comentar(){
        dadosValidados = validarCampos();

        if (dadosValidados) {
            url = host + "/comentar.php";
            Ion.with(getContext())
                    .load(url)
                    .setBodyParameter("id_aluno", HomeFragment.idAluno)
                    .setBodyParameter("id_videoaula", idVideoula)
                    .setBodyParameter("id_prof", idAutor)
                    .setBodyParameter("msg_duvida", comentar.getText().toString())
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception e, JsonObject result) {
                            ret = result.get("status").getAsString();

                            if (ret.equals("ok")) {
                                Toast.makeText(getContext(), "Comentado", Toast.LENGTH_SHORT).show();
                            } else {
                                Toast.makeText(getContext(), "Algo deu errado :(", Toast.LENGTH_SHORT).show();
                            }

                            comentar.setText("");
                            exibirComentarios(getActivity());
                        }
                    });
        }
    }

    //Metodo para validar os campos
    private boolean validarCampos() {
        boolean retorno = false;

        if (!TextUtils.isEmpty(comentar.getText().toString())) {
            if (comentar.getText().toString().length()<=100) {
                retorno = true;
            } else {
                metodo.alerta("Texto muito longo", getContext());
            }
        } else {
            metodo.alerta("Campo vazio!", getContext());
        }
        return retorno;
    }

    @SuppressLint("RestrictedApi")
    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        switch (requestCode){
            case ID_TEXTO_PARA_VOZ:
                if (resultCode == RESULT_OK && null != data){
                    ArrayList<String> resultado = data
                            .getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
                    String ditado = resultado.get(0);

                    comentar.setText(ditado);
                }
                break;
        }
    }
}