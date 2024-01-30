package com.example.acessai.activitys;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.RadioButton;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Utils;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;
import java.util.Locale;

public class CadastroActivity extends AppCompatActivity {

    private EditText login, senha, confSenha, nome, campo;
    private RadioButton auditiva, visual, cognitiva, nenhuma;
    private Button cadastro;
    private ImageButton falar;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private VideoView videoLibras;
    private String assistencia = "";
    private String loginx, nomex, senhax, confSenhax;
    private final String HOST_APP = new Host().getUrlApp();
    private final int ID_TEXTO_PARA_VOZ = 100;

    Utils utils = new Utils();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cadastro);

        videoLibras = (VideoView) findViewById(R.id.videoLibras);
        frameLibras = (FrameLayout) findViewById(R.id.frameLibras);
        libras = (ToggleButton) findViewById(R.id.tbLibras);
        falar = (ImageButton) findViewById(R.id.btnImgFalar);
        login = (EditText) findViewById(R.id.txtEmail);
        senha = (EditText) findViewById(R.id.txtSenha);
        confSenha = (EditText) findViewById(R.id.txtConfirmarSenha);
        nome = (EditText) findViewById(R.id.txtNome);
        auditiva = (RadioButton) findViewById(R.id.rbAuditiva);
        cognitiva = (RadioButton) findViewById(R.id.rbCognitiva);
        visual = (RadioButton) findViewById(R.id.rbVisual);
        nenhuma = (RadioButton) findViewById(R.id.rbNenhuma);
        cadastro = (Button) findViewById(R.id.btnCadastro);

        falar.setEnabled(false);

        //evento de foco nome
        nome.setOnFocusChangeListener((v, hasFocus) -> {
            campo = nome;
            falar.setEnabled(true);
        });

        //evento de foco login
        login.setOnFocusChangeListener((v, hasFocus) -> {
            campo = login;
            falar.setEnabled(true);
        });

        //evento de foco senha
        senha.setOnFocusChangeListener((v, hasFocus) -> {
            campo = senha;
            falar.setEnabled(true);
        });

        // evento de foco confirmar senha
        confSenha.setOnFocusChangeListener((v, hasFocus) -> {
            campo = confSenha;
            falar.setEnabled(true);
        });
        //evento botao cadastro
        cadastro.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loginx = login.getText().toString();
                nomex = nome.getText().toString();
                senhax = senha.getText().toString();
                confSenhax = confSenha.getText().toString();

                signUp();
            }
        });

        //evento digitação por voz
        falar.setOnClickListener(v -> {
            Intent intentVoz = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
            intentVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);
            intentVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());
            intentVoz.putExtra(RecognizerIntent.EXTRA_PROMPT, "Fale agora");

            try {
                startActivityForResult(intentVoz, ID_TEXTO_PARA_VOZ);
            } catch (ActivityNotFoundException a){
                utils.showAlert("Dispositivo não suporta!", CadastroActivity.this);
            }
        });

        frameLibras.setVisibility(View.INVISIBLE);

        //evento mostrar/ocultar video libras
        libras.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (isChecked) {
                libras.setText("");
                frameLibras.setVisibility(View.VISIBLE);
                //video
                String videoPath = "android.resource://" + getPackageName() + "/" + R.raw.video_tela_cadastro;
                utils.showVideo(videoLibras, videoPath);
            } else {
                libras.setText("");
                frameLibras.setVisibility(View.INVISIBLE);
            }
        });
    }

    private void signUp(){

        if (visual.isChecked()) {
            assistencia = "Visual";
        }
        if (cognitiva.isChecked()) {
            assistencia = "Cognitiva";
        }
        if (auditiva.isChecked()) {
            assistencia = "Auditiva";
        }
        if (nenhuma.isChecked()) {
            assistencia = "Nenhuma";
        }

        boolean isValidData = validateFields();

        if (isValidData) {
            String url = HOST_APP + "/cadastrar.php";
            Ion.with(CadastroActivity.this)
                    .load(url)
                    .setBodyParameter("login", loginx)
                    .setBodyParameter("senha", senhax)
                    .setBodyParameter("nome", nomex)
                    .setBodyParameter("assistencia", assistencia)
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception e, JsonObject result) {
                            String status = result.get("status").getAsString();
                            if (status.equals("ok")) {
                                //alert
                                AlertDialog.Builder builder = new AlertDialog.Builder(CadastroActivity.this);
                                builder.setMessage("Usuário cadastrado com sucesso!");
                                builder.setTitle("Aviso");
                                builder.setNeutralButton("OK", (dialog, which) -> {
                                    Intent objEsquece = new Intent(CadastroActivity.this, LoginActivity.class);
                                    startActivity(objEsquece);
                                    CadastroActivity.this.finish();
                                });
                                builder.create().show();
                            } else {
                                utils.showAlert("Algo deu errado :(", CadastroActivity.this);
                                login.setText("");
                                nome.setText("");
                                senha.setText("");
                                confSenha.setText("");
                                auditiva.setChecked(false);
                                visual.setChecked(false);
                                cognitiva.setChecked(false);
                                nenhuma.setChecked(false);
                            }
                        }
                    });
        }
    }

    //verifica a validade dos campos
    private boolean validateFields() {
        boolean isValid = false;

        if (!TextUtils.isEmpty(loginx)
                && !TextUtils.isEmpty(nomex)
                && !TextUtils.isEmpty(senhax)
                && !TextUtils.isEmpty(confSenhax)
                && !assistencia.isEmpty()){
            if (android.util.Patterns.EMAIL_ADDRESS.matcher(loginx).matches()){
                if (senhax.length() >= 6){
                    if (senhax.equals(confSenhax)) {
                        isValid = true;
                    } else {
                        utils.showAlert("Senhas não conferem!", CadastroActivity.this);
                        senha.setText("");
                        confSenha.setText("");
                        senha.setError("*");
                        senha.requestFocus();
                    }
                } else {
                    utils.showAlert("Senha muito curta!", CadastroActivity.this);
                    senha.setText("");
                    confSenha.setText("");
                    senha.setError("*");
                    senha.requestFocus();
                }
            } else {
                utils.showAlert("Formato inválido!", CadastroActivity.this);
                login.setText("");
                login.setError("*");
                login.requestFocus();
            }
        } else {
            utils.showAlert("Preencha todos os campos!", CadastroActivity.this);
        }
        return isValid;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
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

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent intent = new Intent(CadastroActivity.this, LoginActivity.class);
        startActivity(intent);
        CadastroActivity.this.finish();
    }
}
