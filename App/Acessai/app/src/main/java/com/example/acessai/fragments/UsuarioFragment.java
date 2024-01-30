package com.example.acessai.fragments;

import android.annotation.SuppressLint;
import android.content.ActivityNotFoundException;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.text.TextUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.example.acessai.R;
import com.example.acessai.classes.Utils;
import com.example.acessai.classes.Session;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Locale;

import static androidx.core.provider.FontsContractCompat.FontRequestCallback.RESULT_OK;

public class UsuarioFragment extends Fragment {

    private ImageButton alterar, salvar, falar;
    private EditText nome, email, senha, assistencia, campo;
    private VideoView videoLibras;
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private String host = "http://acessai1.000webhostapp.com/app/";
    //private String host = "http://192.168.15.9/tcc/";
    private String url = "", ret = "";
    public static String id, nomeu, emailu, senhau, assistenciau;
    boolean dadosValidados;
    private final int ID_TEXTO_PARA_VOZ = 100;
    Session session;
    boolean clique = false;

    Utils utils = new Utils();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_usuario, container, false);
        final Context context = inflater.getContext();

        nome = (EditText) view.findViewById(R.id.txtNomeUser);
        email = (EditText) view.findViewById(R.id.txtEmailUser);
        senha = (EditText) view.findViewById(R.id.txtSenhaUser);
        assistencia = (EditText) view.findViewById(R.id.txtAssistUser);
        alterar = (ImageButton) view.findViewById(R.id.btnImgAlterar);
        salvar = (ImageButton) view.findViewById(R.id.btnImgSalvar);
        falar = (ImageButton) view.findViewById(R.id.btnImgFalar);
        frameLogin = (FrameLayout) view.findViewById(R.id.librasBotao);
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);

        session = new Session(context);
        HashMap<String, String> usuario = session.getUserDetails();
        String user = usuario.get(Session.KEY_EMAIL);
        chamarUsuario(user);

        nome.setEnabled(false);
        email.setEnabled(false);
        senha.setEnabled(false);
        assistencia.setEnabled(false);
        falar.setEnabled(false);

        libras.setVisibility(View.INVISIBLE);
        frameLibras.setVisibility(View.INVISIBLE);

        nome.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                campo = nome;
                falar.setEnabled(true);
            }
        });
        email.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                campo = email;
                falar.setEnabled(true);
            }
        });
        senha.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                campo = senha;
                falar.setEnabled(true);
            }
        });
        assistencia.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                campo = assistencia;
                falar.setEnabled(true);
            }
        });

        alterar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nome.setEnabled(true);
                email.setEnabled(true);
                senha.setEnabled(true);
                assistencia.setEnabled(true);

                if (!clique) {
                    alterar.setVisibility(View.INVISIBLE);
                    salvar.setVisibility(View.VISIBLE);
                    clique = true;
                }
            }
        });
        salvar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                alterar();

                if (clique) {
                    salvar.setVisibility(View.INVISIBLE);
                    alterar.setVisibility(View.VISIBLE);
                    clique = true;
                }
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
                    utils.showAlert("Dispositivo não suporta!", context);
                }
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
                    utils.showVideo(videoLibras, videoPath);
                } else {
                    libras.setText("");
                    frameLibras.setVisibility(View.INVISIBLE);
                }
            }
        });

        return view;
    }

    public void chamarUsuario(String user) {
        url = host + "/usuario.php";
        Ion.with(getActivity())
                .load(url)
                .setBodyParameter("usuario", user)
                .asJsonArray()
                .setCallback(new FutureCallback<JsonArray>() {
                    @Override
                    public void onCompleted(Exception e, JsonArray result) {
                        for (int i = 0; i < result.size(); i++){
                            JsonObject ret = result.get(i).getAsJsonObject();

                            id = ret.get("ID_ALUNO").getAsString();
                            nomeu = ret.get("NOME_ALUNO").getAsString();
                            emailu = ret.get("EMAIL_ALUNO").getAsString();
                            senhau = ret.get("SENHA_ALUNO").getAsString();
                            assistenciau = ret.get("ASSISTENCIA_ALUNO").getAsString();
                        }
                        utils.showLibras(frameLibras, libras, assistenciau);
                        nome.setText(nomeu);
                        email.setText(emailu);
                        senha.setText(senhau);
                        assistencia.setText(assistenciau);
                    }
                });
    }

    private void alterar() {
        dadosValidados = validarCampos();

        if (dadosValidados) {
            url = host + "/alterar.php";
            Ion.with(getActivity())
                    .load(url)
                    .setBodyParameter("id", id)
                    .setBodyParameter("login", email.getText().toString())
                    .setBodyParameter("senha", senha.getText().toString())
                    .setBodyParameter("nome", nome.getText().toString())
                    .setBodyParameter("assistencia", assistencia.getText().toString())
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception e, JsonObject result) {
                            ret = result.get("status").getAsString();
                            if (ret.equals("ok")) {

                                utils.showAlert("Alteração feita com sucesso!", getContext());

                                chamarUsuario(email.getText().toString());

                                nome.setEnabled(false);
                                email.setEnabled(false);
                                senha.setEnabled(false);
                                assistencia.setEnabled(false);
                                falar.setEnabled(false);
                            } else {
                                utils.showAlert("Algo deu errado :(", getContext());
                            }
                        }
                    });
        }
    }

    private boolean validarCampos() {
        boolean retorno = false;

        if (!TextUtils.isEmpty(email.getText().toString())
                && !TextUtils.isEmpty(nome.getText().toString())
                && !TextUtils.isEmpty(senha.getText().toString())
                && !TextUtils.isEmpty(assistencia.getText().toString())){
            if (android.util.Patterns.EMAIL_ADDRESS.matcher(email.getText().toString()).matches()){
                retorno = true;
            } else {
                utils.showAlert("Formato inválido!", getContext());
                email.setError("*");
                email.requestFocus();
            }
        } else {
            utils.showAlert("Preencha todos os campos!", getActivity());
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
                    campo.setText(ditado);
                }
                break;
        }
    }
}