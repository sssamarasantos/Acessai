package com.example.acessai.fragments;

import static androidx.core.provider.FontsContractCompat.FontRequestCallback.RESULT_OK;

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
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Session;
import com.example.acessai.classes.Usuario;
import com.example.acessai.classes.Utils;
import com.example.acessai.enums.Assistencia;
import com.example.acessai.rest.AlunoHttpClient;
import com.google.gson.JsonObject;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Locale;

public class UsuarioFragment extends Fragment {

    private ImageButton alterar, salvar, falar;
    private EditText nome, email, senha, assistencia, campo;
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;

    public static String id, nomeu, emailu, senhau, assistenciau;
    private final int ID_TEXTO_PARA_VOZ = 100;
    Session session;
    boolean clique = false;
    private final String HOST_APP = new Host().getUrlApp();

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
        frameLibras = (FrameLayout) view.findViewById(R.id.frameLibras);
        libras = (ToggleButton) view.findViewById(R.id.tbLibras);
        videoLibras = (VideoView) view.findViewById(R.id.videoLibras);

        session = new Session(context);
        HashMap<String, String> userDetails = session.getUserDetails();
        String emailx = userDetails.get(Session.KEY_EMAIL);
        buscarUsuario(emailx);

        nome.setEnabled(false);
        email.setEnabled(false);
        senha.setEnabled(false);
        assistencia.setEnabled(false);
        falar.setEnabled(false);

        libras.setVisibility(View.INVISIBLE);
        frameLibras.setVisibility(View.INVISIBLE);

        nome.setOnFocusChangeListener((v, hasFocus) -> {
            campo = nome;
            falar.setEnabled(true);
        });

        email.setOnFocusChangeListener((v, hasFocus) -> {
            campo = email;
            falar.setEnabled(true);
        });

        senha.setOnFocusChangeListener((v, hasFocus) -> {
            campo = senha;
            falar.setEnabled(true);
        });

        assistencia.setOnFocusChangeListener((v, hasFocus) -> {
            campo = assistencia;
            falar.setEnabled(true);
        });

        alterar.setOnClickListener(v -> {
            nome.setEnabled(true);
            email.setEnabled(true);
            senha.setEnabled(true);
            assistencia.setEnabled(true);

            if (!clique) {
                alterar.setVisibility(View.INVISIBLE);
                salvar.setVisibility(View.VISIBLE);
                clique = true;
            }
        });

        salvar.setOnClickListener(v -> {
            updateUser();

            if (clique) {
                salvar.setVisibility(View.INVISIBLE);
                alterar.setVisibility(View.VISIBLE);
                clique = true;
            }
        });

        falar.setOnClickListener(v -> {
            Intent intentVoz = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
            intentVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);
            intentVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());
            intentVoz.putExtra(RecognizerIntent.EXTRA_PROMPT, "Fale agora");

            try {
                startActivityForResult(intentVoz, ID_TEXTO_PARA_VOZ);
            } catch (ActivityNotFoundException a) {
                utils.showAlert("Dispositivo não suporta!", context);
            }
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

    private void buscarUsuario(String emailx) {
        AlunoHttpClient alunoHttpClient = new AlunoHttpClient();
        alunoHttpClient.buscar(getContext(), emailx).thenAccept(result -> {
            nome.setText(result.getNome());
            email.setText(result.getEmail());
            senha.setText(result.getSenha());
            assistencia.setText(result.getAssistencia().toString());
            utils.mostrarLibras(frameLibras, libras, assistencia.toString());
        });
    }

    private void updateUser() {
        boolean isValidData = validateFields();

        if (isValidData) {
            Usuario aluno = new Usuario();
            aluno.setUsuario(nome.getText().toString(), email.getText().toString(), senha.getText().toString(), assistencia.getText().toString());

            AlunoHttpClient alunoHttpClient = new AlunoHttpClient();
            alunoHttpClient.atualizar(getActivity(), aluno).thenAccept(result -> {
                if (result) {
                    utils.showAlert("Alteração feita com sucesso!", getContext());

                    buscarUsuario(email.getText().toString());

                    nome.setEnabled(false);
                    email.setEnabled(false);
                    senha.setEnabled(false);
                    assistencia.setEnabled(false);
                    falar.setEnabled(false);
                } else {
                    utils.showAlert("Algo deu errado :(", getContext());
                }
            });
        }
    }

    private boolean validateFields() {
        boolean isValid = false;

        if (!TextUtils.isEmpty(email.getText().toString())
                && !TextUtils.isEmpty(nome.getText().toString())
                && !TextUtils.isEmpty(senha.getText().toString())
                && !TextUtils.isEmpty(assistencia.getText().toString())) {
            if (android.util.Patterns.EMAIL_ADDRESS.matcher(email.getText().toString()).matches()) {
                isValid = true;
            } else {
                utils.showAlert("Formato inválido!", getContext());
                email.setError("*");
                email.requestFocus();
            }
        } else {
            utils.showAlert("Preencha todos os campos!", getActivity());
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
                campo.setText(saying);
            }
        }
    }
}