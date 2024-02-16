package com.example.acessai.fragments;

import static androidx.core.provider.FontsContractCompat.FontRequestCallback.RESULT_OK;

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
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

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
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private String nStatus, aStatus, nClassificar, classificacao;
    public static String nVideo, nTitulo, nAutor, nData, idAutor, idVideoula;
    private final String HOST_APP = new Host().getUrlApp();
    private final int ID_TEXTO_PARA_VOZ = 100;

    Utils utils = new Utils();

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
        ImageButton enviar = (ImageButton) view.findViewById(R.id.btnImgEnviar);
        ImageButton falar = (ImageButton) view.findViewById(R.id.btnImgFalarV);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);

        assert this.getArguments() != null;
        String tipo = this.getArguments().getString("tipo");

        assert tipo != null;
        if (tipo.equals("crono")){
            idVideoula = CronogramaFragment.iVideoaula;
        } else {
            idVideoula = AulasFragment.iVideoaula;
        }

        lComentarios = new ArrayList<>();

        chamarVideo(context);
        verificarItem(context);
        displayComments(context);
        utils.mostrarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        visto.setOnClickListener(v -> {
            visto.toggle();
            if(visto.isChecked()) {
                if (nStatus.equals("nenhum")) {
                    insertItem(context);
                } else{
                    aStatus = "Visto";
                    updateStatus(context);
                    rever.setChecked(false);
                }
            }
        });
        rever.setOnClickListener(v -> {
            rever.toggle();
            if(rever.isChecked()){
                if (nStatus.equals("nenhum")){
                    insertItem(context);
                } else {
                    aStatus = "Rever";
                    updateStatus(context);
                    visto.setChecked(false);
                }
            }
        });

        classificar.setOnRatingBarChangeListener((ratingBar, rating, fromUser) -> {
            if (nClassificar.equals("nenhum")) {
                insertItem(context);
            }
            classifica.setText(String.valueOf(rating));
            classificacao = String.valueOf(rating);
            classifyClass(context);
        });

        enviar.setOnClickListener(v -> comment(comentar.getText().toString(), context));

        falar.setOnClickListener(v -> {
            Intent intentVoz = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
            intentVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);
            intentVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());
            intentVoz.putExtra(RecognizerIntent.EXTRA_PROMPT, "Fale agora");

            try {
                startActivityForResult(intentVoz, ID_TEXTO_PARA_VOZ);
            } catch (ActivityNotFoundException a){
                utils.showAlert("Dispositivo não suporta!", context);
            }
        });

        utils.mostrarLibras(frameLibras, libras, HomeFragment.assistenciaAluno);

        libras.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (isChecked) {
                libras.setText("");
                //libras.setBackgroundResource(R.drawable.logo);
                frameLibras.setVisibility(View.VISIBLE);
                //video
                String videoPath = "android.resource://" + context.getPackageName() + "/" + R.raw.video_demonstrar;
                utils.showVideo(videoLibras, videoPath);
            } else {
                libras.setText("");
                //libras.setBackgroundResource(R.drawable.teste);
                frameLibras.setVisibility(View.INVISIBLE);
            }
        });
        return view;
    }

    private void chamarVideo(final Context context){
        String url = HOST_APP + "/chamarVideo.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonArray()
                .setCallback((e, result) -> {
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

                    MediaController mediaController = new MediaController(context);
                    videoAula.setMediaController(mediaController);
                    mediaController.setAnchorView(videoAula);
                });
    }

    private void verificarItem(final Context context){
        String url = HOST_APP + "/verificar.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonArray()
                .setCallback((e, result) -> {
                    for (int i = 0; i < result.size(); i++){
                        JsonObject response = result.get(i).getAsJsonObject();
                        nStatus = response.get("STATUS_ITEM_AULA").getAsString();
                        nClassificar = response.get("CLASSIFICAR_ITEM_AULA").getAsString();
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
                });
    }

    private void insertItem(final Context context){
        String url = HOST_APP + "/inserirItem.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonObject();
    }

    private void updateStatus(final Context context){
        String url = HOST_APP + "/alterarStatus.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("status_item_aula", aStatus)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonObject();
    }

    private void classifyClass(final Context context){
        String url = HOST_APP + "/classificar.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("classificar_item_aula", classificacao)
                .setBodyParameter("id_aluno", HomeFragment.idAluno)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonObject();
    }

    private void displayComments(final Context context){
        lComentarios.clear();
        String url = HOST_APP + "/exibirComentarios.php";
        Ion.with(context)
                .load(url)
                .setBodyParameter("id_videoaula", idVideoula)
                .asJsonArray()
                .setCallback((e, result) -> {
                    for (int i = 0; i < result.size(); i++){
                        JsonObject response = result.get(i).getAsJsonObject();

                        Duvidas duvidas = new Duvidas();
                        duvidas.setIdDuvida(response.get("ID_DUVIDA").getAsInt());
                        duvidas.setNomeAluno(response.get("NOME_ALUNO").getAsString());
                        duvidas.setMsgDuvida(response.get("MSG_DUVIDA").getAsString());
                        duvidas.setDataHoraMsg(response.get("DTAHR_MSG_DUVIDA").getAsString());
                        duvidas.setNomeProf(response.get("NOME_PROF").getAsString());
                        duvidas.setRespDuvida(response.get("RESP_DUVIDA").getAsString());
                        duvidas.setDataHoraResp(response.get("DTAHR_RESP_DUVIDA").getAsString());
                        lComentarios.add(duvidas);
                    }

                    adaptador = new ArrayAdapter<>(context, android.R.layout.simple_list_item_1, lComentarios);
                    adaptador.setDropDownViewResource(android.R.layout.simple_list_item_checked);
                    listAdapterDuvidas= new ListAdapterDuvidas(context, lComentarios);
                    listComent.setAdapter(listAdapterDuvidas);
                });
    }

    private void comment(String comentario, final Context context){
        boolean isValidData = validateFields(comentario);

        if (isValidData) {
            String url = HOST_APP + "/comentar.php";
            Ion.with(context)
                    .load(url)
                    .setBodyParameter("id_aluno", HomeFragment.idAluno)
                    .setBodyParameter("id_videoaula", idVideoula)
                    .setBodyParameter("id_prof", idAutor)
                    .setBodyParameter("msg_duvida", comentar.getText().toString())
                    .asJsonObject()
                    .setCallback((e, result) -> {
                        String status = result.get("status").getAsString();

                        if (status.equals("ok")) {
                            Toast.makeText(getContext(), "Comentado", Toast.LENGTH_SHORT).show();
                        } else {
                            Toast.makeText(getContext(), "Algo deu errado :(", Toast.LENGTH_SHORT).show();
                        }

                        comentar.setText("");
                        displayComments(getActivity());
                    });
        }
    }

    //Metodo para validar os campos
    private boolean validateFields(String comentario) {
        boolean isValid = false;

        if (!TextUtils.isEmpty(comentario)) {
            if (comentario.length() <= 100) {
                isValid = true;
            } else {
                utils.showAlert("Texto muito longo", getContext());
            }
        } else {
            utils.showAlert("Campo vazio!", getContext());
        }
        return isValid;
    }

    @SuppressLint("RestrictedApi")
    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == ID_TEXTO_PARA_VOZ) {
            if (resultCode == RESULT_OK && null != data) {
                ArrayList<String> result = data
                        .getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
                assert result != null;
                String saying = result.get(0);
                comentar.setText(saying);
            }
        }
    }
}