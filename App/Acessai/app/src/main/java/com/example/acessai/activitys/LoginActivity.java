package com.example.acessai.activitys;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Session;
import com.example.acessai.classes.Utils;
import com.example.acessai.rest.AlunoHttpClient;

import java.util.ArrayList;
import java.util.Locale;

public class LoginActivity extends AppCompatActivity {
    private EditText emailx, senhax, campo;
    private VideoView videoLibras;
    private ImageButton falar;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private final String HOST_SITE = new Host().getUrlSite();
    private final int ID_TEXTO_PARA_VOZ = 100;

    Utils utils = new Utils();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        videoLibras = (VideoView) findViewById(R.id.videoLibras);
        frameLibras = (FrameLayout) findViewById(R.id.frameLibras);
        libras = (ToggleButton) findViewById(R.id.tbLibras);
        falar = (ImageButton) findViewById(R.id.btnImgFalar);
        emailx = (EditText) findViewById(R.id.txtLogin);
        senhax = (EditText) findViewById(R.id.txtSenhaL);
        Button entrar = (Button) findViewById(R.id.btnLogar);
        Button cadastrar = (Button) findViewById(R.id.btnCadastrar);
        Button esqueceuSenha = (Button) findViewById(R.id.btnEsqueceuSenha);
        Button trabalheConosco = (Button) findViewById(R.id.btnTbConosco);

        //deixa o botão falar desabilitado
        falar.setEnabled(false);

        //deixa a tela do video libras escondido
        frameLibras.setVisibility(View.INVISIBLE);

        //evento de foco login
        emailx.setOnFocusChangeListener((v, hasFocus) -> {
            //atribui o valor do edittext login para o campo
            campo = emailx;

            //deixa o botão falar habilitado
            falar.setEnabled(true);
        });

        //evento de foco senha
        senhax.setOnFocusChangeListener((v, hasFocus) -> {
            //atribui o valor do edittext senha para o campo
            campo = senhax;

            //deixa o botão falar habilitado
            falar.setEnabled(true);
        });

        //evento do botão logar
        entrar.setOnClickListener(v -> {
            login(emailx.getText().toString(), senhax.getText().toString());
        });

        //evento do botao cadastrar
        cadastrar.setOnClickListener(v -> {
            //instancia o intent e atribui de qual activity vai partir e para qual vai
            Intent intent = new Intent(LoginActivity.this, CadastroActivity.class);

            //chama o objeto instanciado
            startActivity(intent);

            //finaliza a activity
            LoginActivity.this.finish();
        });

        //evento do botao esqueceuSenha
        esqueceuSenha.setOnClickListener(v -> {
            //instancia o intent e atribui de qual activity vai partir e para qual vai
            Intent intent = new Intent(LoginActivity.this, EsqueceuSenhaActivity.class);

            //chama o objeto instanciado
            startActivity(intent);

            //finaliza a activity
            LoginActivity.this.finish();
        });

        //evento do botao falar
        falar.setOnClickListener(v -> {
            //instancia um intent para chamar a o reconhecimento de voz
            Intent intentVoz = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);

            //busca o idioma
            intentVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);

            //busca o local onde deverá aparecer
            intentVoz.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());

            //mostra a caixa de dialogo com o texto
            intentVoz.putExtra(RecognizerIntent.EXTRA_PROMPT, "Fale agora");

            //verifica se o dispositivo tem suporte para o recurso
            try {
                startActivityForResult(intentVoz, ID_TEXTO_PARA_VOZ);
            } catch (ActivityNotFoundException a) {
                utils.showAlert("Dispositivo não suporta!", LoginActivity.this);
            }
        });

        //evento do botao libras
        libras.setOnCheckedChangeListener((buttonView, isChecked) -> {
            //se o botao estiver no modo ligar (selecionado)
            if (isChecked) {
                //atribui um texto vazio
                libras.setText("");

                //deixa a tela do video libras visivel
                frameLibras.setVisibility(View.VISIBLE);

                //chama o video de libras
                String videoPath = "android.resource://" + getPackageName() + "/" + R.raw.video_tela_cadastro;

                //chama o metodo video que esta na classe metodos, responsavel por reproduzir o video
                utils.showVideo(videoLibras, videoPath);
            } else {
                //atribui um texto vazio
                libras.setText("");

                //deixa a tela do video libras escondido
                frameLibras.setVisibility(View.INVISIBLE);
            }
        });

        //evento do botão trabalhe conosco
        trabalheConosco.setOnClickListener(v -> {
            //instancia o endereço web para qual se quer ir
            Uri acessar = Uri.parse(HOST_SITE + "/trabalhe.php");

            //instancia o intent e coloca a ação e a variavel com o endereço
            Intent i = new Intent(Intent.ACTION_VIEW, acessar);

            //inicializa a activity
            startActivity(i);
        });
    }

    //Metodo logar
    public void login(String email, String senha) {

        //recebe o valor que estabele se os dados digitados estão corretos
        boolean isValidData = validarCampos(email, senha);

        //se os dados estiverem corretos
        if (isValidData) {
            AlunoHttpClient alunoHttpClient = new AlunoHttpClient();
            alunoHttpClient.logar(getBaseContext(), email, senha).thenAccept(result -> {
                if (result) {
                    Session session = new Session(LoginActivity.this);
                    session.createSession(email, senha);

                    Intent intent = new Intent(LoginActivity.this, HomeActivity.class);
                    startActivity(intent);
                    LoginActivity.this.finish();
                } else {
                    utils.showAlert("Algo deu errado :(", LoginActivity.this);

                    emailx.setText("");
                    senhax.setText("");
                }
            }).exceptionally(e -> {
                // lida com a exceção
                return null;
            });
        }
    }

    //Metodo para validar os campos
    private boolean validarCampos(String email, String password) {
        //atribui valor falso, ou seja, errado
        boolean isValid = false;

        //verifica se os campos estão vazios
        if (!TextUtils.isEmpty(email) && !TextUtils.isEmpty(password)) {
            //verifica se estar no formato de email
            if (android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
                //se tudo estiver correto, atribui valor verdadeiro
                isValid = true;
            } else {
                //chama o metodo alerta e mostra na tela
                utils.showAlert("Formato inválido!", LoginActivity.this);

                //atribui valor vazio
                emailx.setText("");

                //aponta o erro
                emailx.setError("*");

                //foca no edittext
                emailx.requestFocus();
            }
        } else {
            //chama o metodo alerta e mostra na tela
            utils.showAlert("Preencha todos os campos!", LoginActivity.this);
        }
        //retorna se os campos estão corretos ou não
        return isValid;
    }

    //metodo resultado falar
    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        //atraves do código verifica as opções
        if (requestCode == ID_TEXTO_PARA_VOZ) {
            //captura o que foi falado e transcreve em texto no campo focado
            if (resultCode == RESULT_OK && null != data) {
                ArrayList<String> result = data
                        .getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
                assert result != null;
                String saying = result.get(0);
                campo.setText(saying);
            }
        }
    }

    //metodo botao voltar 
    @Override
    public void onBackPressed() {
        super.onBackPressed();
        //finaliza a activity
        LoginActivity.this.finish();
    }
}
