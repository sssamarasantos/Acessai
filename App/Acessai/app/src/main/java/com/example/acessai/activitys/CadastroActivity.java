package com.example.acessai.activitys;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.ActivityNotFoundException;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.RadioButton;
import android.widget.ToggleButton;
import android.widget.VideoView;

import com.example.acessai.R;
import com.example.acessai.classes.Metodos;
import com.example.acessai.fragments.HomeFragment;
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
    private FrameLayout frameLogin, frameLibras;
    private ToggleButton libras;
    private VideoView videoLibras;
    private String assistencia = "", mensagem = "";
    private String host = "http://acessai1.000webhostapp.com/app/";
    //private String host = "http://192.168.15.9/tcc/";
    private String url = "", ret = "";
    public String loginx, nomex, senhax, confSenhax;
    boolean dadosValidados;
    private final int ID_TEXTO_PARA_VOZ = 100;

    Metodos metodo = new Metodos();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cadastro);

        videoLibras = (VideoView) findViewById(R.id.videoLibras);
        frameLogin = (FrameLayout) findViewById(R.id.librasBotao);
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
        nome.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                campo = nome;
                falar.setEnabled(true);
            }
        });
        //evento de foco login
        login.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                campo = login;
                falar.setEnabled(true);
            }
        });
        //evento de foco senha
        senha.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                campo = senha;
                falar.setEnabled(true);
            }
        });
        // evento de foco confirmar senha
        confSenha.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                campo = confSenha;
                falar.setEnabled(true);
            }
        });
        //evento botao cadastro
        cadastro.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loginx = login.getText().toString();
                nomex = nome.getText().toString();
                senhax = senha.getText().toString();
                confSenhax = confSenha.getText().toString();

                cadastrar();
            }
        });

        //evento digitação por voz
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
                    metodo.alerta("Dispositivo não suporta!", CadastroActivity.this);
                }
            }
        });

        frameLibras.setVisibility(View.INVISIBLE);

        //evento mostrar/ocultar video libras
        libras.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked) {
                    libras.setText("");
                    frameLibras.setVisibility(View.VISIBLE);
                    //video
                    String videoPath = "android.resource://" + getPackageName() + "/" + R.raw.video_tela_cadastro;
                    metodo.video(videoLibras, videoPath);
                } else {
                    libras.setText("");
                    frameLibras.setVisibility(View.INVISIBLE);
                }
            }
        });
    }

    private void cadastrar(){

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

        dadosValidados = validarCampos();

        if (dadosValidados) {
            url = host + "/cadastrar.php";
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
                            ret = result.get("status").getAsString();
                            if (ret.equals("ok")) {
                                //alert
                                AlertDialog.Builder builder = new AlertDialog.Builder(CadastroActivity.this);
                                builder.setMessage("Usuário cadastrado com sucesso!");
                                builder.setTitle("Aviso");
                                builder.setNeutralButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {
                                        Intent objEsquece = new Intent(CadastroActivity.this, LoginActivity.class);
                                        startActivity(objEsquece);
                                        CadastroActivity.this.finish();
                                    }
                                });
                                builder.create().show();
                            } else {
                                metodo.alerta("Algo deu errado :(", CadastroActivity.this);
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
    private boolean validarCampos() {
        boolean retorno = false;

        if (!TextUtils.isEmpty(loginx)
                && !TextUtils.isEmpty(nomex)
                && !TextUtils.isEmpty(senhax)
                && !TextUtils.isEmpty(confSenhax)
                && !assistencia.isEmpty()){
            if (android.util.Patterns.EMAIL_ADDRESS.matcher(loginx).matches()){
                if (senhax.length() >= 6){
                    if (senhax.equals(confSenhax)) {
                        retorno = true;
                    } else {
                        metodo.alerta("Senhas não conferem!", CadastroActivity.this);
                        senha.setText("");
                        confSenha.setText("");
                        senha.setError("*");
                        senha.requestFocus();
                    }
                } else {
                    metodo.alerta("Senha muito curta!", CadastroActivity.this);
                    senha.setText("");
                    confSenha.setText("");
                    senha.setError("*");
                    senha.requestFocus();
                }
            } else {
                metodo.alerta("Formato inválido!", CadastroActivity.this);
                login.setText("");
                login.setError("*");
                login.requestFocus();
            }
        } else {
            metodo.alerta("Preencha todos os campos!", CadastroActivity.this);
        }
        return retorno;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
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

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent objCadastrar = new Intent(CadastroActivity.this, LoginActivity.class);
        startActivity(objCadastrar);
        CadastroActivity.this.finish();
    }
}
